<?php

namespace App\Http\Controllers;

use App\Helper\LogActivity;
use Illuminate\Http\Request;

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
        if (auth()->user()->user_role==1){
            return view('dashboard.admin.index');
        }elseif(auth()->user()->user_role==2){
            return view('teknisi.dashboard');
        }elseif(auth()->user()->user_role==3){
            return view('dashboard.pelanggan.index');
        }
//        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function myTestAddToLog()
    {
        $subject = 'My Testing Add To Log.';
        LogActivity::addToLog($subject);
        dd('log insert successfully.');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function logActivity()
    {
        $logs = LogActivity::logActivityLists();
        return view('dashboard.admin.logActivity',compact('logs'));
    }
}
