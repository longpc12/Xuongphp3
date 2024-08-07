<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Statistic;
use App\Models\BillDentail;
use App\Models\Bill;
use App\Models\User;
use Carbon\Carbon;

class UpdateStatistics extends Command
{
    protected $signature = 'statistics:update';
    protected $description = 'Update monthly statistics';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            $today = Carbon::today();
            $startOfPeriod = Carbon::create(2024, 7, 1)->startOfDay(); // Bắt đầu từ 1/7/2024
            $endOfPeriod = $today->endOfDay(); // Kết thúc vào cuối ngày hôm nay

            // Lấy danh sách bill_id của các đơn hàng đã thanh toán
            $paidBillIds = Bill::where('status_payment', 'da_thanh_toan')
                ->whereBetween('created_at', [$startOfPeriod, $endOfPeriod])
                ->pluck('id');

            // Kiểm tra đầu ra của paidBillIds
            $this->info('Paid Bill IDs: ' . implode(', ', $paidBillIds->toArray()));

            // Tính toán và kiểm tra dữ liệu
            $totalRevenue = BillDentail::whereIn('bill_id', $paidBillIds)->sum('total_amount');
            $totalOrders = BillDentail::whereIn('bill_id', $paidBillIds)->count();
            $totalUsers = User::whereBetween('created_at', [$startOfPeriod, $endOfPeriod])->count();

            // Debugging thông tin
            $this->info("Start of Period: " . $startOfPeriod);
            $this->info("End of Period: " . $endOfPeriod);
            $this->info("Total Revenue: " . $totalRevenue);
            $this->info("Total Orders: " . $totalOrders);
            $this->info("Total Users: " . $totalUsers);

            // Cập nhật thống kê
            Statistic::updateOrCreate(
                ['date' => $today->format('Y-m')],
                [
                    'total_revenue' => $totalRevenue,
                    'total_orders' => $totalOrders,
                    'total_users' => $totalUsers,
                ]
            );

            $this->info('Statistics updated successfully.');
        } catch (\Exception $e) {
            $this->error('Failed to update statistics: ' . $e->getMessage());
        }
    }
}
