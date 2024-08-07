<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Mail\OrderConFirm;
use App\Models\Bill;
use App\Models\BillDentail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        $donHang = Auth::user()->bill;
        $trangThaiDonHang = Bill::TRANG_THAI_DON_HANG;
        $type_cho_xac_nhan = Bill::CHO_XAC_NHAN;
        $type_dang_van_chuyen = Bill::DANG_VAN_CHUYEN;
    

        return view('clients.donhangs.index', compact('donHang', 'trangThaiDonHang', 'type_cho_xac_nhan', 'type_dang_van_chuyen'));
    }

    public function create()
    {
        $type_da_thanh_toan = Bill::DA_THANH_TOAN;
        $carts = session()->get('cart', []);
        if (!empty($carts)) {
            $total = 0;
            $subTotal = 0;
            foreach ($carts as $item) {
                $subTotal += $item['gia'] * $item['so_luong'];
            }
            $shipping = 30000;
            $total = $subTotal + $shipping;
            return view('clients.donhangs.create', compact('carts', 'total', 'shipping', 'subTotal','type_da_thanh_toan'));
        }
        return redirect()->route('user.product.cart');
    }

  
    public function store(OrderRequest $request)
    {
        DB::beginTransaction();
        try {
            $params = $request->except('_token');
            $params['code_orders'] = $this->getUniqueOrdercode();
    
            $bill = Bill::create($params);
            $bill_id = $bill->id;
    
            $carts = session()->get('cart', []);
            foreach ($carts as $key => $item) {
                $thanhtien = $item['gia'] * $item['so_luong'];
                $bill->billDentail()->create([
                    'bill_id' => $bill_id,
                    'product_id' => $key,
                    'don_gia' => $item['gia'],
                    'quantity' => $item['so_luong'],
                    'total_amount' => $thanhtien,
                ]);
            }
    
            DB::commit();
    
            Mail::to($bill->email_receiver)->queue(new OrderConFirm($bill));
            session()->put('cart', []);
            
            return redirect()->route('user.oders.index')->with('success', 'Đặt hàng thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('user.product.cart')->with('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    }
    
 
    


    public function show(string $id)
    {
        $donhang = Bill::query()->findOrFail($id);
        $trangThaiDonHang = Bill::TRANG_THAI_DON_HANG;
        $trangThaiThanhToan = Bill::TRANG_THAI_THANH_TOAN;

        return view('clients.donhangs.show', compact('donhang', 'trangThaiDonHang', 'trangThaiThanhToan'));
    }

    public function update(Request $request, string $id)
    {
        $donhang = Bill::query()->findOrFail($id);
        DB::beginTransaction();

        try {
            if ($request->has('cho_xac_nhan')) {
                $donhang->update(['status_bill' => Bill::HUY_DON_HANG]);
            } elseif ($request->has('dang_van_chuyen')) {
                $donhang->update(['status_bill' => Bill::DA_GIAO_HANG]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return redirect()->back();
    }

    public function destroy(string $id)
    {
        //
    }

    function getUniqueOrdercode()
    {
        do {
            $orderCode = 'LHL-' . Auth::id() . '-' . now()->timestamp;
        } while (Bill::where('code_orders', $orderCode)->exists());

        return $orderCode;
    }



}





