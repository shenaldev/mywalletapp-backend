<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentAdditionalDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'details', 'payment_id',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
