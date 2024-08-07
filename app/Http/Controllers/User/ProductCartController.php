<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductCartController extends Controller
{
    public function listCart()
    {
        $cart = session()->get('cart', []);
        $subTotal = 0;
        foreach ($cart as $item) {
            $subTotal += $item['gia'] * $item['so_luong'];
        }

        $shipping = 30000;
        $total = $subTotal + $shipping;
        return view('clients.products.cart', compact('cart', 'total', 'subTotal', 'shipping'));
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Lấy thông tin sản phẩm dựa trên product_id vừa lấy được
        $product = Product::query()->findOrFail($productId);

        // Khởi tạo một mảng chứa thông tin giỏ hàng trên session
        $cart = session()->get('cart', []); // Khởi tạo giỏ hàng hiện tại từ session, nếu chưa có thì trả về một mảng rỗng.

        if (isset($cart[$productId])) {
            // Nếu thêm sản phẩm đã tồn tại trong giỏ hàng thì update thêm số lượng
            $cart[$productId]['so_luong'] += $quantity;
        } else {
            // Sản phẩm chưa tồn tại trong giỏ hàng
            $cart[$productId] = [
                'ten_san_pham' => $product->name_product,
                'so_luong' => $quantity,
                'gia' => isset($product->price_sale) ? $product->price_sale : $product->price_regular,
                'hinh_anh' => $product->thumbnail_url,
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back();
    }

    public function updateCart(Request $request)
    {
        $cartNew = $request->input('cart', []);
        session()->put('cart', $cartNew);
        return redirect()->back();
    }

    public function applyVoucher(Request $request)
    {
        $voucherCode = $request->input('voucher_code');
        $promotion = Promotion::where('code', $voucherCode)->first();
    
        if (!$promotion) {
            return response()->json(['success' => false, 'message' => 'Invalid voucher code.']);
        }
    
        // Kiểm tra ngày hợp lệ
        $today = Carbon::today();
        if ($today->lt($promotion->start_date) || $today->gt($promotion->end_date)) {
            return response()->json(['success' => false, 'message' => 'Mã khuyến mãi không hợp lệ.']);
        }
    
        // Kiểm tra người dùng đã sử dụng mã này chưa
        $usedPromotions = session()->get('used_promotions', []);
        if (in_array($promotion->id, $usedPromotions)) {
            return response()->json(['success' => false, 'message' => 'Bạn đã dùng mã này rồi']);
        }
    
        // Tính toán giảm giá theo phần trăm
        $cart = session()->get('cart', []);
        $subTotal = 0;
        foreach ($cart as $key => &$item) {
            $discountAmount = ($item['gia'] * $item['so_luong'] * $promotion->discount_amount) / 100;
            $item['gia'] -= $discountAmount / $item['so_luong'];
            $subTotal += $item['gia'] * $item['so_luong'];
        }
    
        session()->put('cart', $cart);
    
        // Lưu mã khuyến mãi đã dùng
        $usedPromotions[] = $promotion->id;
        session()->put('used_promotions', $usedPromotions);
    
        // Lưu promotion_id vào session
        session()->put('promotion_id', $promotion->id);
    
        $shipping = 30000;
    
        return response()->json(['success' => true, 'subTotal' => $subTotal, 'shipping' => $shipping]);
    }
    
}
