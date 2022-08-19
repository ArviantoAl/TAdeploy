<?php

namespace App\Http\Controllers;

use App\Exports\JumlahExport;
use App\Helper\LogActivity;
use App\Models\Invoice;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function index(){
        $bulannow=Carbon::now()->format('n');
        $bulan2=Carbon::now()->format('F');
        $tahunnow=Carbon::now()->format('Y');

        $selected = $bulan2;
        $selected2 = $tahunnow;

        $getall = Invoice::query()->orderBy('tgl_terbit', 'DESC')->get();
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

        $invoice = Invoice::query()
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->get();
        $dibayar = Invoice::query()
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 7)
            ->get();
        $lunas = Invoice::query()
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 8)
            ->get();
        $terbayar = count($dibayar)+count($lunas);
        $belum = Invoice::query()
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 6)
            ->get();
        $klaim = Invoice::query()
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 11)
            ->get();
        $belumbayar = count($belum)+count($klaim);
        $tidakbayar = Invoice::query()
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 9)
            ->get();

        $total = DB::table('invoices')
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->sum('harga_bayar');
        $bel2 = DB::table('invoices')
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 6)
            ->sum('harga_bayar');
        $kla = DB::table('invoices')
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 11)
            ->sum('harga_bayar');
        $bel = $bel2+$kla;
        $di = DB::table('invoices')
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 7)
            ->sum('harga_bayar');
        $lu = DB::table('invoices')
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 8)
            ->sum('harga_bayar');
        $ter = $di+$lu;
        $bat = DB::table('invoices')
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 9)
            ->sum('harga_bayar');

        $h_invoice = count($invoice);
        $h_terbayar = $terbayar;
        $h_belumbayar = $belumbayar;
        $h_tidakbayar = count($tidakbayar);

        $invoice2 = Invoice::query()
            ->where('tahun', '=', $tahunnow)
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

        if (auth()->user()->user_role==1){
            return view('dashboard.admin.index', compact('h_invoice','h_terbayar','h_belumbayar','h_tidakbayar',
                'bulan','vabulan','tahun','selected','selected2','total','bel','ter','bat',
                'namabulans','bulanCount','batas_max','terCount','belCount','batCount'));
        }elseif(auth()->user()->user_role==2){
            return view('dashboard.teknisi.index');
        }elseif(auth()->user()->user_role==3){
            $subject = 'Pelanggan, Dashboard';
            LogActivity::addToLog($subject);
            return view('dashboard.pelanggan.index');
        }
    }

    public function export_filter(Request $request){
        $bulannow = $request->bulan;
        $tahunnow = $request->tahun;
        if ($bulannow==1){
            $namabulan = "Januari";
        }elseif ($bulannow==2){
            $namabulan = "Februari";
        }elseif ($bulannow==3){
            $namabulan = "Maret";
        }elseif ($bulannow==4){
            $namabulan = "April";
        }elseif ($bulannow==5){
            $namabulan = "Mei";
        }elseif ($bulannow==6){
            $namabulan = "Juni";
        }elseif ($bulannow==7){
            $namabulan = "Juli";
        }elseif ($bulannow==8){
            $namabulan = "Agustus";
        }elseif ($bulannow==9){
            $namabulan = "September";
        }elseif ($bulannow==10){
            $namabulan = "Oktober";
        }elseif ($bulannow==11){
            $namabulan = "November";
        }elseif ($bulannow==12){
            $namabulan = "Desember";
        }

        $invoice = Invoice::query()
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->get();
        $dibayar = Invoice::query()
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 7)
            ->get();
        $lunas = Invoice::query()
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 8)
            ->get();
        $terbayar = count($dibayar)+count($lunas);
        $belum = Invoice::query()
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 6)
            ->get();
        $klaim = Invoice::query()
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 11)
            ->get();
        $belumbayar = count($belum)+count($klaim);
        $tidakbayar = Invoice::query()
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 9)
            ->get();

        $total = DB::table('invoices')
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->sum('harga_bayar');
        $bel2 = DB::table('invoices')
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 6)
            ->sum('harga_bayar');
        $kla = DB::table('invoices')
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 11)
            ->sum('harga_bayar');
        $bel = $bel2+$kla;
        $di = DB::table('invoices')
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 7)
            ->sum('harga_bayar');
        $lu = DB::table('invoices')
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 8)
            ->sum('harga_bayar');
        $ter = $di+$lu;
        $bat = DB::table('invoices')
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 9)
            ->sum('harga_bayar');
        $utotal = "Rp " . number_format($total,2,',','.');
        $uter = "Rp " . number_format($ter,2,',','.');
        $ubel = "Rp " . number_format($bel,2,',','.');
        $ubat = "Rp " . number_format($bat,2,',','.');

        $h_invoice = count($invoice);
        $h_terbayar = $terbayar;
        $h_belumbayar = $belumbayar;
        $h_tidakbayar = count($tidakbayar);
        $data[] = [
            'Bulan' => $namabulan,
            'Tahun' => $tahunnow,
            'Jumlah Invoice' => $h_invoice,
            'Invoice Terbayar' => $h_terbayar,
            'Invoice Belum Dibayar' => $h_belumbayar,
            'Invoice Tidak Dibayar' => $h_tidakbayar,
            'Total Invoice' => $utotal,
            'Invoice Terbayar(Rp)' => $uter,
            'Invoice Belum Dibayar(Rp)' => $ubel,
            'Invoice Tidak Dibayar(Rp)' => $ubat,
        ];
        return Excel::download(new JumlahExport($data), 'datafilter.xlsx');
    }

    public function export_semua(){
        $invoice2 = Invoice::query()->orderBy('tgl_terbit', 'ASC')->get();
        $invLine = $invoice2->groupBy(function ($inv){
            return Carbon::parse($inv->tgl_terbit)->format('Y');
        });
        $valbulan = $invoice2->groupBy(function ($inv){
            return Carbon::parse($inv->tgl_terbit)->format('n');
        });

        foreach ($invLine as $tahunnow => $values){
            foreach ($valbulan as $bulannow => $values2){
                if ($bulannow==1){
                    $namabulan = "Januari";
                }elseif ($bulannow==2){
                    $namabulan = "Februari";
                }elseif ($bulannow==3){
                    $namabulan = "Maret";
                }elseif ($bulannow==4){
                    $namabulan = "April";
                }elseif ($bulannow==5){
                    $namabulan = "Mei";
                }elseif ($bulannow==6){
                    $namabulan = "Juni";
                }elseif ($bulannow==7){
                    $namabulan = "Juli";
                }elseif ($bulannow==8){
                    $namabulan = "Agustus";
                }elseif ($bulannow==9){
                    $namabulan = "September";
                }elseif ($bulannow==10){
                    $namabulan = "Oktober";
                }elseif ($bulannow==11){
                    $namabulan = "November";
                }elseif ($bulannow==12){
                    $namabulan = "Desember";
                }

                $invoice = Invoice::query()
                    ->where('bulan', '=', $bulannow)
                    ->where('tahun', '=', $tahunnow)
                    ->get();
                $dibayar = Invoice::query()
                    ->where('bulan', '=', $bulannow)
                    ->where('tahun', '=', $tahunnow)
                    ->where('status_id', '=', 7)
                    ->get();
                $lunas = Invoice::query()
                    ->where('bulan', '=', $bulannow)
                    ->where('tahun', '=', $tahunnow)
                    ->where('status_id', '=', 8)
                    ->get();
                $terbayar = count($dibayar)+count($lunas);
                $belum = Invoice::query()
                    ->where('bulan', '=', $bulannow)
                    ->where('tahun', '=', $tahunnow)
                    ->where('status_id', '=', 6)
                    ->get();
                $klaim = Invoice::query()
                    ->where('bulan', '=', $bulannow)
                    ->where('tahun', '=', $tahunnow)
                    ->where('status_id', '=', 11)
                    ->get();
                $belumbayar = count($belum)+count($klaim);
                $tidakbayar = Invoice::query()
                    ->where('bulan', '=', $bulannow)
                    ->where('tahun', '=', $tahunnow)
                    ->where('status_id', '=', 9)
                    ->get();

                $total = DB::table('invoices')
                    ->where('bulan', '=', $bulannow)
                    ->where('tahun', '=', $tahunnow)
                    ->sum('harga_bayar');
                $bel2 = DB::table('invoices')
                    ->where('bulan', '=', $bulannow)
                    ->where('tahun', '=', $tahunnow)
                    ->where('status_id', '=', 6)
                    ->sum('harga_bayar');
                $kla = DB::table('invoices')
                    ->where('bulan', '=', $bulannow)
                    ->where('tahun', '=', $tahunnow)
                    ->where('status_id', '=', 11)
                    ->sum('harga_bayar');
                $bel = $bel2+$kla;
                $di = DB::table('invoices')
                    ->where('bulan', '=', $bulannow)
                    ->where('tahun', '=', $tahunnow)
                    ->where('status_id', '=', 7)
                    ->sum('harga_bayar');
                $lu = DB::table('invoices')
                    ->where('bulan', '=', $bulannow)
                    ->where('tahun', '=', $tahunnow)
                    ->where('status_id', '=', 8)
                    ->sum('harga_bayar');
                $ter = $di+$lu;
                $bat = DB::table('invoices')
                    ->where('bulan', '=', $bulannow)
                    ->where('tahun', '=', $tahunnow)
                    ->where('status_id', '=', 9)
                    ->sum('harga_bayar');

                $utotal = "Rp " . number_format($total,2,',','.');
                $uter = "Rp " . number_format($ter,2,',','.');
                $ubel = "Rp " . number_format($bel,2,',','.');
                $ubat = "Rp " . number_format($bat,2,',','.');

                $h_invoice = count($invoice);
                $h_terbayar = $terbayar;
                $h_belumbayar = $belumbayar;
                $h_tidakbayar = count($tidakbayar);

                $data[] = [
                    'Bulan' => $namabulan,
                    'Tahun' => $tahunnow,
                    'Jumlah Invoice' => $h_invoice,
                    'Invoice Terbayar' => $h_terbayar,
                    'Invoice Belum Dibayar' => $h_belumbayar,
                    'Invoice Tidak Dibayar' => $h_tidakbayar,
                    'Total Invoice' => $utotal,
                    'Invoice Terbayar(Rp)' => $uter,
                    'Invoice Belum Dibayar(Rp)' => $ubel,
                    'Invoice Tidak Dibayar(Rp)' => $ubat,
                ];
            }
        }
        return Excel::download(new JumlahExport($data), 'datasemua.xlsx');
    }
    //getajax
    public function get_ainv(Request $request)
    {
        $bulannow = $request->bulan;
        $tahunnow = $request->tahun;

        $invoice = Invoice::query()
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->get();
        $dibayar = Invoice::query()
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 7)
            ->get();
        $lunas = Invoice::query()
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 8)
            ->get();
        $terbayar = count($dibayar)+count($lunas);
        $belum = Invoice::query()
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 6)
            ->get();
        $klaim = Invoice::query()
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 11)
            ->get();
        $belumbayar = count($belum)+count($klaim);
        $tidakbayar = Invoice::query()
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 9)
            ->get();

        $total = DB::table('invoices')
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->sum('harga_bayar');
        $bel2 = DB::table('invoices')
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 6)
            ->sum('harga_bayar');
        $kla = DB::table('invoices')
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 11)
            ->sum('harga_bayar');
        $bel = $bel2+$kla;
        $di = DB::table('invoices')
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 7)
            ->sum('harga_bayar');
        $lu = DB::table('invoices')
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 8)
            ->sum('harga_bayar');
        $ter = $di+$lu;
        $bat = DB::table('invoices')
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 9)
            ->sum('harga_bayar');

        $h_invoice = count($invoice);
        $h_terbayar = $terbayar;
        $h_belumbayar = $belumbayar;
        $h_tidakbayar = count($tidakbayar);

        return response()->json([
            'h_invoice'=>$h_invoice,
            'h_terbayar'=>$h_terbayar,
            'h_belumbayar'=>$h_belumbayar,
            'h_tidakbayar'=>$h_tidakbayar,
            'total'=>$total,
            'ter'=>$ter,
            'bel'=>$bel,
            'bat'=>$bat,
        ]);
    }
    public function get_binv(Request $request)
    {
        $bulannow = $request->bulan;
        $tahunnow = $request->tahun;

        $invoice = Invoice::query()
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->get();
        $dibayar = Invoice::query()
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 7)
            ->get();
        $lunas = Invoice::query()
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 8)
            ->get();
        $terbayar = count($dibayar)+count($lunas);
        $belum = Invoice::query()
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 6)
            ->get();
        $klaim = Invoice::query()
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 11)
            ->get();
        $belumbayar = count($belum)+count($klaim);
        $tidakbayar = Invoice::query()
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 9)
            ->get();

        $total = DB::table('invoices')
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->sum('harga_bayar');
        $bel2 = DB::table('invoices')
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 6)
            ->sum('harga_bayar');
        $kla = DB::table('invoices')
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 11)
            ->sum('harga_bayar');
        $bel = $bel2+$kla;
        $di = DB::table('invoices')
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 7)
            ->sum('harga_bayar');
        $lu = DB::table('invoices')
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 8)
            ->sum('harga_bayar');
        $ter = $di+$lu;
        $bat = DB::table('invoices')
            ->where('bulan', '=', $bulannow)
            ->where('tahun', '=', $tahunnow)
            ->where('status_id', '=', 9)
            ->sum('harga_bayar');

        $h_invoice = count($invoice);
        $h_terbayar = $terbayar;
        $h_belumbayar = $belumbayar;
        $h_tidakbayar = count($tidakbayar);

        $invoice2 = Invoice::query()
            ->where('tahun', '=', $tahunnow)
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

        return response()->json([
            'h_invoice'=>$h_invoice,
            'h_terbayar'=>$h_terbayar,
            'h_belumbayar'=>$h_belumbayar,
            'h_tidakbayar'=>$h_tidakbayar,
            'total'=>$total,
            'ter'=>$ter,
            'bel'=>$bel,
            'bat'=>$bat,
            'namabulans'=>$namabulans,
            'bulanCount'=>$bulanCount,
            'terCount'=>$terCount,
            'belCount'=>$belCount,
            'batCount'=>$batCount,
            'batas_max'=>$batas_max
        ]);
    }
}
