<?php

namespace App\Traits;

use App\Models\Category;

trait UserCategoryTrait
{
    public function getUserCategories($userID)
    {
        $primaryCategories = Category::where('primary', true)->get();
        $customCategories = Category::where('user_id', $userID)->get();

        $mergeCategories = $primaryCategories->merge($customCategories);

        return $mergeCategories;
    }
}
