<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role = auth()->user()->role;
        if ($role == 'admin') {
            $drivers = Driver::all();
            $orders = Order::with('driver')->get();
            return view('admin.admin', compact('drivers', 'orders'));
        } elseif ($role == 'atasan1') {
            $orders = Order::with('driver')->where('status', 'pending')->get();
            return view('atasan.atasan1', compact('orders'));
        } elseif ($role == 'atasan2') {
            $orders = Order::with('driver')->where('status', 'approved by atasan1')->get();
            return view('atasan.atasan2', compact('orders'));
        } else {
            return redirect('/');
        }
    }
}
