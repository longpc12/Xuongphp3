<?php

namespace App\Http\Controllers;

use App\Models\BillDentail; // Sửa BillDentail thành BillDetail
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'content' => 'required|string',
        ]);

        $user_id = Auth::id();
        $product_id = $request->input('product_id');

        // Kiểm tra xem người dùng đã mua sản phẩm với trạng thái đơn hàng đã giao và đã thanh toán
        $hasPurchased = BillDentail::where('product_id', $product_id)
                                    ->whereHas('bill', function($query) use ($user_id) {
                                        $query->where('user_id', $user_id)
                                              ->where('status_bill', 'da_giao_hang')
                                              ->where('status_payment', 'da_thanh_toan');
                                    })
                                    ->exists();

        if (!$hasPurchased) {
            return redirect()->back()->with('error','Bạn chỉ có thể bình luận sản phẩm khi mua và nhận được hàng');
        }

        $comment = Comment::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'content' => $request->input('content'),
            'commentDate' => now(),
        ]);

        return redirect()->back();
    }
}
