<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index()
    {
        $startOfPeriod = Carbon::create(2024, 7, 1)->startOfDay(); // Bắt đầu từ 1/7/2024
        $today = Carbon::today();

        // Lấy thống kê cho khoảng thời gian từ 1/7/2024 đến hôm nay
        $statistics = Statistic::whereBetween('date', [$startOfPeriod->format('Y-m'), $today->format('Y-m')])->get();

        return view('admins.statistics.index', compact('statistics'));
    }
}
