<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Invoice;
use App\Models\Langganan;
use App\Models\MasterBts;
use App\Models\Ppn;
use App\Models\ProfilCv;
use App\Models\Province;
use App\Models\Regency;
use App\Models\User;
use App\Models\Village;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterController extends Controller
{
    public function coba(){
        $invoice2 = Invoice::query()
            ->where('tahun', '=', 2022)
            ->orderBy('tgl_terbit', 'ASC')
            ->get();

        $invLine = $invoice2->groupBy(function ($inv){
            return Carbon::parse($inv->tgl_terbit)->format('M');
        });

        $namabulans=[];
        $bulanCount=[];
        $terCount=[];
        $belCount=[];
        $batCount=[];
        $val=[];
        $i=0;
        foreach ($invLine as $namabulan => $values){
            $namabulans[]=$namabulan;
            $i++;
            $val[] = $values->toArray();
            for ($j=0; $j<$i; $j++){
                $a = count($val[$j]);
                for ($k=0; $k<$a; $k++){
                    $all[$j][$k] = $val[$j][$k]['harga_bayar'];
                    if ($val[$j][$k]['status_id']==7||$val[$j][$k]['status_id']==8){
                        $terb[$j][$k] = $val[$j][$k]['harga_bayar'];
                    }else{
                        $terb[$j][$k] = 0;
                    }
                    if ($val[$j][$k]['status_id']==6||$val[$j][$k]['status_id']==11){
                        $belu[$j][$k] = $val[$j][$k]['harga_bayar'];
                    }else{
                        $belu[$j][$k] = 0;
                    }
                    if ($val[$j][$k]['status_id']==9){
                        $bata[$j][$k] = $val[$j][$k]['harga_bayar'];
                    }else{
                        $bata[$j][$k] = 0;
                    }
                }
                $all1[$j] = array_sum($all[$j]);
                $ter1[$j] = array_sum($terb[$j]);
                $bel1[$j] = array_sum($belu[$j]);
                $bat1[$j] = array_sum($bata[$j]);
                $bulanCount[$j] = $all1[$j];
                $terCount[$j] = $ter1[$j];
                $belCount[$j] = $bel1[$j];
                $batCount[$j] = $bat1[$j];
            }
        }
        if (count($invoice2)>0){
            $batas_max = max($bulanCount)+(max($bulanCount)/2);
        }else{
            $batas_max = 0;
        }
        dd($invoice2);
    }

    public function map_lang(){
        $cv = ProfilCv::query()->find(1);
        $data2 = MasterBts::all();
        $data = Langganan::query()
            ->where('status_id','=',2)
            ->orWhere('status_id','=',3)
            ->orWhere('status_id','=',11)
            ->get();
        $lang = [];
        $master = [];
        foreach ($data2 as $d2){
            $master[] = [
                'nama' => $d2->nama_master,
                'longitude' => $d2->longitude,
                'latitude' => $d2->latitude,
                'alamat' => $d2->nama_lokasi,
            ];
        }
        foreach ($data as $d){
            if ($d->status_id==2){
                $lang[] = [
                    'nama' => $d->pelanggan->name,
                    'status' => 'Aktif(proses pembayaran)',
                    'longitude' => $d->longitude,
                    'latitude' => $d->latitude,
                    'alamat' => $d->alamat_pasang,
                    'layanan' => $d->layanan->nama_layanan
                ];
            }else{
                $lang[] = [
                    'nama' => $d->pelanggan->name,
                    'status' => $d->status->nama_status,
                    'longitude' => $d->longitude,
                    'latitude' => $d->latitude,
                    'alamat' => $d->alamat_pasang,
                    'layanan' => $d->layanan->nama_layanan
                ];
            }
        }
        return view('dashboard.admin.map_langganan',compact('cv','lang','master'));
    }

    public function count_notif(){
        $inv = Invoice::query()
            ->where('status_id','=',7)
            ->orWhere('status_id','=',11)
            ->get();
        $hinv = count($inv);
        echo $hinv;
    }

    public function msg_notif(){
        $inv = Invoice::query()
            ->where('status_id','=',7)
            ->orWhere('status_id','=',11)
            ->get();
        $msg = "";
        foreach ($inv as $invoice){
            $name = $invoice->pelanggan->name;
            $bulan = $invoice->bulan;
            $tahun = $invoice->tahun;
            $href = route('admin.invoice','bulan='.$bulan.'&tahun='.$tahun);
            if ($invoice->status_id==7){
                $msg .= "<a href='$href' class='dropdown-item d-flex border-bottom'>
                                                <div class='  drop-img  cover-image  ' data-image-src='{{ asset('nowa_assets') }}/img/faces/3.jpg'>
                                                    <span class='avatar-status bg-teal'></span>
                                                </div>
                                                <div class='wd-90p'>
                                                    <div class='d-flex'>
                                                        <h5 class='mb-0 name'>$name</h5>
                                                    </div>
                                                    <p class='mb-0 desc'>Sudah Melakukan Pembayaran</p>
                                                    <p class='time mb-0 text-start float-start ms-2 mt-2'>$invoice->tgl_bayar</p>
                                                </div>
                                            </a>";
            }else{
                $msg .= "<a href='$href' class='dropdown-item d-flex border-bottom'>
                                                <div class='  drop-img  cover-image  ' data-image-src='{{ asset('nowa_assets') }}/img/faces/3.jpg'>
                                                    <span class='avatar-status bg-teal'></span>
                                                </div>
                                                <div class='wd-90p'>
                                                    <div class='d-flex'>
                                                        <h5 class='mb-0 name'>$name</h5>
                                                    </div>
                                                    <p class='mb-0 desc'>Mengajukan klaim unggah ulang bukti pembayaran</p>
                                                    <p class='time mb-0 text-start float-start ms-2 mt-2'>$invoice->tgl_bayar</p>
                                                </div>
                                            </a>";
            }
        }
        echo $msg;
    }

    public function ppn_index(){
        $ppns = Ppn::query()->paginate(10);

        return view('dashboard.admin.ppn.index', compact('ppns'));
    }

    public function tambah_ppn(){
        $ppn = new Ppn();
        $tahun=Carbon::now()->addYear()->format('Y');

        return view('dashboard.admin.ppn.tambah_ppn', compact('ppn','tahun'));
    }

    public function post_tambah_ppn(Request $request){
        $request->validate([
            'tahun' => 'required',
            'jumlah' => 'required',
        ]);
        $cek = Ppn::query()->where('tahun', '=', $request->tahun)->get();
        if (count($cek)!=0){
            return redirect()->route('admin.ppn')->with('success','data PPN '.$request->tahun.' sudah ada.');
        }else{
            $ppn = new Ppn();
            $ppn->tahun = $request->tahun;
            $ppn->jumlah = $request->jumlah;

            $ppn->save();

            return redirect()->route('admin.ppn')
                ->with('success','PPN berhasil ditambahkan.');
        }
    }

    public function edit_ppn($id_ppn){
        $ppn = Ppn::find($id_ppn);

        return view('dashboard.admin.ppn.edit_ppn', compact('ppn'));
    }

    public function post_edit_ppn(Request $request ,$id_ppn){
        $request->validate([
            'tahun' => 'required',
            'jumlah' => 'required',
        ]);

        $ppn2 = ppn::find($id_ppn);
        $tahun = $ppn2->tahun;
        $cek = Ppn::query()->where('tahun', '=', $request->tahun)->get();
        if (count($cek)!=0 && $request->tahun!=$tahun){
            return redirect()->route('admin.ppn')->with('success','data PPN '.$request->tahun.' sudah ada.');
        }else{
            $ppn = ppn::find($id_ppn);
            $ppn->tahun = $request->tahun;
            $ppn->jumlah = $request->jumlah;

            $ppn->save();

            return redirect()->route('admin.ppn')
                ->with('success','ppn '.$request->tahun.' berhasil diubah.');
        }
    }

    public function profilcv(){
        $profil = ProfilCv::query()->find(1);

        return view('dashboard.admin.profilcv', compact('profil'));
    }

    public function edit_cv($id_profil){
        $profil = ProfilCv::query()->find($id_profil);
        $provinsi =Province::all();

        return view('dashboard.admin.edit_cv', compact('profil','provinsi'));
    }

    public function post_edit_cv(Request $request){
        $id_profil = $request->id;
        $id_provinsi = $request->id_provinsi;
        $id_kabupaten = $request->id_kabupaten;
        $id_kecamatan = $request->id_kecamatan;
        $id_desa = $request->id_desa;
        $id_alamat = $request->id_alamat;
        $lokasi = $request->lokasi;
        $ll = explode(",",$lokasi);
        $long = $ll[1];
        $lat = $ll[0];

        $profil = ProfilCv::query()->find($id_profil);
        $profil->nama_cv = $request->nama_cv;
        $profil->no_hp = $request->no_hp;
        $profil->email_cv = $request->email_cv;
        $profil->web_cv = $request->web_cv;
        $profil->provinsi_id = $id_provinsi;
        $profil->kabupaten_id = $id_kabupaten;
        $profil->kecamatan_id = $id_kecamatan;
        $profil->desa_id = $id_desa;
        $profil->detail_alamat = $id_alamat;
        $profil->longitude = $long;
        $profil->latitude = $lat;

        $rrt = $request->rt;
        $rrw = $request->rw;
        $rt = 'RT '.$rrt;
        $rw = 'RW '.$rrw;
        $rtrw = $rt.' / '.$rw;

        $getprovinsi = Province::query()->find($id_provinsi);
        $provinsi = $getprovinsi->name;

        $getkabupaten = Regency::query()->find($id_kabupaten);
        $kabupaten = $getkabupaten->name;

        $getkecamatan = District::query()->find($id_kecamatan);
        $kecamatan = $getkecamatan->name;

        $getdesa = Village::query()->find($id_desa);
        $desa = $getdesa->name;

        $alamat = $id_alamat;
        $lengkap = array($rtrw,$alamat,$desa,$kecamatan,$kabupaten,$provinsi);
        $profil->alamat = implode(", ",$lengkap);
        $profil->save();

        $getusr = User::query()->find(1);
        $getusr->email = $request->email_cv;
        $getusr->save();
    }

    public function editlogo(Request $request){
        $request->validate([
            'logo' => 'mimes:jpeg,png,bmp,tiff',
            'ikon' => 'mimes:jpeg,png,bmp,tiff',
        ]);

        if ($request->has('logo')){
            $logo = $request->file('logo');
            $nlogo = 'logo.png';
            $logo->move(public_path('nowa_assets/img/brand'), $nlogo);
            return back()->with('success', 'Logo CV berhasil diubah!');
        }elseif ($request->has('ikon')){
            $ikon = $request->file('ikon');
            $nikon = 'favicon.png';
            $ikon->move(public_path('nowa_assets/img/brand'), $nikon);
            return back()->with('success', 'Ikon CV berhasil diubah!');
        }else{
            return back()->with('success', 'Logo dan Ikon CV tidak diubah!');
        }
    }

    //get ajax
    public function getKabupatencv(Request $request, $id_profil)
    {
        $id_provinsi = $request->id_provinsi;
        $cv = ProfilCv::query()->find($id_profil);
        $selected = $cv->kabupaten_id;

        $kabupatens = Regency::query()
            ->where('province_id', $id_provinsi)
            ->orderBy('name', 'ASC')
            ->get();

        $option = "<option>Pilih Kabupaten</option>";
        foreach ($kabupatens as $kabupaten){
            if ($kabupaten->id == $selected){
                $option .= "<option value='$kabupaten->id' selected>$kabupaten->name</option>";
            }else{
                $option .= "<option value='$kabupaten->id'>$kabupaten->name</option>";
            }
        }
        echo $option;
    }

    public function getKecamatancv(Request $request, $id_profil)
    {
        $id_kabupaten = $request->id_kabupaten;
        $cv = ProfilCv::query()->find($id_profil);
        $selected = $cv->kecamatan_id;

        $kecamatans = District::query()
            ->where('regency_id', $id_kabupaten)
            ->orderBy('name', 'ASC')
            ->get();

        $option = "<option>Pilih Kecamatan</option>";
        foreach ($kecamatans as $kecamatan){
            if ($kecamatan->id == $selected){
                $option .= "<option value='$kecamatan->id' selected>$kecamatan->name</option>";
            }else{
                $option .= "<option value='$kecamatan->id'>$kecamatan->name</option>";
            }
        }
        echo $option;
    }

    public function getDesacv(Request $request, $id_profil)
    {
        $id_kecamatan = $request->id_kecamatan;
        $cv = ProfilCv::query()->find($id_profil);
        $selected = $cv->desa_id;

        $desas = Village::query()
            ->where('district_id', $id_kecamatan)
            ->orderBy('name', 'ASC')
            ->get();

        $option = "<option>Pilih Desa</option>";
        foreach ($desas as $desa){
            if ($desa->id == $selected){
                $option .= "<option value='$desa->id' selected>$desa->name</option>";
            }else{
                $option .= "<option value='$desa->id'>$desa->name</option>";
            }
        }
        echo $option;
    }
}
