<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeAdditionalDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'details', 'income_id',
    ];

    public function incomes()
    {
        return $this->belongsTo(Income::class);
    }

}
