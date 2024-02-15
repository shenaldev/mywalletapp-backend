<?php

namespace App\Http\Controllers\API\V1\Common;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(15);
        return response()->json($categories, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200|unique:categories',
            'icon' => 'nullable|string|max:200'
        ]);

        $slug = Str::slug($request->name);
        $isAlreadyExist = Category::where('slug', $slug)->first();

        if ($isAlreadyExist) {
            return response()->json(['message' => 'Category already exist'], 400);
        }

        $category = Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'icon' => $request->icon ? $request->icon : null
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

        if (!Category::find($id)) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $slug = Str::slug($request->name);
        $isAlreadyExist = Category::where('slug', $slug)->where('id', '!=', $id)->first();
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

        $isItemsExist = Category::find($id)->payments()->exists();
        if ($isItemsExist) {
            return response()->json(['message' => 'Category has items'], 400);
        }

        Category::destroy($id);
        return response()->json(['message' => 'Category deleted'], 200);
    }
}
