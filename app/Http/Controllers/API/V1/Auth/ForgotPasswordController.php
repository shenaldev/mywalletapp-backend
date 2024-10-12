<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetMail;
use App\Models\PasswordReset;
use App\Models\User;
use App\Traits\UtilsTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    use UtilsTrait;
    private $TOKEN_EXPIRATION_MINUTES = 15;

    /**
     * Send Password Reset Token Email
     * @param Requeset $request [users email]
     */
    public function send_password_reset_email(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->email;

        //Check Email Have An Account If Not Return Error
        $is_email_in_db = User::where('email', '=', $email)->first();
        if (!$is_email_in_db) {
            return response()->json([
                'message' => 'Email address not found in our records.',
                'errors' => [
                    'email' => 'Email address not found in our records.',
                ],
            ]);
        }

        $generated_token = $this->generateStringToken(16);

        /**
         * If Email Already In Database Table Update Code Else Create New One
         */
        $token = PasswordReset::where('email', '=', $email)
            ->first();

        if ($token) {
            $token->token = $generated_token;
            $token->created_at = Carbon::now();
            $token->save();
        } else {
            PasswordReset::create([
                'email' => $email,
                'token' => $generated_token,
                'created_at' => Carbon::now(),
            ]);
        }

        try {
            Mail::to($email)->send(new PasswordResetMail($generated_token));
            return response()->json(['message' => 'Success', 'error' => false], 200);
        } catch (Exception $error) {
            if (env('APP_DEBUG')) {
                return response()->json(['message' => $error->getMessage(), 'error' => true], 500);
            }

            PasswordReset::where('email', '=', $email)->delete();
            return response()->json(['message' => "Failed to send email", 'error' => true], 500);
        }

        return response()->json(['message' => "Server Error", 'error' => true], 500);
    }

    /**
     * Verify Token That User Enters
     * @param Request $request [email]
     * @param $token
     */
    public function verify_reset_token(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
        ]);

        $email = $request->email;
        $token = $request->token;
        $passwordResetRecord = PasswordReset::where('email', '=', $email)
            ->first();

        try {
            $this->validate_reset_token($passwordResetRecord, $token);
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'error' => true
            ], 400);
        }

        return response()->json([
            'message' => "success",
            'error' => false
        ], 200);
    }

    /**
     * Reset the user's password
     * @param Request $request [email, token, password]
     * @return \Illuminate\Http\JsonResponse
     */
    public function reset_password(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:8|max:20',
        ]);

        $userEmail = $request->email;
        $passwordResetRecord = PasswordReset::where('email', '=', $userEmail)->first();

        try {
            $this->validate_reset_token($passwordResetRecord, $request->token);
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'error' => true
            ], 400);
        }

        // If all validation passes, reset the password
        $user = User::where('email', '=', $userEmail)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        $passwordResetRecord->delete();

        return response()->json([
            'message' => "Your password has been successfully reset.",
            'error' => false
        ], 200);
    }

    /**
     * Validate the password reset token
     * @param $passwordResetRecord
     * @param $providedToken
     * @throws Exception
     */
    private function validate_reset_token($passwordResetRecord, $providedToken)
    {
        if (!$passwordResetRecord) {
            throw new Exception("Invalid or expired reset token");
        }

        $currentTime = Carbon::now();
        $tokenCreationTime = Carbon::parse($passwordResetRecord->created_at);
        $tokenAge = $currentTime->diffInMinutes($tokenCreationTime);

        if ($tokenAge >= $this->TOKEN_EXPIRATION_MINUTES) {
            throw new Exception("The reset token has expired. Please request a new token.");
        }

        // If Token Does Not Match
        if ($providedToken !== $passwordResetRecord->token) {
            throw new Exception("Invalid reset token");
        }
    }
}
