<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerangkatBts extends Model
{
    use HasFactory;
    protected $table = 'perangkat_bts';
    protected $primaryKey = 'id_perangkat_bts';
    public $incrementing = true;
    protected $fillable = [
        'nama_alat',
        'bts_id',
    ];

    public function bts(){
        return $this->belongsTo(Bts::class, 'bts_id');
    }
}
