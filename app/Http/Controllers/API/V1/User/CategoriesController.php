<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of categories for user
     */
    public function index(Request $request)
    {
        $primaryCategories = Category::where('primary', true)->get();
        $customCategories = Category::where('user_id', $request->user()->id)->get();

        $mergeCategories = $primaryCategories->merge($customCategories);

        return response()->json($mergeCategories, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200|unique:categories',
            'icon' => 'nullable|string|max:200',
        ]);

        $userID = $request->user()->id;

        //CHECK IF CATEGORY ALREADY EXIST
        $slug = Str::slug($request->name) . '_' . $userID;
        $isAlreadyExist = Category::where('slug', $slug)
            ->where('user_id', $userID)
            ->first();

        if ($isAlreadyExist) {
            return response()->json(['message' => 'Category already exist'], 400);
        }

        $category = Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'icon' => $request->icon ? $request->icon : null,
            'user_id' => $userID
        ]);

        return response()->json($category, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'icon' => 'nullable|string|max:200'
        ]);

        $userID = $request->user()->id;

        if (!$this->isCategoryBelongsToUser($id, $userID)) {
            return response()->json(['message' => 'Unathorized'], 400);
        }

        if (!Category::find($id)) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $slug = Str::slug($request->name) . '_' . $userID;
        $isAlreadyExist = Category::where('slug', $slug)
            ->where('user_id', $userID)
            ->where('id', '!=', $id)
            ->first();

        if ($isAlreadyExist) {
            return response()->json(['message' => 'Category already exist'], 400);
        }

        $category = Category::find($id);
        $category->name = $request->name;
        $category->slug = $slug;
        $category->icon = $request->icon ? $request->icon : null;
        $category->save();

        return response()->json($category, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Category::find($id)) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        if (!$this->isCategoryBelongsToUser($id, auth()->id())) {
            return response()->json(['message' => 'Unathorized'], 400);
        }

        $isItemsExist = Payment::where('category_id', $id)->exists();
        if ($isItemsExist) {
            return response()->json(['message' => 'Category has items'], 400);
        }

        Category::destroy($id);
        return response()->json(['message' => 'Category deleted'], 200);
    }

    /**
     * Check if category belongs to user
     */
    private function isCategoryBelongsToUser($id, $userID)
    {
        return Category::where('id', $id)
            ->where('user_id', $userID)
            ->exists();
    }
}
