<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Layanan extends Model
{
    use HasFactory;
    protected $table = 'layanans';
    protected $primaryKey = 'id_layanan';
    public $incrementing = true;
    protected $fillable = [
        'nama_layanan',
        'harga',
        'status_id',
    ];

    public function langganan(){
        return $this->hasMany(Langganan::class);
    }
    public function status(){
        return $this->belongsTo(Status::class, 'status_id');
    }
}
