<?php

namespace App\Http\Controllers\API\V1\Common;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodsController extends Controller
{
    public function index()
    {
        $paymentMethods = PaymentMethod::all();
        return response()->json($paymentMethods, 200);
    }
}
