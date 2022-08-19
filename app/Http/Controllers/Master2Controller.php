<?php

namespace App\Http\Controllers;

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
use Illuminate\Http\Request;

class Master2Controller extends Controller
{
    public function lokasi_index(){
        $lokasis = MasterBts::query()->paginate(10);

        return view('dashboard.admin.lokasi.index', compact('lokasis'));
    }

    public function tambah_lokasi(){
        $lokasi = new MasterBts();
        $provinsi = Province::all();

        return view('dashboard.admin.lokasi.tambah_lokasi', compact('lokasi','provinsi'));
    }

    public function post_tambah_lokasi(Request $request){
        $nama = $request->nama;
        $provinsi_id = $request->provinsi;
        $kabupaten_id = $request->kabupaten;
        $kecamatan_id = $request->kecamatan;
        $desa_id = $request->desa;
        $koordinat = $request->koordinat;

        if ($koordinat==null){
            $long=null;
            $lat=null;
        }else{
            $ll = explode(",",$koordinat);
            $long = $ll[1];
            $lat = $ll[0];
        }

        if ($provinsi_id==0){
            return response()->json(['status'=>1, 'msg'=>'Data Provinsi Belum Dipilih!']);
        }elseif ($kabupaten_id==0){
            return response()->json(['status'=>2, 'msg'=>'Data Kabupaten Dipilih!']);
        }elseif ($kecamatan_id==0){
            return response()->json(['status'=>3, 'msg'=>'Data Kecamatan Dipilih!']);
        }elseif ($desa_id==0){
            return response()->json(['status'=>4, 'msg'=>'Data Desa Dipilih!']);
        }else{
            $lokasi = new MasterBts();
            $lokasi->nama_master = $nama;
            $lokasi->provinsi_id = $provinsi_id;
            $lokasi->kabupaten_id = $kabupaten_id;
            $lokasi->kecamatan_id = $kecamatan_id;
            $lokasi->desa_id = $desa_id;
            $lokasi->longitude = $long;
            $lokasi->latitude = $lat;

            $getprovinsi = Province::query()->find($provinsi_id);
            $provinsi = $getprovinsi->name;

            $getkabupaten = Regency::query()->find($kabupaten_id);
            $kabupaten = $getkabupaten->name;

            $getkecamatan = District::query()->find($kecamatan_id);
            $kecamatan = $getkecamatan->name;

            $getdesa = Village::query()->find($desa_id);
            $desa = $getdesa->name;

            $lengkap = array($desa,$kecamatan,$kabupaten,$provinsi);
            $lokasi->nama_lokasi = implode(", ",$lengkap);
            $lokasi->save();
        }
    }

    public function edit_lokasi($id_lokasi){
        $lokasi = MasterBts::find($id_lokasi);
        $provinsi =Province::all();

        return view('dashboard.admin.lokasi.edit_lokasi', compact('lokasi','provinsi'));
    }

    public function post_edit_lokasi(Request $request){
        $nama = $request->nama;
        $provinsi_id = $request->provinsi;
        $kabupaten_id = $request->kabupaten;
        $kecamatan_id = $request->kecamatan;
        $desa_id = $request->desa;
        $koordinat = $request->koordinat;

        if ($koordinat==null){
            $long=null;
            $lat=null;
        }else{
            $ll = explode(",",$koordinat);
            $long = $ll[1];
            $lat = $ll[0];
        }
        $id_lokasi = $request->id_lokasi;

        if ($provinsi_id==0){
            return response()->json(['status'=>1, 'msg'=>'Data Provinsi Belum Dipilih!']);
        }elseif ($kabupaten_id==0){
            return response()->json(['status'=>2, 'msg'=>'Data Kabupaten Dipilih!']);
        }elseif ($kecamatan_id==0){
            return response()->json(['status'=>3, 'msg'=>'Data Kecamatan Dipilih!']);
        }elseif ($desa_id==0){
            return response()->json(['status'=>4, 'msg'=>'Data Desa Dipilih!']);
        }else{
            $lokasi = MasterBts::query()->find($id_lokasi);
            $lokasi->nama_master = $nama;
            $lokasi->provinsi_id = $provinsi_id;
            $lokasi->kabupaten_id = $kabupaten_id;
            $lokasi->kecamatan_id = $kecamatan_id;
            $lokasi->desa_id = $desa_id;
            $lokasi->longitude = $long;
            $lokasi->latitude = $lat;

            $getprovinsi = Province::query()->find($provinsi_id);
            $provinsi = $getprovinsi->name;

            $getkabupaten = Regency::query()->find($kabupaten_id);
            $kabupaten = $getkabupaten->name;

            $getkecamatan = District::query()->find($kecamatan_id);
            $kecamatan = $getkecamatan->name;

            $getdesa = Village::query()->find($desa_id);
            $desa = $getdesa->name;

            $lengkap = array($desa,$kecamatan,$kabupaten,$provinsi);
            $lokasi->nama_lokasi = implode(", ",$lengkap);
            $lokasi->save();

        }
    }

