<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    // Hiển thị danh sách mã khuyến mãi
    public function index()
    {
        $promotions = Promotion::all();
        return view('admins.promotions.index', compact('promotions'));
    }

    // Hiển thị form tạo mới mã khuyến mãi
    public function create()
    {
        return view('admins.promotions.create');
    }

    // Lưu mã khuyến mãi mới
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:promotions,code',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'discount_amount' => 'required|numeric',
            'is_active' => 'required|boolean',
        ]);

        Promotion::create($request->all());

        return redirect()->route('admins.promotions.index')->with('success', 'Thêm khuyến mãi thành công');
    }

    // Hiển thị form chỉnh sửa mã khuyến mãi
    public function edit(Promotion $promotion)
    {
        return view('admins.promotions.edit', compact('promotion'));
    }

    // Cập nhật mã khuyến mãi
    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            'code' => 'required|unique:promotions,code,' . $promotion->id,
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'discount_amount' => 'required|numeric',
            'is_active' => 'required|boolean',
        ]);

        $promotion->update($request->all());

        return redirect()->route('admins.promotions.index')->with('success', 'sửa khuyến mãi thành công');
    }

    // Xóa mã khuyến mãi
    public function destroy(Promotion $promotion)
    {
        $promotion->delete();

        return redirect()->route('admins.promotions.index')->with('success', 'xóa khuyến mãi thành công');
    }
}
