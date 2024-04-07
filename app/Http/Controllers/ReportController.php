<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::latest()->get();
        return view('reports.index', compact('reports'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|integer',
            'month' => 'required|integer',
            'capital' => 'required|numeric',
        ]);

        $totalUsers = User::whereYear('created_at', $request->year)
            ->whereMonth('created_at', $request->month)
            ->count();

        $totalOrders = Order::whereYear('created_at', $request->year)
            ->whereMonth('created_at', $request->month)
            ->count();

        $totalTransaction = Order::whereYear('created_at', $request->year)
            ->whereMonth('created_at', $request->month)
            ->where('payment_status', 'paid')
            ->sum('total_amount');

        $profitOrLoss = $totalTransaction - $request->capital;

        Report::create([
            'year' => $request->year,
            'month' => $request->month,
            'total_user' => $totalUsers,
            'total_orders' => $totalOrders,
            'capital' => $request->capital,
            'total_transaction' => $totalTransaction,
            'profit_or_loss' => $profitOrLoss,
        ]);

        return redirect()->back()
            ->with('success', 'Report created successfully.');
    }



    public function destroy(Report $report)
    {
        $report->delete();

        return redirect()->back()
            ->with('success', 'Report deleted successfully');
    }
}