    public function bts_index(){
        $btss = Bts::query()->paginate(10);

        return view('dashboard.admin.bts.index', compact('btss'));
    }

    public function tambah_bts(){
        $bts = new Bts();
        $lokasis = MasterBts::all();
        $jeniss = JenisBts::all();
        $kategoris = Kategori::all();

        return view('dashboard.admin.bts.tambah_bts', compact('bts','lokasis', 'jeniss', 'kategoris'));
    }

    public function post_tambah_bts(Request $request){
        $nama = $request->nama;
        $lokasi_id = $request->lokasi;
        $jenis_id = $request->jenis;
        $kategori_id = $request->k_frekuensi;
        $frekuensi = $request->frekuensi;
        $ssid = $request->ssid;
        $ip = $request->ip;

        if ($jenis_id == 0){
            return redirect()->back()
                ->with('error','Jenis BTS belum dipilih.');
        }elseif ($kategori_id == 0){
            return redirect()->route('admin.tambahbts')
                ->with('error','Kategori Frekuensi belum dipilih.');
        }elseif ($lokasi_id == 0){
            return redirect()->route('admin.tambahbts')
                ->with('error','Lokasi BTS belum dipilih.');
        }else{
            $bts = new Bts();
            $bts->nama_bts = $nama;
            $bts->lokasi_id = $lokasi_id;
            $bts->jenis_id = $jenis_id;
            $bts->kategori_id = $kategori_id;
            $bts->frekuensi = $frekuensi;
            $bts->ssid = $ssid;
            $bts->ip = $ip;

            $bts->status_id = 3;

            $bts->save();
            return redirect()->route('admin.bts')
                ->with('success','Perangkat BTS berhasil ditambahkan.');
        }
    }

    public function edit_bts($id_bts){
        $bts = Bts::find($id_bts);
        $lokasis = MasterBts::all();
        $jeniss = JenisBts::all();
        $kategoris = Kategori::all();

        return view('dashboard.admin.bts.edit_bts', compact('bts','lokasis', 'jeniss', 'kategoris'));
    }

    public function post_edit_bts(Request $request ,$id_bts){
        $nama = $request->nama;
        $lokasi_id = $request->lokasi;
        $jenis_id = $request->jenis;
        $kategori_id = $request->k_frekuensi;
        $frekuensi = $request->frekuensi;
        $ssid = $request->ssid;
        $ip = $request->ip;

        if ($jenis_id == 0){
            return redirect()->back()
                ->with('error','Jenis BTS belum dipilih.');
        }elseif ($kategori_id == 0){
            return redirect()->route('admin.tambahbts')
                ->with('error','Kategori Frekuensi belum dipilih.');
        }elseif ($lokasi_id == 0){
            return redirect()->route('admin.tambahbts')
                ->with('error','Lokasi BTS belum dipilih.');
        }else{
            $bts = Bts::query()->find($id_bts);
            $bts->nama_bts = $nama;
            $bts->lokasi_id = $lokasi_id;
            $bts->jenis_id = $jenis_id;
            $bts->kategori_id = $kategori_id;
            $bts->frekuensi = $frekuensi;
            $bts->ssid = $ssid;
            $bts->ip = $ip;

            $bts->status_id = 3;

            $bts->save();
            return redirect()->route('admin.bts')
                ->with('success','Perangkat '.$nama.' berhasil diubah.');
        }
    }

    public function nonaktif_bts($id_bts)
    {
        $bts = Bts::find($id_bts);
        $nama = $bts->nama_bts;
        $bts->status_id = 4;
        $bts->save();

        return back()->with('success', $nama.' telah dinonaktifkan!');
    }

    public function aktif_bts($id_bts)
    {
        $bts = Bts::find($id_bts);
        $nama = $bts->nama_bts;
        $bts->status_id = 3;
        $bts->save();

        return back()->with('success', $nama.' telah diaktifkan!');
    }

    public function frek_index(){
        $freks = Kategori::query()->paginate(10);

        return view('dashboard.admin.frekuensi.index', compact('freks'));
    }

    public function tambah_frek(){
        $frek = new Kategori();

        return view('dashboard.admin.frekuensi.tambah_frekuensi', compact('frek'));
    }

