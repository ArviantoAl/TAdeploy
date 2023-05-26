<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \RouterOS\Client;
use \RouterOS\Query;
use App\Models\JenisBts;
use App\Models\Kategori;
use App\Models\Bts;
use App\Models\MasterBts;
use App\Models\MasterMikrotik;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;

class TestingController extends Controller
{
            public function index (){
                // Initiate client with config object
             $client = new Client([
            'host' => '192.168.205.89',
            'user' => 'mikrotikapi',
            'pass' => '123',
            'port' => 8728,
        ]);

        // Create "where" Query object for RouterOS
        $query = (new Query('/system/print'));

        // Send query and read response from RouterOS
        $response = $client->query($query)->read();
        // return dd($response);
        
        return view('dashboard.teknisi.bts.testing', compact('response'));
            }
        
         public function loginwb(){
                $master_mikrotik = MasterMikrotik::all();
                // return $master_mikrotik;
                return view('dashboard.teknisi.bts.form_login',compact('master_mikrotik'));
            }   

        public function submitlogin (Request $request){
            $client = new Client([
                'host' => $request->ip,
                'user' => $request->Uname,
                'pass' => $request->pw,
                'port' => 8728,
            ]);

            $query = (new Query('/system/identity/print'));

            // // Send query and read response from RouterOS
            $response = $client->query($query)->read();
            $item1 = $response[0];
            // return dd($response);
            $query2 = (new Query('/ip/address/print'));
            // Send query and read response from RouterOS
            $response2 = $client->query($query2)->read();
            $item2 = $response2[0];
            // return dd($response2);
            // $query3 = (new Query('/interface/wireless/print'));
            // // Send query and read response from RouterOS
            // $response3 = $client->query($query3)->read();
            // $item3 = $response3[0];
            // // return dd($response2);
            

            // dadikne 1
            $item = (object) [
                'item1' => $item1,
                'item2' => $item2,
                // 'item3' => $item3
            ];
            
            $bts = new Bts();
            $lokasis = MasterBts::all();
            $jeniss = JenisBts::all();
            $kategoris = Kategori::all();

            return view('dashboard.teknisi.bts.tambah_bts', compact('item2','item1','bts','lokasis', 'jeniss', 'kategoris'));
            }

            public function teknisi_edit_mikrotikbts($request, $id_bts){
                $bts = Bts::find($id_bts);
                $lokasis = MasterBts::all();
                $jeniss = JenisBts::all();
                $kategoris = Kategori::all();
                $client = new Client([
                    'host' => $request->ip,
                    'user' => 'admin',
                    'pass' => 'admin',
                    'port' => 8728,
                ]);

                $query = (new Query('/system/identity/print'));

                // // Send query and read response from RouterOS
                $response = $client->query($query)->read();
                $item1 = $response[0];
                // return dd($response);
                $query2 = (new Query('/ip/address/print'));
                // Send query and read response from RouterOS
                $response2 = $client->query($query2)->read();
                $item2 = $response2[0];
                // return dd($response2);
                // $query3 = (new Query('/interface/wireless/print'));
                // // Send query and read response from RouterOS
                // $response3 = $client->query($query3)->read();
                // $item3 = $response3[0];
                // // return dd($response2);
                

                // dadikne 1
                $item = (object) [
                    'item1' => $item1,
                    'item2' => $item2,
                    // 'item3' => $item3
                ];
        
                return view('dashboard.teknisi.bts.edit_mikrotikbts', compact('item2','item1','bts','lokasis', 'jeniss', 'kategoris'));
            }
        
            public function teknisi_post_edit_bts(Request $request ,$id_bts){
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
                    return redirect()->route('teknisi.tambahbts')
                        ->with('error','Kategori Frekuensi belum dipilih.');
                }elseif ($lokasi_id == 0){
                    return redirect()->route('teknisi.tambahbts')
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
                    return redirect()->route('teknisi.bts')
                        ->with('success','Perangkat '.$nama.' berhasil diubah.');
                }
            }
        
}    


