<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:S_Administrator');
    }

    public function index()
    {

        $income = Transaction::where('transaction_status', 'SUCCESS')->sum('transaction_total');
        $sales  = Transaction::count();
        $items     = Transaction::orderBy('id', 'DESC')->take(5)->get();

        $totalProduct = Product::count();


        $pie     = [
            'pending'     => Transaction::where('transaction_status', 'PENDING')->count(),
            'failed'     => Transaction::where('transaction_status', 'FAILED')->count(),
            'success'     => Transaction::where('transaction_status', 'SUCCESS')->count()
        ];

        return view('pages.dashboard', [
            'income'     => $income,
            'sales'        => $sales,
            'items'     => $items,
            'pie'         => $pie,

            'totalProduct' => $totalProduct
        ]);
    }
}
