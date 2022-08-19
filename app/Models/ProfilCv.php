<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilCv extends Model
{
    use HasFactory;
    protected $table = 'profilcv';
    protected $primaryKey = 'id_profil';
    public $incrementing = true;
    protected $fillable = [
        'nama_cv',
        'email_cv',
        'web_cv',
        'no_hp',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'desa_id',
        'detail_alamat',
        'rt',
        'rw',
        'alamat',
        'export_invoice',
    ];

    public function provinsi(){
        return $this->belongsTo(Province::class, 'provinsi_id');
    }
    public function kabupaten(){
        return $this->belongsTo(Regency::class, 'kabupaten_id');
    }
    public function kecamatan(){
        return $this->belongsTo(District::class, 'kecamatan_id');
    }
    public function desa(){
        return $this->belongsTo(Village::class, 'desa_id');
    }
}
