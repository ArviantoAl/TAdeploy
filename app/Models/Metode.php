<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metode extends Model
{
    use HasFactory;
    protected $table = 'metodes';
    protected $primaryKey = 'id_metode';
    public $incrementing = true;
    protected $fillable = [
        'nama_metode',
    ];

    public function invoice(){
        return $this->hasMany(Invoice::class);
    }
}
