<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBts extends Model
{
    use HasFactory;
    protected $table = 'jenis_bts';
    protected $primaryKey = 'id_jenis';
    public $incrementing = true;
    protected $fillable = [
        'nama_perangkat',
    ];

    public function bts(){
        return $this->hasMany(Bts::class);
    }
}
