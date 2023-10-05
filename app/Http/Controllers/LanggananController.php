<?php

namespace App\Http\Controllers;

use App\Exports\PelangganExport;
use App\Mail\MailAdmins;
use App\Models\Langinv;
use App\Models\Ppn;
use App\Models\ProfilCv;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use App\Exports\JumlahExport;
use App\Helper\LogActivity;
use App\Models\Invoice;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\Bts;
use App\Models\District;
use App\Models\JenisBts;
use App\Models\Kategori;
use App\Models\MasterBts;
use App\Models\Metode;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use App\Models\MasterMikrotik;
use App\Models\Langganan;

class LanggananController extends Controller
{
    // public function semua_langganan(Request $request){
    //     $cv = ProfilCv::query()->find(1);
    //     $terakhir = $cv->terakhir_generate;
    //     //bulan harus sub
    //     $bulan=Carbon::now()->subMonth()->format('n');
    //     $namabulan=Carbon::now()->translatedFormat('F');

    //     if ($request->has('status') || $request->has('search')){
    //         if ($request->status=='all'){
    //             $user = User::query()->where('user_role', '=', 3)
    //                 ->where('name', 'LIKE', '%'.$request->search.'%');
    //             $nama_status = 'Semua';
    //         }else{
    //             $user = User::query()->where('user_role', '=', 3)
    //                 ->where('name', 'LIKE', '%'.$request->search.'%')
    //                 ->where('status_id', '=', $request->status);
    //             $status = Status::query()->find($request->status);
    //             $nama_status = $status->nama_status;
    //         }
    //     }else{
    //         $user = User::query()->where('user_role', '=', 3)
    //             ->where('status_id', '=', 3);
    //         $status = Status::query()->find(3);
    //         $nama_status = $status->nama_status;
    //     }

    //     $getuser = $user->get();
    //     $users = $user->orderBy('created_at', 'DESC')->paginate(10);
    //     $users->appends($request->all());

    //     $langganan = [];
    //     foreach ($getuser as $usr){
    //         $id_user = $usr->id_user;
    //         $name = $usr->name;
    //         $langganans = Langganan::query()
    //             ->where('pelanggan_id', '=', $id_user)
    //             ->get();
    //         $langganan[] = [
    //             'id' => $id_user,
    //             'name' => $name,
    //             'langganan' => $langganans
    //         ];
    //     }
        
    //     return view('dashboard.admin.langganan', compact('langganans', 'terakhir', 'bulan', 'users', 'langganan', 'nama_status', 'namabulan'));
    // }

    public function langganan_index(){
        $langganans = Langganan::query()->paginate(10);

        return view('dashboard.admin.langganan', compact('langganans'));
    }

    public function teknisi_langganan_index(){
        $langganans = Langganan::query()->paginate(10);

        return view('dashboard.teknisi.langganan', compact('langganans'));
    }

    public function keuangan_langganan_index(){
        $langganans = Langganan::query()->paginate(10);

        return view('dashboard.keuangan.langganan', compact('langganans'));
    }
}
