<?php
namespace App\Helper;

use App\Models\ActivityLog as LogActivityModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class LogActivity
{


    public static function addToLog($subject)
    {
        if (auth()->user()->user_role == 3){
            $log = [];
            $log['subject'] = $subject;
            $log['url'] = request()->fullUrl();
            $log['method'] = request()->method();
            $log['ip'] = request()->ip();
            $log['waktu'] = Carbon::now()->setTimezone('Asia/Jakarta');
            $log['agent'] = request()->header('sec-ch-ua');
            $log['user_id'] = auth()->user()->id_user;
            LogActivityModel::create($log);
        }
    }


    public static function logActivityLists()
    {
        return LogActivityModel::query()->latest()->paginate(20);
    }


}
