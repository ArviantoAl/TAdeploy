<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AllSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        1
        $role = [
            [
                'nama_role' => 'Admin',
            ],
            [
                'nama_role' => 'Teknisi',
            ],
            [
                'nama_role' => 'Pelanggan',
            ],
            [
                'nama_role' => 'Keuangan',
            ],
        ];
        DB::table('roles')->insert($role);

        $status = [
            [
                'kategori_tabel' => 'user, langganan',
                'nama_status' => 'On Progress',
            ],
            [
                'kategori_tabel' => 'user, langganan',
                'nama_status' => 'Pending',
            ],
            [
                'kategori_tabel' => 'user, bts, turunan bts, layanan, langganan',
                'nama_status' => 'Aktif',
            ],
            [
                'kategori_tabel' => 'user, bts, turunan bts, layanan, langganan',
                'nama_status' => 'Non Aktif',
            ],
            [
                'kategori_tabel' => 'langganan',
                'nama_status' => 'Batal',
            ],
            [
                'kategori_tabel' => 'invoice',
                'nama_status' => 'Belum Dibayar',
            ],
            [
                'kategori_tabel' => 'invoice',
                'nama_status' => 'Sudah Dibayar',
            ],
            [
                'kategori_tabel' => 'invoice',
                'nama_status' => 'Lunas',
            ],
            [
                'kategori_tabel' => 'invoice',
                'nama_status' => 'Tidak Dibayar',
            ],
            [
                'kategori_tabel' => 'langganan',
                'nama_status' => 'Menunggu Disetujui',
            ],
            [
                'kategori_tabel' => 'invoice',
                'nama_status' => 'Klaim Unggah Ulang Bukti',
            ],
        ];
        DB::table('status')->insert($status);

//        2
        $user = [
            [
                'name' => 'admin gudang media perkasa',
                'email' => 'admingmp@gmail.com',
                'username' => 'admingmp',
                'password' => Hash::make('admingmp2022'),
                'user_role' => 1,
                'status_id' => 3,
                'ppn' => '0',
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Pelanggan 1',
                'email' => 'pel1@user.com',
                'username' => '0895422940733',
                'password' => Hash::make('pel111111'),
                'user_role' => 3,
                'status_id' => 1,
                'ppn' => '0',
                'email_verified_at' => null,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Pelanggan 2',
                'email' => 'pel2@user.com',
                'username' => '081326087786',
                'password' => Hash::make('pel222222'),
                'user_role' => 3,
                'status_id' => 2,
                'ppn' => '0',
                'email_verified_at' => null,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'keuangan',
                'email' => 'keuangangmp@user.com',
                'username' => '085156546461',
                'password' => Hash::make('keuangan12'),
                'user_role' => 4,
                'status_id' => 3,
                'ppn' => '0',
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'teknisi 1',
                'email' => 'teknisigmp@user.com',
                'username' => '087878785456',
                'password' => Hash::make('teknisi123'),
                'user_role' => 2,
                'status_id' => 3,
                'ppn' => '0',
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
            ],
        ];
        DB::table('users')->insert($user);

//        3
        $kategori = [
            [
                'kategori_frekuensi' => '2,4g',
            ],
            [
                'kategori_frekuensi' => '5g',
            ],
        ];
        DB::table('kategoris')->insert($kategori);

//        4
        $jenis = [
            [
                'nama_perangkat' => 'alpha obstacle',
            ],
            [
                'nama_perangkat' => 'tp link',
            ],
            [
                'nama_perangkat' => 'cisa',
            ],
        ];
        DB::table('jenis_bts')->insert($jenis);

        $lokasi = [
            [
                'nama_master' => 'BTS Jumapolo 1',
                'provinsi_id' => 33,
                'kabupaten_id' => 3313,
                'kecamatan_id' => 3313030,
                'desa_id' => 3313030001,
                'nama_lokasi' => 'PASEBAN, JUMAPOLO, KABUPATEN KARANGANYAR, JAWA TENGAH',
                'longitude' =>110.9757218,
                'latitude' =>-7.7039697,
            ]
        ];
        DB::table('master_bts')->insert($lokasi);

        $bts = [
            [
                'nama_bts' => 'Perangkat Jumapolo 1 Barat',
                'kategori_id' => 1,
                'jenis_id' => 2,
                'lokasi_id' => 1,
                'frekuensi' => '2412',
                'ssid' => 'bts_jumapolo_1_barat',
                'ip' => '10.113.0.1',
                'status_id' => 3,
            ],
        ];
        DB::table('bts')->insert($bts);

        $layanan = [
            [
                'nama_layanan' => '5 mbps',
                'harga' => 100000,
                'status_id' => 3,
            ],
            [
                'nama_layanan' => '10 mbps',
                'harga' => 200000,
                'status_id' => 3,
            ],
            [
                'nama_layanan' => '15 mbps',
                'harga' => 225000,
                'status_id' => 3,
            ],
        ];
        DB::table('layanans')->insert($layanan);

        $profil = [
            [
                'nama_cv' => 'CV Gudang Media Perkasa',
                'email_cv' => 'info@gudangtechno.web.id',
                'web_cv' => 'info@gudangtechno.web.id',
                'no_hp' => '081804411569',
                'rt' => '1',
                'rw' => '7',
                'provinsi_id' => 33,
                'kabupaten_id' => 3313,
                'kecamatan_id' => 3313030,
                'desa_id' => 3313030001,
                'detail_alamat' => 'Dusun Gudang',
                'alamat' => 'RT 1 / RW 7, Dusun Gudang, PASEBAN, JUMAPOLO, KABUPATEN KARANGANYAR, JAWA TENGAH',
                'longitude' =>110.9562274,
                'latitude' =>-7.7246776,
                'terakhir_generate' => 7,
            ],
        ];
        DB::table('profilcv')->insert($profil);

        $tahun = Carbon::now()->format('Y');
        $ppn = [
            [
                'jumlah' => 11,
                'tahun' => $tahun,
            ],
        ];
        DB::table('ppn')->insert($ppn);

        $metode = [
            [
                'nama_metode' => 'Cash',
            ],
            [
                'nama_metode' => 'Transfer Bank',
            ],
        ];
        DB::table('metodes')->insert($metode);

        $bank = [
            [
                'nama_bank' => 'BRI',
                'no_rek' => 375401029446533,
            ],
            [
                'nama_bank' => 'Mandiri',
                'no_rek' => 375401029446533,
            ],
            [
                'nama_bank' => 'BCA',
                'no_rek' => 375401029446533,
            ],
            [
                'nama_bank' => 'BSI',
                'no_rek' => 375401029446533,
            ],
        ];
        DB::table('banks')->insert($bank);

        $master_mikrotik = [
            [
                'uname' => 'admin',
                'password' => 'admin',
            ]];
        DB::table('master_mikrotik')->insert($master_mikrotik);
    }
}
