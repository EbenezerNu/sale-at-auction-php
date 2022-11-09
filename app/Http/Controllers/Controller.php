<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function isAdmin(){
        $user = Auth::user();
        $user_role = $user->role->name;
        Log::info('User role : '.$user_role);
        $isAdmin = false;
        if(!empty($user_role) && strtolower(trim($user_role)) == 'admin'){
            $isAdmin = true;
        }
        return $isAdmin;
    }

    public function getUserName(){
        $user = Auth::user();
        if(!empty($user) && trim($user->name) != ''){
            return $user->name;
        }
        return '';
    }
}
