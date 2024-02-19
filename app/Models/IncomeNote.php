<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'note', 'income_id',
    ];

    public function incomes()
    {
        return $this->belongsTo(Income::class);
    }
}
