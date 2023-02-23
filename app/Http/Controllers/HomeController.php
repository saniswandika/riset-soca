<?php

namespace App\Http\Controllers;

use App\Models\laporan_tamu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
        $roles = User::orderBy('id','DESC')->paginate(5);

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $baik = laporan_tamu::where('penilaian_tamu','sangat puas')->count();
        $Cukup = laporan_tamu::where('penilaian_tamu','puas')->count();
        $Buruk = laporan_tamu::where('penilaian_tamu','tidak puas')->count();
        // dd($baik);
        $users = laporan_tamu::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw("month_name"))
        ->orderBy('id','ASC')
        ->pluck('count', 'month_name');

        $labels = $users->keys();
        $data = $users->values();
        
        return view('home', compact('labels', 'data','baik','Cukup','Buruk'));
        // return view('home');
        // return view('home');
    }
}
