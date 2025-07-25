<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Loans;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(): JsonResponse
    {
        // Total data
        $totalBooks = Books::count();
        $totalUsers = User::count();
        $totalLoans = Loans::count();

        // Statistik peminjaman terbaru
        $recentLoans = Loans::with(['user', 'book'])
            ->latest()
            ->take(5)
            ->get();

        // Statistik buku terpopuler (paling sering dipinjam)
        $popularBooks = Loans::select('book_id', DB::raw('count(*) as total_loans'))
            ->groupBy('book_id')
            ->orderByDesc('total_loans')
            ->with('book')
            ->take(5)
            ->get();

        // Statistik bulanan (jumlah peminjaman per bulan - 6 bulan terakhir)
        $monthlyLoans = Loans::select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
                DB::raw("COUNT(*) as total")
            )
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->get();

        return response()->json([
            'total_books' => $totalBooks,
            'total_users' => $totalUsers,
            'total_loans' => $totalLoans,
            'popular_books' => $popularBooks,
            'recent_loans' => $recentLoans,
            'monthly_loans' => $monthlyLoans,
        ], 200);
    }
}
