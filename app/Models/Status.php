<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $table = 'status';
    protected $primaryKey = 'id_status';
    public $incrementing = true;
    protected $fillable = [
        'kategori_tabel',
        'nama_status',
    ];

    public function user(){
        return $this->hasMany(User::class);
    }
    public function bts(){
        return $this->hasMany(Bts::class);
    }
    public function turunan_bts(){
        return $this->hasMany(TurunanBts::class);
    }
    public function layanan(){
        return $this->hasMany(Layanan::class);
    }
    public function langganan(){
        return $this->hasMany(Langganan::class);
    }
    public function invoice(){
        return $this->hasMany(Invoice::class);
    }
    public function langinv(){
        return $this->hasMany(Langinv::class);
    }
}
