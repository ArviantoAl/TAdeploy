<?php

namespace App\Http\Controllers;

use App\Exports\PelangganExport;
use App\Helper\LogActivity;
use App\Mail\MailAdmins;
use App\Models\Invoice;
use App\Models\Langganan;
use App\Models\Langinv;
use App\Models\Ppn;
use App\Models\ProfilCv;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function data_user(){
        $users = User::query()->paginate(10);
        return view('dashboard.admin.user.user', compact('users'));
    }

    public function semua_langganan(){
        $user = Auth::user()->id_user;
        $langganans = Langganan::query()->where('pelanggan_id', $user)
            ->orderBy('created_at', 'DESC')->paginate(10);
        $subject = 'Pelanggan, Daftar Langganan';
        LogActivity::addToLog($subject);
        return view('dashboard.pelanggan.langganan', compact('langganans'));
    }

    public function change_ppn(Request $request){
        $id_user = $request->id_user;
        $ppn_id = $request->ppn_id;
        $tahun=Carbon::now()->format('Y');
        $ppn = Ppn::query()
            ->where('tahun','=',$tahun)
            ->get();

        if (count($ppn)!=0){
            if ($ppn_id == 1){
                $hppn = '1';
            }else{
                $hppn = '0';
            }
        }else{
            $hppn = '0';
        }

        $user = User::query()->find($id_user);
        $user->ppn = $hppn;
        $nama = $user->name;
        $user->save();

        return response()->json(['cek'=>1, 'msg'=>'Status PPN '.$nama.' berhasil diubah!']);
    }

    public function selectallppn(Request $request){
        $ppn_flag = $request->ppn_flag;
        $tahun=Carbon::now()->format('Y');
        $ppn = Ppn::query()
            ->where('tahun','=',$tahun)
            ->get();

        if (count($ppn)!=0){
            if ($ppn_flag == 1){
                $hppn = '1';
            }else{
                $hppn = '0';
            }
        }else{
            $hppn = '0';
        }

        DB::table('users')
            ->where('status_id', '=', 3)
            ->update([
                'ppn'=>$hppn,
            ]);

        return response()->json(['cek'=>1, 'msg'=>'Status PPN Pelanggan Aktif berhasil diubah semua!']);
    }

    public function pelanggan_aktif(Request $request){
        $cv = ProfilCv::query()->find(1);
        $terakhir = $cv->terakhir_generate;
        //bulan harus sub
        $bulan=Carbon::now()->subMonth()->format('n');
        $namabulan=Carbon::now()->translatedFormat('F');

        if ($request->has('status') || $request->has('search')){
            if ($request->status=='all'){
                $user = User::query()->where('user_role', '=', 3)
                    ->where('name', 'LIKE', '%'.$request->search.'%');
                $nama_status = 'Semua';
            }else{
                $user = User::query()->where('user_role', '=', 3)
                    ->where('name', 'LIKE', '%'.$request->search.'%')
                    ->where('status_id', '=', $request->status);
                $status = Status::query()->find($request->status);
                $nama_status = $status->nama_status;
            }
        }else{
            $user = User::query()->where('user_role', '=', 3)
                ->where('status_id', '=', 3);
            $status = Status::query()->find(3);
            $nama_status = $status->nama_status;
        }

        $getuser = $user->get();
        $users = $user->orderBy('created_at', 'DESC')->paginate(10);
        $users->appends($request->all());

        $langganan = [];
        foreach ($getuser as $usr){
            $id_user = $usr->id_user;
            $name = $usr->name;
            $langganans = Langganan::query()
                ->where('pelanggan_id', '=', $id_user)
                ->get();
            $langganan[] = [
                'id' => $id_user,
                'name' => $name,
                'langganan' => $langganans
            ];
        }
        return view('dashboard.admin.user.pelanggan_aktif', compact('terakhir', 'bulan', 'users', 'langganan', 'nama_status', 'namabulan'));
    }

    public function nonaktif_pelanggan($id_pelanggan){
        $user = User::find($id_pelanggan);
        $nama = $user->name;

        $user->status_id = 4;
        $user->save();

        $langganans = Langganan::query()
            ->where('pelanggan_id', '=', $id_pelanggan)
            ->get();

        foreach ($langganans as $langganan){
            $langganan_id = $langganan->id_langganan;
            DB::table('turunan_bts')
                ->where('langganan_id', '=', $langganan_id)
                ->update([
                    'status_id'=>4,
                ]);
        }
        DB::table('langganans')
            ->where('pelanggan_id', '=', $id_pelanggan)
            ->update([
                'status_id'=>4,
            ]);

        return redirect()->route('admin.pelangganaktif')->with('success','Pelanggan '.$nama.' berhasil dinonaktifkan.');
    }

    public function tambah_user(){
        $roles = Role::all();
        $user = new User();
        return view('dashboard.admin.user.tambah_user', compact('roles', 'user'));
    }

    public function post_tambah_user(Request $request){
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
        ]);

        $pass = rand(100000, 999999);
        $password = Hash::make($pass);
        $name = $request->name;
        $username = $request->username;
        $email = $request->email;;

        $user = new User();
        $user->name = $name;
        $user->username = $username;
        $user->email = $email;
        $user->password = $password;
        $user->user_role = $request->user_role;
        $user->status_id = 3;

        if ($request->user_role == 1){
            $nama_role = 'Admin';
        }elseif ($request->user_role == 2){
            $nama_role = 'Teknisi';
        }elseif ($request->user_role == 3){
            $nama_role = 'Pelanggan';
        }

        $user->save();

        $data_ambil = [
            'nama' => $name,
            'nama_role' => $nama_role,
            'username' => $username,
            'email' => $email,
            'password' => $pass,
        ];

        Mail::to($email)->send(new MailAdmins($data_ambil));

        return redirect()->route('admin.user')
            ->with('success','User berhasil ditambahkan.');
    }

    public function edit_user($id_user){
        $user = User::find($id_user);

        return view('dashboard.admin.user.edit_user', compact('user'));
    }

    public function post_edit_user(Request $request ,$id_user){
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
        ]);
        $user = User::find($id_user);
        $username2 = $user->username;
        $email2 = $user->email;
        $username = $request->username;
        $email = $request->email;

        $getuser = User::query()
            ->where('email','=',$email)
            ->get();
        $getuser2 = User::query()
            ->where('username', '=', $username)
            ->get();

        if (count($getuser)>0 && $email!=$email2){
            return back()->with('error','email sudah digunakan');
        }elseif (count($getuser2)>0 && $username!=$username2){
            return back()->with('error','no hp sudah digunakan');
        }

        $user = User::find($id_user);
        $user->name = $request->name;
        $user->username = $username;
        $user->email = $email;
        $nama = $user->name;
        $user->save();

        return redirect()->route('admin.pelangganaktif')->with('success','Pelanggan '.$nama.' berhasil diubah.');
    }

    public function destroy($id_user)
    {
        $user = User::find($id_user);
        $user->delete();

        return redirect()->route('admin.user')
            ->with('success','User berhasil dihapus.');
    }

    public function export($id_user){
        $user = User::query()->find($id_user);
        $status = $user->status->nama_status;
        $invoices = Invoice::query()->where('pelanggan_id', '=', $id_user)->get();
        $langganans = Langganan::query()->where('pelanggan_id', '=', $id_user)->get();

        foreach ($invoices as $invoice){
            $id_inv = $invoice->id_invoice;
            $ppn = $invoice->ppn;
            $gettagihan[$id_inv] = DB::table('langganan_invoices')
                ->where('invoice_id', '=', $id_inv)
                ->sum('harga_satuan');
            $hargappn[$id_inv] = $gettagihan[$id_inv]*$ppn/100;
            $hgettagihan = $gettagihan[$id_inv]+$hargappn[$id_inv];
            $hargatagihan[$id_inv] = $hgettagihan;

            $lang_inv = Langinv::query()->where('invoice_id','=',$id_inv)->get();
            $lang[$id_inv]=$lang_inv;
        }
        $data_ambil = [
            'user' => $user,
            'status'=>$status,
            'inv' => $invoices,
            'lang' => $lang,
            'harga_bayar' => $hargatagihan,
            'subtotal' => $gettagihan,
            'hargappn' => $hargappn,
            'langganan' => $langganans,
        ];
//dd($data_ambil);
        return view('dashboard.admin.print.pelanggan', compact('data_ambil'));
    }
}
