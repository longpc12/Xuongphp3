<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillDentail;
use App\Models\Vnpay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VnpayController extends Controller
{
    
    public function createPayment(Request $request)
    {
        // dd($request->all());
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
    
        $vnp_TmnCode = "GE7FFK3R"; // Website ID in VNPAY System
        $vnp_HashSecret = "MILTBLFZRFIBOBXODEFGJSOOQOYCQDWA"; // Secret key
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return'); // Cập nhật URL trả về chính xác
    
        $startTime = date("YmdHis");
        $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));
    
        // Lưu dữ liệu vào session
        session([
            'user_id' => $request->user_id,
            'name_receiver' => $request->name_receiver,
            'email_receiver' => $request->email_receiver,
            'phone_receiver' => $request->phone_receiver,
            'address' => $request->Address,
            'note' => $request->note,
            'subtotal' => $request->subtotal,
            'shipping' => $request->shipping,
            'total' => $request->total,
            'payment_method' => $request->payment_method,
            'bank_code' => $request->bank_code ?? 'NCB', // Đặt giá trị mặc định nếu không có giá trị
        ]);
    
        $vnp_TxnRef = time(); // Mã đơn hàng
        $vnp_OrderInfo = "Thanh toán đơn hàng";
        $vnp_OrderType = "billpayment";
        $vnp_Amount = $request->total * 100;
        $_SESSION['vnp_Amount'] = $vnp_Amount;
        $vnp_Locale = "vn";
        $vnp_BankCode = $request->input('bank_code') ?? 'NCB'; // Đặt giá trị mặc định nếu không có giá trị
        $vnp_IpAddr = $request->ip();
        $vnp_ExpireDate = $expire;
    
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $vnp_ExpireDate,
        );
    
        if ($vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
    
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
    
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            return redirect($vnp_Url);
        } else {
            return response()->json($returnData);
        }
    }
    
    public function vnpayReturn(Request $request)
    {
        if ($request->vnp_ResponseCode == '00') {
            // Lấy dữ liệu từ session
            $data = session()->all();
    
            // Tạo mã đơn hàng duy nhất
            $orderCode = $this->getUniqueOrdercode();
            $promotion_id = session()->get('promotion_id', null);
            // Tạo bản ghi trong bảng Bills
            $bill = Bill::create([
                'user_id' => $data['user_id'],
                'code_orders' => $orderCode,
                'name_receiver' => $data['name_receiver'],
                'email_receiver' => $data['email_receiver'],
                'phone_receiver' => $data['phone_receiver'],
                'Address' => $data['address'],
                'note' => $data['note'],
                'subtotal' => $data['subtotal'],
                'shipping' => $data['shipping'],
                'total' => $data['total'],
                'status_bill' => Bill::DA_XAC_NHAN, // Sử dụng hằng số đã định nghĩa
                'status_payment' => Bill::DA_THANH_TOAN,
                'type_pay' => '0',
                'pay_status' => '0',
                'promotion_id' => session()->get('promotion_id')
            ]);
    
            $carts = session()->get('cart', []);
            foreach ($carts as $key => $item) {
                $thanhtien = $item['gia'] * $item['so_luong'];
                $bill->billDentail()->create([
                    'bill_id' => $bill->id,
                    'product_id' => $key,
                    'don_gia' => $item['gia'],
                    'quantity' => $item['so_luong'],
                    'total_amount' => $thanhtien,
                ]);
            }


            // Tạo bản ghi trong bảng Vnpay
            Vnpay::create([
                'bill_id' => $bill->id,
                'user_id' => $data['user_id'],
                'vnp_Amount' => $request->vnp_Amount,
                'vnp_BankCode' => $request->vnp_BankCode,
                'vnp_BankTranNo' => $request->vnp_BankTranNo,
                'vnp_CardType' => $request->vnp_CardType,
                'vnp_OrderInfo' => $request->vnp_OrderInfo,
                'vnp_PayDate' => $request->vnp_PayDate,
                'vnp_TmnCode' => $request->vnp_TmnCode,
                'vnp_TransactionNo' => $request->vnp_TransactionNo,
                'vnp_TransactionStatus' => $request->vnp_TransactionStatus,
                'vnp_TxnRef' => $request->vnp_TxnRef,
            ]);
    
            return redirect()->route('user.oders.index')->with('success', 'Giao dịch thành công!');
        } else {
            return redirect()->route('user.oders.index')->with('error', 'Giao dịch không thành công!');
        }
    }
    
    private function getUniqueOrdercode()
    {
        do {
            $orderCode = 'LHL-' . Auth::id() . '-' . now()->timestamp;
        } while (Bill::where('code_orders', $orderCode)->exists());
    
        return $orderCode;
    }
}