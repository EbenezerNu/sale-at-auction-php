<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function isAdmin(){
        $data = Auth::user();
        $user_role = Role::where('id', $data->role_id)->first();
        $isAdmin = false;
        if(!empty($user_role) && strtolower(trim($user_role->name)) == 'admin'){
            $isAdmin = true;
        }
        return $isAdmin;
    }
}
