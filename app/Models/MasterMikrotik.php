<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterMikrotik extends Model
{
    use HasFactory;
    protected $table = 'master_mikrotik';
    protected $primaryKey = 'id_master';
    protected $guarded = ['id_master'];
}
