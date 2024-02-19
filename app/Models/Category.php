<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'icon', 'primary', 'user_id'
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
