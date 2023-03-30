<?php

namespace App\Http\Controllers;

use App\Models\laporan_tamu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use Spatie\Permission\Models\Role;
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
        $userid = Auth::user()->id;
        $usersrole = DB::table('model_has_roles')->where('model_id', $userid)->get();
    
        return view('home');
        // return view('home');
        // return view('home');
    }
}
