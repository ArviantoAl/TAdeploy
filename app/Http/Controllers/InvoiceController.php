<?php

namespace App\Http\Controllers;

use App\Exports\InvoiceExport;
use App\Helper\LogActivity;
use App\Mail\Invoice;
use App\Mail\MailPelanggan;
use App\Models\Bank;
use App\Models\Bts;
use App\Models\Invoice as Invoices;
use App\Models\Langganan;
use App\Models\Langinv;
use App\Models\Layanan;
use App\Models\Metode;
use App\Models\Ppn;
use App\Models\ProfilCv;
use App\Models\Status;
use App\Models\TurunanBts;
use App\Models\User;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{
    public function data_invoice(Request $request){
        $bulannow=Carbon::now()->format('n');
        $bulan2=Carbon::now()->format('F');
        $tahunnow=Carbon::now()->format('Y');
        $metodes = Metode::all();
        $banks = Bank::all();

        if(auth()->user()->user_role==3){
            $user = Auth::user()->id_user;
            $invoices = Invoices::query()->where('pelanggan_id', '=', $user)
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        }else{
            if ($request->has('bulan') && $request->has('tahun')){
                $invoices = Invoices::query()
                    ->where('bulan', '=', $request->bulan)
                    ->where('tahun', '=', $request->tahun)
                    ->orderBy('created_at', 'DESC')
                    ->paginate(10);
                $selected = $request->bulan;
                $selected2 = $request->tahun;
            }else{
                $invoices = Invoices::query()
                    ->where('bulan', '=', $bulannow)
                    ->where('tahun', '=', $tahunnow)
                    ->orderBy('created_at', 'DESC')
                    ->paginate(10);
                $selected = $bulan2;
                $selected2 = $tahunnow;
            }
        }
        $invoices->appends($request->all());

        $getall = Invoices::query()->orderBy('tgl_terbit', 'DESC')->get();
        $databulan = $getall->groupBy(function ($getall){
            return Carbon::parse($getall->tgl_terbit)->format('F');
        });
        $valbulan = $getall->groupBy(function ($getall){
            return Carbon::parse($getall->tgl_terbit)->format('n');
        });
        $datatahun = $getall->groupBy(function ($getall){
            return Carbon::parse($getall->tgl_terbit)->format('Y');
        });

        $bulan = [];
        $vabulan = [];
        $tahun = [];
        foreach ($databulan as $nbulan => $values){
            $bulan[] = $nbulan;
        }
        foreach ($valbulan as $vbulan => $values){
            $vabulan[] = $vbulan;
        }
        foreach ($datatahun as $ntahun => $values){
            $tahun[] = $ntahun;
        }

        if (auth()->user()->user_role==1){
            return view('dashboard.admin.invoice', compact('banks','invoices', 'selected2', 'selected', 'bulan', 'vabulan', 'tahun', 'metodes'));
        }elseif(auth()->user()->user_role==2){
            return view('dashboard.teknisi.invoice', compact('invoices'));
        }elseif(auth()->user()->user_role==3){
            $subject = 'Pelanggan, Daftar Invoice';
            LogActivity::addToLog($subject);
            return view('dashboard.pelanggan.invoice', compact('invoices','metodes','banks'));
        }
    }

    public function kirim_balik(Request $request){
        $bulans=Carbon::now()->format('n');
        $tahun=Carbon::now()->format('Y');
        $bank = Bank::all();
        $tgl_tempo=$request->tempo;

        $datas = Langganan::query()
            ->where('status_id', '=', 3)
            ->get();

        foreach($datas as $data){
            $pelanggan_id = $data->pelanggan_id;
            $layanan_id = $data->layanan_id;
            $langganan_id = $data->id_langganan;

            $getuser = User::query()->find($pelanggan_id);
            $nama_pelanggan = $getuser->name;
            $email_pelanggan = $getuser->email;
            $username_pelanggan = $getuser->username;
            $hppn = $getuser->ppn;

            $getppn = Ppn::query()
                ->where('tahun','=',$tahun)
                ->get()
                ->toArray();
            $objectToArray = (array)$getppn;
            $ppn1 = $objectToArray[0];
            $ppn2 = (array)$ppn1;
            $jppn = $ppn2['jumlah'];

            if ($hppn=='1'){
                $getppn2 = $jppn;
            }else{
                $getppn2 = 0;
            }

            $getlayanan = Layanan::query()->find($layanan_id);
            $harga = $getlayanan->harga;

            $cekinvoice = Invoices::query()
                ->where('pelanggan_id', '=', $pelanggan_id)
                ->where('status_id', '=', 6)
                ->where('bulan', '=', $bulans)
                ->where('tahun', '=', $tahun)
                ->get();

            DB::table('langganans')
                ->where('id_langganan', '=', $langganan_id)
                ->update([
                    'status_id'=>2,
                ]);

            $tgl_terbit = Carbon::now()->setTimezone('Asia/Jakarta');

            if (count($cekinvoice)==0){
                $huruf = 'INV';
                $acak1 = rand(10, 99);
                $acak2 = rand(10, 99);
                $invn = array($huruf,$acak1,$pelanggan_id,$acak2,$bulans,$tahun);
                $inv3 = implode($invn);

                $invoice = new Invoices();
                $invoice->id_invoice = $inv3;
                $invoice->pelanggan_id = $pelanggan_id;
                $invoice->tgl_terbit = $tgl_terbit;
                $invoice->tgl_tempo = $tgl_tempo;
                $invoice->harga_bayar = 0;
                $invoice->tagihan = 0;
                $invoice->bulan = $bulans;
                $invoice->tahun = $tahun;
                $invoice->ppn = $getppn2;
                $invoice->status_id = 6;
                $invoice->bukti_bayar = null;
                $invoice->save();
            }else{
                $getinvoice2 = Invoices::query()
                    ->where('pelanggan_id', '=', $pelanggan_id)
                    ->where('bulan', '=', $bulans)
                    ->where('status_id', '=', 6)
                    ->where('tahun', '=', $tahun)
                    ->get()
                    ->toArray();
                $objectToArray = (array)$getinvoice2;
                $inv12 = $objectToArray[0];
                $inv22 = (array)$inv12;
                $inv3 = $inv22['id_invoice'];
            }

            $langinv = new Langinv();
            $langinv->invoice_id = $inv3;
            $langinv->pelanggan_id = $pelanggan_id;
            $langinv->layanan_id = $layanan_id;
            $langinv->langganan_id = $langganan_id;
            $langinv->harga_satuan = $harga;
            $langinv->status_id = 6;
            $langinv->save();

            $gettagihan = DB::table('langganan_invoices')
                ->where('invoice_id', '=', $inv3)
                ->where('status_id', '=', 6)
                ->sum('harga_satuan');

            $hargappn2 = $gettagihan*$getppn2/100;
            $hargatagihan = $gettagihan+$hargappn2;

            DB::table('invoices')
                ->where('id_invoice', '=', $inv3)
                ->update([
                    'status_id'=>6,
                    'harga_bayar' => $hargatagihan,
                    'tagihan' => $hargatagihan,
                    'bulan' => $bulans,
                    'tahun' => $tahun,
                ]);

            $langganans = Langinv::query()
                ->where('pelanggan_id', '=', $pelanggan_id)
                ->where('invoice_id', '=', $inv3)
                ->get();

//            $cv = ProfilCv::query()->find(1);
//            $data_ambil = [
//                'email_cv' => $cv->email_cv,
//                'nama_cv' => $cv->nama_cv,
//                'alamat' => $cv->alamat,
//                'no_hp' => $cv->no_hp,
//                'nama_pelanggan' => $nama_pelanggan,
//                'email_pelanggan' => $email_pelanggan,
//                'no_hp_pelanggan' => $username_pelanggan,
//                'id_invoice' => $inv3,
//                'tgl_terbit' => $tgl_terbit,
//                'tgl_tempo' => $tgl_tempo,
//                'harga_bayar' => $hargatagihan,
//                'langganans' => $langganans,
//                'subtotal' => $gettagihan,
//                'ppn' => $getppn2,
//                'hargappn' => $hargappn2,
//                'bank' => $bank,
//            ];
//            $datas2 = Langganan::query()
//                ->where('status_id', '=', 3)
//                ->get();
//            if (count($datas2)==0){
//                Mail::to($email_pelanggan)->send(new Invoice($data_ambil));
//            }
        }
        DB::table('profilcv')
            ->where('id_profil', '=', 1)
            ->update([
                'terakhir_generate'=>$bulans,
            ]);
        return back()->with('success', 'Invoice telah terkirim semua!');
    }

    public function setujui_pembayaran($id_invoice)
    {
        $invoices = Invoices::query()->find($id_invoice);
        $id_pelanggan = $invoices->pelanggan_id;
        $user = User::query()->find($id_pelanggan);
        $nama2 = $user->name;

        $invoices->status_id = 8;
        $invoices->tagihan = 0;
        $invoices->save();

        $tgl_aktif = Carbon::now()->setTimezone('Asia/Jakarta');

        $datas = Langganan::query()->where('pelanggan_id', '=', $id_pelanggan)
            ->where('status_id', '=', 10)
            ->get();

        foreach($datas as $data){
            $langganan_id = $data->id_langganan;
            $desa = $data->desa_id;
            $kecamatan = $data->kecamatan_id;
            $kabupaten = $data->kabupaten_id;
            $provinsi = $data->provinsi_id;
            $detail_alamat = $data->detail_alamat;
            $alamat_pasang = $data->alamat_pasang;
            $bts_id = $data->bts_id;
            $ip = $data->ip;
            $long = $data->longitude;
            $lat = $data->latitude;
            $getturunan = $data->turunan_id;

            if ($getturunan != null){
                $turunan_id = $getturunan;
                DB::table('turunan_bts')
                    ->where('id_turunan', '=', $turunan_id)
                    ->update([
                        'status_id'=>3,
                    ]);
            }

            $getbts = Bts::query()->find($bts_id);
            $frekuensi = $getbts->frekuensi;

            $getdesa = Village::query()->find($desa);
            $nama3 = $getdesa->name;

            $arrnama = array($nama2,$nama3);
            $nama = implode("-",$arrnama);
            $ssid = implode("_",$arrnama);

            $gettbts = TurunanBts::query()->where('langganan_id', '=', $langganan_id)->get();
            if (count($gettbts)==0){
                $tbts = new TurunanBts();
                $tbts->bts_id = $bts_id;
                $tbts->langganan_id = $langganan_id;
                $tbts->nama_turunan = $nama;
                $tbts->ssid = $ssid;
                $tbts->provinsi_id = $provinsi;
                $tbts->kabupaten_id = $kabupaten;
                $tbts->kecamatan_id = $kecamatan;
                $tbts->desa_id = $desa;
                $tbts->detail_alamat = $detail_alamat;
                $tbts->alamat_pasang = $alamat_pasang;
                $tbts->frekuensi = $frekuensi;
                $tbts->ip = $ip;
                $tbts->longitude = $long;
                $tbts->latitude = $lat;
                $tbts->status_id = 2;

                $tbts->save();
            }
        }

        DB::table('langganans')
            ->where('pelanggan_id', '=', $id_pelanggan)
            ->where('status_id', '=', 10)
            ->update([
                'status_id'=>3,
                'tgl_aktif' => $tgl_aktif,
            ]);
        DB::table('users')
            ->where('id_user', '=', $id_pelanggan)
            ->where('status_id', '=', 2)
            ->update([
                'status_id'=>3,
            ]);
        DB::table('langganan_invoices')
            ->where('pelanggan_id', '=', $id_pelanggan)
            ->where('invoice_id', '=', $id_invoice)
            ->where('status_id', '=', 7)
            ->update([
                'status_id'=>8,
            ]);
        return redirect()->route('admin.invoice')->with('success', 'Invoice '.$id_invoice.' telah disetujui!');
    }

    public function setujui_manual(Request $request, $id_invoice)
    {
        $metode = $request->metode;
        $bank = $request->bank;
        if ($metode==0){
            return back()->with('success', 'Metode Pembayaran belum dipilih!');
        }elseif ($bank==0 && $metode==2){
            return back()->with('success', 'Kategori Bank belum dipilih!');
        }else{
            $tgl_bayar = Carbon::now()->setTimezone('Asia/Jakarta');
            $invoices = Invoices::query()->find($id_invoice);
            $id_pelanggan = $invoices->pelanggan_id;
            $user = User::query()->find($id_pelanggan);
            $nama2 = $user->name;

            $invoices->status_id = 8;
            $invoices->tgl_bayar = $tgl_bayar;
            if ($request->has('ket')){
                $invoices->keterangan = $request->ket;
            }
            if ($bank!=0){
                $invoices->bank_id = $request->bank;
            }
            $invoices->metode_id = $request->metode;
            $invoices->tagihan = 0;
            $invoices->save();

            $tgl_aktif = Carbon::now()->setTimezone('Asia/Jakarta');

            $datas = Langganan::query()->where('pelanggan_id', '=', $id_pelanggan)
                ->where('status_id', '=', 2)
                ->get();

            foreach($datas as $data){
                $langganan_id = $data->id_langganan;
                $desa = $data->desa_id;
                $kecamatan = $data->kecamatan_id;
                $kabupaten = $data->kabupaten_id;
                $provinsi = $data->provinsi_id;
                $detail_alamat = $data->detail_alamat;
                $alamat_pasang = $data->alamat_pasang;
                $bts_id = $data->bts_id;
                $ip = $data->ip;
                $long = $data->longitude;
                $lat = $data->latitude;
                $getturunan = $data->turunan_id;

                if ($getturunan != null){
                    $turunan_id = $getturunan;
                    DB::table('turunan_bts')
                        ->where('id_turunan', '=', $turunan_id)
                        ->update([
                            'status_id'=>3,
                        ]);
                }

                $getbts = Bts::query()->find($bts_id);
                $frekuensi = $getbts->frekuensi;

                $getdesa = Village::query()->find($desa);
                $nama3 = $getdesa->name;

                $arrnama = array($nama2,$nama3);
                $nama = implode("-",$arrnama);
                $ssid = implode("_",$arrnama);

                $gettbts = TurunanBts::query()->where('langganan_id', '=', $langganan_id)->get();
                if (count($gettbts)==0){
                    $tbts = new TurunanBts();
                    $tbts->bts_id = $bts_id;
                    $tbts->langganan_id = $langganan_id;
                    $tbts->nama_turunan = $nama;
                    $tbts->ssid = $ssid;
                    $tbts->provinsi_id = $provinsi;
                    $tbts->kabupaten_id = $kabupaten;
                    $tbts->kecamatan_id = $kecamatan;
                    $tbts->desa_id = $desa;
                    $tbts->detail_alamat = $detail_alamat;
                    $tbts->alamat_pasang = $alamat_pasang;
                    $tbts->frekuensi = $frekuensi;
                    $tbts->ip = $ip;
                    $tbts->longitude = $long;
                    $tbts->latitude = $lat;
                    $tbts->status_id = 2;

                    $tbts->save();
                }
            }

            DB::table('langganans')
                ->where('pelanggan_id', '=', $id_pelanggan)
                ->where('status_id', '=', 2)
                ->update([
                    'status_id'=>3,
                    'tgl_aktif' => $tgl_aktif,
                ]);
            DB::table('users')
                ->where('id_user', '=', $id_pelanggan)
                ->where('status_id', '=', 2)
                ->update([
                    'status_id'=>3,
                ]);
            DB::table('langganan_invoices')
                ->where('pelanggan_id', '=', $id_pelanggan)
                ->where('invoice_id', '=', $id_invoice)
                ->where('status_id', '=', 6)
                ->update([
                    'status_id'=>8,
                ]);
            return redirect()->route('admin.invoice')->with('success', 'Invoice '.$id_invoice.' telah disetujui!');
        }
    }

    public function tolak_pembayaran($id_invoice)
    {
        $invoices = Invoices::query()->find($id_invoice);
        $id_pelanggan = $invoices->pelanggan_id;

        $invoices->status_id = 9;
        $invoices->tagihan = 0;
        $invoices->save();

        $tgl_aktif = Carbon::now()->setTimezone('Asia/Jakarta');

        DB::table('langganans')
            ->where('pelanggan_id', '=', $id_pelanggan)
            ->where('status_id', '=', 10)
            ->update([
                'status_id'=>4,
                'tgl_aktif' => $tgl_aktif,
            ]);
        DB::table('langganan_invoices')
            ->where('pelanggan_id', '=', $id_pelanggan)
            ->where('invoice_id', '=', $id_invoice)
            ->where('status_id', '=', 7)
            ->update([
                'status_id'=>9,
            ]);
        return redirect()->route('admin.invoice')->with('success', 'Invoice '.$id_invoice.' tidak dibayar!');
    }

    public function print_invoice($id_invoice){
        $bank = Bank::all();
        $invoice = Invoices::find($id_invoice);
        $status = $invoice->status_id;
        $ppn = $invoice->ppn;
        $tgl_terbit = $invoice->tgl_terbit;
        $tgl_bayar = $invoice->tgl_bayar;
        $tgl_tempo = $invoice->tgl_tempo;

        $pelanggan_id = $invoice->pelanggan_id;
        $getuser = User::query()->find($pelanggan_id);
        $nama_pelanggan = $getuser->name;
        $email_pelanggan = $getuser->email;
        $username_pelanggan = $getuser->username;

        $gettagihan = DB::table('langganan_invoices')
            ->where('invoice_id', '=', $id_invoice)
            ->sum('harga_satuan');

        $hargappn = $gettagihan*$ppn/100;
        $hgettagihan = $gettagihan+$hargappn;
        $hargatagihan = $hgettagihan;

        $langganans = Langinv::query()
            ->where('pelanggan_id', '=', $pelanggan_id)
            ->where('invoice_id', '=', $id_invoice)
            ->get();

        $cv = ProfilCv::query()->find(1);
        $data_ambil = [
            'cv' => $cv,
            'status' => $status,
            'nama_pelanggan' => $nama_pelanggan,
            'email_pelanggan' => $email_pelanggan,
            'no_hp_pelanggan' => $username_pelanggan,
            'id_invoice' => $id_invoice,
            'tgl_terbit' => $tgl_terbit,
            'tgl_bayar' => $tgl_bayar,
            'tgl_tempo' => $tgl_tempo,
            'harga_bayar' => $hargatagihan,
            'subtotal' => $gettagihan,
            'hargappn' => $hargappn,
            'langganans' => $langganans,
            'ppn' => $ppn,
            'bank' => $bank
        ];

        if (auth()->user()->user_role==1){
            return view('dashboard.admin.print.invoice', compact('data_ambil'));
        }elseif(auth()->user()->user_role==2){
            return view('dashboard.teknisi.print.invoice', compact('data_ambil'));
        }elseif(auth()->user()->user_role==3){
            $subject = 'Pelanggan, Cetak Detail Invoice '.$id_invoice;
            LogActivity::addToLog($subject);
            return view('dashboard.pelanggan.print_invoice', compact('data_ambil'));
        }
    }

    public function bukti(Request $request, $id_inv){
        $request->validate([
            'bukti' => 'mimes:jpeg,png,bmp,tiff |max:4096',
        ]);
        $metode = $request->metode;
        $bank = $request->bank;

        if ($metode==0){
            return back()->with('success', 'Metode Pembayaran belum dipilih!');
        }elseif($bank==0){
            return back()->with('success', 'Kategori bank belum dipilih!');
        }else{
            $tgl_bayar = Carbon::now()->setTimezone('Asia/Jakarta');

            $bukti1 = $request->file('bukti');
            $name1 = $bukti1->getClientOriginalName();

            $lengkap = array($id_inv,$name1);
            $name = implode($lengkap);

            $invoice = Invoices::find($id_inv);
            $pelanggan_id = $invoice->pelanggan_id;
            $user = User::query()->find($pelanggan_id);
            $nama = $user->name;
            $email = $user->email;

            $invoice->bukti_bayar = $name;
            $invoice->status_id = 7;
            $invoice->tgl_bayar = $tgl_bayar;
            $invoice->metode_id = $request->metode;
            $invoice->bank_id = $request->bank;
            if ($request->has('ket')){
                $invoice->keterangan = $request->ket;
            }
            $invoice->save();

            DB::table('langganans')
                ->where('pelanggan_id', '=', $pelanggan_id)
                ->where('status_id', '=', 2)
                ->update([
                    'status_id'=>10,
                ]);

            DB::table('langganan_invoices')
                ->where('invoice_id', '=', $id_inv)
                ->where('status_id', '=', 6)
                ->update([
                    'status_id'=>7,
                ]);

            $bukti1->move('bukti_bayar', $name);

            $metode = $invoice->metode->nama_metode;
            $bank = $invoice->bank->nama_bank;
//            $data_ambil = [
//                'email' => $email,
//                'subject' => 'Unggah Bukti Pembayaran',
//                'nama' => $nama,
//                'id_invoice' => $id_inv,
//                'metode' => $metode,
//                'bank' => $bank,
//            ];
//            $cv = ProfilCv::query()->find(1);
//            $toemail = $cv->email_cv;
//            Mail::to($toemail)->send(new MailPelanggan($data_ambil));

            $subject = 'Pelanggan, Unggah Bukti';
            LogActivity::addToLog($subject);

            return back()->with('success', 'Bukti Invoice '.$id_inv.' berhasil diunggah!');
        }
    }

    public function klaim($id_inv){

        $invoice = Invoices::find($id_inv);
        $pelanggan_id = $invoice->pelanggan_id;
        $user = User::query()->find($pelanggan_id);
        $nama = $user->name;
        $email = $user->email;

        $invoice->status_id = 11;
        $invoice->save();

        DB::table('langganans')
            ->where('pelanggan_id', '=', $pelanggan_id)
            ->where('status_id', '=', 4)
            ->update([
                'status_id'=>11,
            ]);

        DB::table('langganan_invoices')
            ->where('invoice_id', '=', $id_inv)
            ->where('status_id', '=', 9)
            ->update([
                'status_id'=>11,
            ]);

//        $data_ambil = [
//            'email' => $email,
//            'subject' => 'Ajuan Unggah Ulang Bukti',
//            'nama' => $nama,
//            'id_invoice' => $id_inv,
//        ];
//        $cv = ProfilCv::query()->find(1);
//        $toemail = $cv->email_cv;
//        Mail::to($toemail)->send(new MailPelanggan($data_ambil));

        $subject = 'Pelanggan, Ajukan Klaim Unggah Ulang';
        LogActivity::addToLog($subject);

        return back()->with('success', 'Invoice '.$id_inv.' berhasil diajukan untuk unggah ulang bukti!');
    }

    public function approve_klaim($id_inv){

        $invoice = Invoices::find($id_inv);
        $pelanggan_id = $invoice->pelanggan_id;
        $user = User::query()->find($pelanggan_id);
        $nama = $user->name;
        $toemail = $user->email;

        $invoice->status_id = 6;
        $invoice->save();

        DB::table('langganans')
            ->where('pelanggan_id', '=', $pelanggan_id)
            ->where('status_id', '=', 11)
            ->update([
                'status_id'=>2,
            ]);

        DB::table('langganan_invoices')
            ->where('invoice_id', '=', $id_inv)
            ->where('status_id', '=', 11)
            ->update([
                'status_id'=>6,
            ]);

//        $cv = ProfilCv::query()->find(1);
//        $email = $cv->email_cv;
//        $data_ambil = [
//            'email' => $email,
//            'subject' => 'Disetujui Unggah Ulang Bukti',
//            'nama' => $nama,
//            'id_invoice' => $id_inv,
//        ];
//        Mail::to($toemail)->send(new MailPelanggan($data_ambil));

        return back()->with('success', 'Invoice '.$id_inv.' berhasil disetujui untuk mengunggah ulang bukti!');
    }

    public function export(Request $request){
        $invoices = Invoices::query()
            ->where('bulan', '=', $request->bulan)
            ->where('tahun', '=', $request->tahun)
            ->get();

        $data = [];
        foreach ($invoices as $invoice){
            $id = $invoice->id_invoice;
            $pelanggan_id = $invoice->pelanggan_id;
            $totalinv = $invoice->harga_bayar;
            $tagihan = $invoice->tagihan;
            $tgl_terbit = $invoice->tgl_terbit;
            $tgl_bayar = $invoice->tgl_bayar;
            $tgl_tempo = $invoice->tgl_tempo;
            $id_status = $invoice->status_id;

            $total_harga2 = "Rp " . number_format($totalinv,2,',','.');
            $total_tagihan2 = "Rp " . number_format($tagihan,2,',','.');

            $status2 = Status::query()->find($id_status);
            $status = $status2->nama_status;

            $pelanggan = User::query()->find($pelanggan_id);
            $nama = $pelanggan->name;
            $data[] = [
                'Id Invoice' => $id,
                'Nama Pelanggan' => $nama,
                'Total Harga Invoice' => $total_harga2,
                'Tanggal Terbit' => $tgl_terbit,
                'Tanggal Tempo' => $tgl_tempo,
                'Tanggal Bayar' => $tgl_bayar,
                'Status' => $status,
            ];
        }
        return Excel::download(new InvoiceExport($data), 'invoice.xlsx');
    }
}
