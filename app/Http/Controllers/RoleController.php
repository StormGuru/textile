<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRole;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class RoleController extends Controller
{

     public function setRole(array $data){

        DB::table('user_roles')->insert([
            'user_id' => $data['user_id'],
            'role_id' => $data['user_type']
        ]);


     }
  
}
