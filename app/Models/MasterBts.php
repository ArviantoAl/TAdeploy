<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterBts extends Model
{
    use HasFactory;
    protected $table = 'master_bts';
    protected $primaryKey = 'id_master';
    public $incrementing = true;
    protected $fillable = [
        'nama_master',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'desa_id',
        'nama_lokasi',
        'latitude',
        'longitude',
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
