<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show()
    {
        $users = User::all();

          foreach($users as $user){
            $user2 = [
              'id' => $user->id,
              'name' => $user->name,
              'email' => $user->email,
              'created_at' => $user->created_at,
              'role'  => $user->roles()->get()[0]['role']
            ];

            $clients[] = $user2;
          }
        return $clients;
    }
}
