<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }
    public function create()
    {
        return view('admin.category.create');
    }
    public function store(Request $request)
    {
        $rule = [
            'name' => 'required',
            'image' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ];
        $message = [
            'required' => 'Trường bắt buộc phải nhập'
        ];

        $category = $request->validate($rule, $message);
        if ($request->hasFile('image')) {
            $file = $request->image;
            $fileName = $file->getClientOriginalName();
            $path = 'uploads/categories/';
            $file->move($path, $fileName);
            $cate = new Category();
            $cate->image = $path . $fileName;
            $cate->category_name = $category['name'];
            $cate->created_at = Carbon::now();
            $cate->updated_at = Carbon::now();
            $cate->save();
        }

        return redirect('admin/categories/index')->with('message', 'Thêm thành công');
    }
    public function delete(Request $request)
    {

        $category = Category::find($request->id);
        if ($category && $category->delete()) {
            return redirect('admin/categories/index')->with('message', 'Xoá thành công');
        }
    }
    public function edit(Request $request)
    {
        $category = Category::find($request->id);

        return view('admin.category.edit', compact('category'));
    }
    public function update(Request $request)
    {
        $rule = [
            'id' => 'required',
            'name' => 'required',
        ];
        $message = [
            'required' => 'Trường bắt buộc phải nhập'
        ];
        $category = $request->validate($rule, $message);
        $cate = Category::find($category['id']);
        if ($request->hasFile('image')) {
            $file = $request->image;
            $fileName = $file->getClientOriginalName();
            $path = 'uploads/categories/';
            $file->move($path, $fileName);
            $cate = Category::find($category['id']);
            $cate->image = $path . $fileName;
        }
       
        $cate->category_name = $category['name'];
        $cate->updated_at = Carbon::now();

        $cate->save();
        return redirect('admin/categories/index')->with('message', 'Sửa thành công');
    }
}