    public function post_tambah_frek(Request $request){
        $frek = new Kategori();
        $frek->kategori_frekuensi = $request->kat_frek;

        $frek->save();

        return redirect()->route('admin.frek')
            ->with('success','Frekuensi berhasil ditambahkan.');
    }

    public function edit_frek($id_frek){
        $frek = Kategori::query()->find($id_frek);

        return view('dashboard.admin.frekuensi.edit_frekuensi', compact('frek'));
    }

    public function post_edit_frek(Request $request ,$id_frek){
        $frek = Kategori::query()->find($id_frek);
        $frek->kategori_frekuensi = $request->kat_frek;

        $frek->save();

        return redirect()->route('admin.frek')
            ->with('success','Frekuensi berhasil diubah.');
    }

    public function jenis_index(){
        $jeniss = JenisBts::query()->paginate(10);

        return view('dashboard.admin.jenis.index', compact('jeniss'));
    }

    public function tambah_jenis(){
        $jenis = new JenisBts();

        return view('dashboard.admin.jenis.tambah_jenis', compact('jenis'));
    }

    public function post_tambah_jenis(Request $request){
        $jenis = new JenisBts();
        $jenis->nama_perangkat = $request->n_perangkat;

        $jenis->save();

        return redirect()->route('admin.jenis')
            ->with('success','Jenis BTS berhasil ditambahkan.');
    }

    public function edit_jenis($id_jenis){
        $jenis = JenisBts::query()->find($id_jenis);

        return view('dashboard.admin.jenis.edit_jenis', compact('jenis'));
    }

    public function post_edit_jenis(Request $request ,$id_jenis){
        $jenis = JenisBts::query()->find($id_jenis);
        $jenis->nama_perangkat = $request->n_perangkat;

        $jenis->save();

        return redirect()->route('admin.jenis')
            ->with('success','Jenis BTS berhasil diubah.');
    }

    public function metode_index(){
        $metodes = Metode::query()->paginate(10);

        return view('dashboard.admin.metode.index', compact('metodes'));
    }

    public function tambah_metode(){
        $metode = new Metode();

        return view('dashboard.admin.metode.tambah_metode', compact('metode'));
    }

    public function post_tambah_metode(Request $request){
        $metode = new Metode();
        $metode->nama_metode = $request->n_metode;

        $metode->save();

        return redirect()->route('admin.metode')
            ->with('success','Metode Pembayaran berhasil ditambahkan.');
    }

    public function edit_metode($id_metode){
        $metode = Metode::query()->find($id_metode);

        return view('dashboard.admin.metode.edit_metode', compact('metode'));
    }

    public function post_edit_metode(Request $request ,$id_metode){
        $metode = Metode::query()->find($id_metode);
        $metode->nama_metode = $request->n_metode;

        $metode->save();

        return redirect()->route('admin.metode')
            ->with('success','Metode Pembayaran berhasil diubah.');
    }

    public function bank_index(){
        $banks = Bank::query()->paginate(10);

        return view('dashboard.admin.bank.index', compact('banks'));
    }

    public function tambah_bank(){
        $bank = new Bank();

        return view('dashboard.admin.bank.tambah_bank', compact('bank'));
    }

    public function post_tambah_bank(Request $request){
        $bank = new Bank();
        $bank->nama_bank = $request->n_bank;

        $bank->save();

        return redirect()->route('admin.bank')
            ->with('success','Kategori Bank berhasil ditambahkan.');
    }

    public function edit_bank($id_bank){
        $bank = Bank::query()->find($id_bank);

        return view('dashboard.admin.bank.edit_bank', compact('bank'));
    }

    public function post_edit_bank(Request $request ,$id_bank){
        $bank = Bank::query()->find($id_bank);
        $bank->nama_bank = $request->n_bank;

        $bank->save();

        return redirect()->route('admin.bank')
            ->with('success','Kategori Bank berhasil diubah.');
    }
    //get ajax
    public function getKabupatenlok(Request $request, $idlok)
    {
        $id_provinsi = $request->id_provinsi;
        $lok = MasterBts::query()->find($idlok);
        $selected = $lok->kabupaten_id;

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

    public function getKecamatanlok(Request $request, $idlok)
    {
        $id_kabupaten = $request->id_kabupaten;
        $lok = MasterBts::query()->find($idlok);
        $selected = $lok->kecamatan_id;

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

    public function getDesalok(Request $request, $idlok)
    {
        $id_kecamatan = $request->id_kecamatan;
        $lok = MasterBts::query()->find($idlok);
        $selected = $lok->desa_id;

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
