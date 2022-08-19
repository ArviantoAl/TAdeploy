<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bts extends Model
{
    use HasFactory;
    protected $table = 'bts';
    protected $primaryKey = 'id_bts';
    public $incrementing = true;
    protected $fillable = [
        'jenis_id',
        'nama_bts',
        'lokasi_id',
        'kategori_id',
        'status_id',
        'frekuensi',
        'ssid',
        'ip',
    ];

    public function jenis(){
        return $this->belongsTo(JenisBts::class, 'jenis_id');
    }
    public function status(){
        return $this->belongsTo(Status::class, 'status_id');
    }
    public function kategori(){
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    public function lokasi(){
        return $this->belongsTo(MasterBts::class, 'lokasi_id');
    }
    public function langganan(){
        return $this->hasMany(Langganan::class);
    }
    public function turunan(){
        return $this->hasMany(TurunanBts::class);
    }
    public function perangkatbts(){
        return $this->hasMany(PerangkatBts::class);
    }
}
