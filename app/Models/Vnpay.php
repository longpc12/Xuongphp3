<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vnpay extends Model
{
    use HasFactory;

    protected $table = 'vnpay';

    protected $fillable = [
        'bill_id',
        'user_id',
        'vnp_Amount',
        'vnp_BankCode',
        'vnp_BankTranNo',
        'vnp_CardType',
        'vnp_OrderInfo',
        'vnp_PayDate',
        'vnp_TmnCode',
        'vnp_TransactionNo'
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function billDetail()
    {
        return $this->belongsTo(BillDentail::class, 'bill_dentail_id');
    }
}
