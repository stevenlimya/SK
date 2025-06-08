<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Branch;
use App\Models\BranchWarehouse;
use App\Models\EmployeeBranch;
use App\Models\Position;

class UserInfoHelper
{
    public static function user()
    {
        return session()->get('user');
    }

    public static function user_id()
    {
        return session()->get('user')->id;
    }


    public static function get_user_ip()
    {
        // Get real visitor IP behind CloudFlare network
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }

        return $ip;
    }

    public static function get_unique_code($n, $prefix = "")
    {
        $characters = 'ADEGHIJLNOPQRTUVWXYZ';
        $result = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $result .= $characters[$index];
        }

        return $result . $prefix;
    }
}
