<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $title = 'Danh mục sản phẩm';
        $listCategory = Category::orderByDesc('status')->get();
        // dd($listCategory);
        return view('admins.Categorys.index', compact('title', 'listCategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = '  Thêm Mới Sản Phẩm';

        return view('admins.Categorys.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        if ($request->isMethod('POST')) {
            $param = $request->except('_token');
            // dd($param);

            if ($request->hasFile('image')) {
                $filepath  = $request->file('image')->store('uploads/categorys', 'public');
            } else {
                $filepath  = null;
            }
            $param['thumbnail_category'] =  $filepath;
            Category::create($param);
            return redirect()->route('admins.category.index')->with('success', 'Thêm mới danh mục thành công');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = "Chi tiết sản phẩm";
        $category = Category::query()->find($id);
        return view('admins.Categorys.dentail', compact('title','category'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = '  Sửa Sản Phẩm';
        $category = Category::query()->findOrFail($id);
        // dd($category->toArray());
        return view('admins.Categorys.edit', compact('title','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $param = $request->except('_token', '_method');
            // dd($param);
            $category = Category::query()->findOrFail($id);
         
            if ($request->hasFile('image')) {
                if($category->thumbnail_category && Storage::disk('public')->exists($category->thumbnail_category)){
                    Storage::disk('public')->delete($category->thumbnail_category);                  
                }
                $filepath  = $request->file('image')->store('uploads/categorys', 'public');
            } else {
                $filepath  = $category->thumbnail_category;
            }
         
            $param['thumbnail_category'] =  $filepath;
            $category->update($param);
            return redirect()->route('admins.category.index')->with('success', 'Cập Nhật danh mục thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        if($category->thumbnail_category && Storage::disk('public')->exists($category->thumbnail_category)){
            Storage::disk('public')->delete($category->thumbnail_category);                  
        }
        return redirect()->route('admins.category.index')->with('success', 'Xóa danh mục thành công');

    }
}
