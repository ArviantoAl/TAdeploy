<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'no_hp' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $getprovinsi = DB::table('provinces')
            ->select('*')
            ->where('id', $data['id_provinsi'])
            ->get()
            ->toArray();
        $objectToArray = (array)$getprovinsi;
        $prov1 = $objectToArray[0];
        $prov2 = (array)$prov1;
        $provinsi = $prov2['name'];

        $getkabupaten = DB::table('regencies')
            ->select('*')
            ->where('id', $data['id_kabupaten'])
            ->get()
            ->toArray();
        $objectToArray = (array)$getkabupaten;
        $kab1 = $objectToArray[0];
        $kab2 = (array)$kab1;
        $kabupaten = $kab2['name'];

        $getkecamatan = DB::table('districts')
            ->select('*')
            ->where('id', $data['id_kecamatan'])
            ->get()
            ->toArray();
        $objectToArray = (array)$getkecamatan;
        $kec1 = $objectToArray[0];
        $kec2 = (array)$kec1;
        $kecamatan = $kec2['name'];

        $getdesa = DB::table('villages')
            ->select('*')
            ->where('id', $data['id_desa'])
            ->get()
            ->toArray();
        $objectToArray = (array)$getdesa;
        $desa1 = $objectToArray[0];
        $desa2 = (array)$desa1;
        $desa = $desa2['name'];

        $lengkap = array($data['alamat'],$desa,$kecamatan,$kabupaten,$provinsi);
//        $hasil = implode(", ",$lengkap);
//        dd($hasil);
        return User::create([
            'name' => $data['name'],
            'alamat' => implode(", ",$lengkap),
            'no_hp' => $data['no_hp'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'user_role' => 4,
        ]);
    }

    public function form_register(){
        $provincies = Province::all();
//dd($provincies);
        return view('auth.register', compact('provincies'));
    }
}
