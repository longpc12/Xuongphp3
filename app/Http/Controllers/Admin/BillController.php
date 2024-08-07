<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Category;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh Sách đơn hàng';
        $listDonHang = Bill::query()->orderByDesc('id')->get();

        $trangThaiDonHang = Bill::TRANG_THAI_DON_HANG;
        $trangThaiThanhToan = Bill::TRANG_THAI_THANH_TOAN;

        $type_huy_don_hang = Bill::HUY_DON_HANG;
        $chua_thanh_toan = Bill::CHUA_THANH_TOAN;
        $da_thanh_toan = Bill::DA_THANH_TOAN;
        // dd($listCategory);
        return view('admins.qlydonhangs.index', compact('title', 'listDonHang', 'trangThaiDonHang','type_huy_don_hang','chua_thanh_toan','da_thanh_toan','trangThaiThanhToan'));
    }
    /**
     * Show the form for creating a new resource.
     */


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'thôn tin chi tiết đơn hàng';

        $donhang = Bill::query()->findOrFail($id);

        $trangThaiDonHang = Bill::TRANG_THAI_DON_HANG;
        
        $trangThaiThanhToan = Bill::TRANG_THAI_THANH_TOAN;
        return view('admins.qlydonhangs.show', compact('title','donhang', 'trangThaiDonHang', 'trangThaiThanhToan'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $donHang = Bill::query()->findOrFail($id);
        $currentStatus = $donHang->status_bill;

        $newStatus = $request->input('trang_thai_don_hang');

        $status = array_keys(Bill::TRANG_THAI_DON_HANG);

        // kiểm tra nếu đơn hàng đã bị hủy thì không thể thay đổi trạng thái
        if ($currentStatus === Bill::HUY_DON_HANG) {
            return redirect()->back()->with('error', 'Đơn hàng đã bị hủy, bạn không thể thay đổi trạng thái.');
        }

        // kiểm tra nếu trạng thái mới không được nằm sau trạng thái hiện tại

        if (array_search($newStatus, $status) < array_search($currentStatus, $status)) {
            return redirect()->back()->with('error', 'không thể cập nhật ngược lại trạng thái.');
        }

        $donHang->status_bill = $newStatus;
        $donHang->save();
        return redirect()->back()->with('success', 'cập nhật trạng thái thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // khi người dùng đã huyer đơn hàng thì mới được xóa 
        $donHang = Bill::query()->findOrFail($id);
        
       if($donHang && $donHang->status_bill == Bill::HUY_DON_HANG){
        $donHang->billDentail()->delete();
        $donHang->delete();
        return redirect()->back()->with('success', 'Xóa đơn hàng thành công.');

       }
       return redirect()->back()->with('error', 'không thể Xóa đơn hàng.');
       
    }
}
