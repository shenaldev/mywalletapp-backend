<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'note', 'payment_id',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
