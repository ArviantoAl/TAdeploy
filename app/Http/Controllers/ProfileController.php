<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function activity_log(Request $request)
    {
        $id_pel = $request->idp;
        $role = $request->role;
        $act = $request->activity;
        $waktu = Carbon::now()->setTimezone('Asia/Jakarta');

        if ($role==3){
            $activity = new ActivityLog();
            $activity->pelanggan_id = $id_pel;
            $activity->action = $act;
            $activity->waktu = $waktu;
            $activity->save();
        }
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => ['required', 'email'],
        ]);

        auth()->user()->update($request->all());
        return redirect()->back()
            ->with('message', 'Berhasil diubah');
    }

    public function edit_pass()
    {
//        dd($pass);
        return view('profile.ubahsandi');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Kata sandi saat ini salah!');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Kata sandi berhasil diubah!');
    }
}
