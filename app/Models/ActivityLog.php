<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;
    protected $table = 'activitylogs';
    protected $primaryKey = 'id_activity';
    public $incrementing = true;
    protected $fillable = [
        'subject', 'url', 'method', 'ip', 'agent', 'user_id'
    ];
    public function pelanggan(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
