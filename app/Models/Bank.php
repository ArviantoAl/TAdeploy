<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $table = 'banks';
    protected $primaryKey = 'id_bank';
    public $incrementing = true;
    protected $fillable = [
        'nama_bank',
    ];

    public function invoice(){
        return $this->hasMany(Invoice::class);
    }
}
