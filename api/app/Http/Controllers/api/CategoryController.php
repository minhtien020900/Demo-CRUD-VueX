<?php

namespace App\Http\Controllers\api;


use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function readCategories(Request $request)
    {
        $name = $request->name;
        $count = $request->count;
        $category = Category::where('name', 'LIKE', "%{$name}%");
        return $category->paginate($count);
//        return Category::all();
    }

    public function createCategory(Request $request)
    {
        $fileName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('upload'), $fileName);

        $category = new Category();
        $category->name = $request->name;
        $category->image = 'upload/' . $fileName;
        $category->save();
    }

    public function updateCategory(Request $request)
    {
        $category = Category::findorFail($request->id);
        $category->name = $request->name;
        if ($category->image != $request->image) {
            File::delete($category->image);
            $fileName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('upload'), $fileName);
            $category->image = 'upload/' . $fileName;
        } else {
            $category->image = $request->image;
        }
        $category->update();
    }

    public function deleteCategory(Request $request)
    {
        $category = Category::find($request->id);
        $category->delete();
    }
}
