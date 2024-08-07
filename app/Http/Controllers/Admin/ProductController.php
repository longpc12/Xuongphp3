<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh Sách sản phẩm';
        $listProduct = Product::get();
        // dd($listProduct->toArray()); 
        return view('admins.products.index', compact('title', 'listProduct'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm sản phẩm';
        $listCate = Category::get();
        // dd($listCate);
        return view('admins.products.create', compact('title', 'listCate'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        if ($request->isMethod('POST')) {
            $params = $request->except('_token');

            /// chuyển đổi giá trị checkbox thành boolean
            $params['is_hot'] = $request->has('is_hot') ? 1 : 0;
            $params['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;
            $params['is_new'] = $request->has('is_new') ? 1 : 0;
            $params['is_show_home'] = $request->has('is_show_home') ? 1 : 0;

            // SƯr lya hình ảnh đại diện
            if ($request->hasFile('thumbnail_url')) {
                $params['thumbnail_url'] = $request->file('thumbnail_url')->store('uploads/product', 'public');
            } else {
                $params['thumbnail_url'] = null;
            }

            // dd($params);
            // thêm sản phâme
            $product = Product::query()->create($params);

            // lấy id san pẩm vừa thêm  để thêm được Album
            #
            $product_id = $product->id;
            // Xử lý thêm album
            if ($request->hasFile('list_image')) {
                foreach ($request->file('list_image') as $image) {
                    if ($image) {
                        $path = $image->store('uploads/Albumproduct/id_' . $product_id, 'public');
                        $product->ProductImage()->create(
                            [
                                'product_id' => $product_id,
                                'image' => $path,
                            ]

                        );
                    }
                }
            }
            return redirect()->route('admins.products.index')->with('success', 'Thêm sản phẩm thành công');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Sửa sản phẩm';
        $editCategory = Category::query()->get();
        $editProduct = Product::query()->findOrFail($id);
        // dd($listProduct);
        return view('admins.products.edit', compact('title', 'editProduct', 'editCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $params = $request->except('_token', 'method');

            /// chuyển đổi giá trị checkbox thành boolean
            $params['is_hot'] = $request->has('is_hot') ? 1 : 0;
            $params['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;
            $params['is_new'] = $request->has('is_new') ? 1 : 0;
            $params['is_show_home'] = $request->has('is_show_home') ? 1 : 0;

            $product = Product::query()->findOrFail($id);

            // SƯr lya hình ảnh đại diện
            if ($request->hasFile('thumbnail_url')) {
                if ($product->thumbnail_url && Storage::disk('public')->exists($product->thumbnail_url)) {
                    Storage::disk('public')->delete($product->thumbnail_url);
                }
                $params['thumbnail_url'] = $request->file('thumbnail_url')->store('uploads/product', 'public');
            } else {
                $params['thumbnail_url'] = $product->thumbnail_url;
            }

            // Xử Lý Abbum
            if ($request->hasFile('list_image')) {
                $currentImage = $product->ProductImage->pluck('id')->toArray();
                $arrayCombine = array_combine($currentImage, $currentImage);
                // dd($arrayCombine);

                // TRƯỜNG HỢP XÓA
                foreach ($arrayCombine as $key => $value) {
                    // tìm kiếm id hình trong mảng hình ảnh mới đẩy lên
                    // nếu khong tôn tại ID thì tức là người dùng đã xóa hình ảnh đó
                    if (!array_key_exists($key, $request->list_image)) {
                        $productImage = ProductImage::query()->find($key);
                        // xóa hình ảnh

                        if ($productImage->image && Storage::disk('public')->exists($productImage->image)) {
                            Storage::disk('public')->delete($productImage->image);
                            $productImage->delete();
                        }
                    }
                }
                // trường hợp thêm hoạc sửa

                foreach ($request->list_image as $key => $image) {
                    if (!array_key_exists($key, $arrayCombine)) {
                        if ($request->hasFile("list_image.$key")) {
                            $path = $image->store('uploads/Albumproduct/id_' . $id, 'public');
                            $product->ProductImage()->create([
                                'product_id' => $id,
                                'image' => $path,
                            ]);
                        }
                    } else if (is_file($image) && $request->hasFile("list_image.$key")) {
                        // trường hợp thay đổi hình ảnh
                        $productImage = ProductImage::query()->find($key);
                        if ($productImage && Storage::disk('public')->exists($productImage->image)) {
                            Storage::disk('public')->delete($productImage->image);
                        }
                        $path = $image->store('uploads/Albumproduct/id_' . $id, 'public');
                        $productImage->update([
      
                            'image' => $path,
                        ]);
                    }
                }
            }
          $product->update($params);
            return redirect()->route('admins.products.index')->with('success', 'Cập nhật thông sản phẩm thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $product = Product::query()->findOrFail($id);
        // xóa hình ảnh địa diện
        if ($product->thumbnail_url && Storage::disk('public')->exists($product->thumbnail_url)) {
            Storage::disk('public')->delete($product->thumbnail_url);
        }

        // xóa hình ảnh trong Abulm
        $product->ProductImage()->delete();

        // Xóa toàn bộ thư mục chứa hình ảnh của sản phẩm
        $path = 'uploads/Albumproduct/id_' . $id;
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->deleteDirectory($path);
        }

        $product->delete();
        return redirect()->route('admins.products.index')->with('success', 'xóa sản phẩm thành công');
    }
}
