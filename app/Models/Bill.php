<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    const TRANG_THAI_DON_HANG = [
        'cho_xac_nhan' => 'chờ xác nhận',
        'da_xac_nhan' => 'đã xác nhận',
        'dang_chuan_bi' => 'đang chuẩn bị',
        'dang_van_chuyen' => 'đang vận chuyển',
        'da_giao_hang' => 'đã giao hàng',
        'huy_don_hang' => 'hủy đơn hàng '
    ];

   
    const TRANG_THAI_THANH_TOAN = [
        'chua_thanh_toan' => 'chưa thanh toán',
        'da_thanh_toan' => 'đã thanh toán',
    ];


    
    
    const CHO_XAC_NHAN = 'cho_xac_nhan';

    const DA_XAC_NHAN = 'da_xac_nhan';

    const DANG_CHUAN_BI = 'dang_chuan_bi';

    const DANG_VAN_CHUYEN = 'dang_van_chuyen';

    const DA_GIAO_HANG = 'da_giao_hang';

    const HUY_DON_HANG = 'huy_don_hang';

    const CHUA_THANH_TOAN = 'chua_thanh_toan';

    const DA_THANH_TOAN = 'da_thanh_toan';

   protected $fillable = [
        'code_orders',
        'name_receiver',
        'user_id',
        'email_receiver',
        'phone_receiver',   
        'Address',
        'note',
        'status_bill',
        'status_payment',
        'subtotal',
        'shipping',
        'total',
        'promotion_id',
        'type_pay', 
        'pay_status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function billDentail(){
        return $this->hasMany(BillDentail::class);
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    public function vnpays()
    {
        return $this->hasMany(Vnpay::class);
    }
}
