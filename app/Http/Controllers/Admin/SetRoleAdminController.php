<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRole;

class SetRoleAdminController extends Controller
{
    public function setRole($id)
    {
      $u = User::find($id);
      UserRole::where('user_id', $id)->update(['role_id' => 1]);
      // $role=$u->roles()->get()[0];

      // return $role;
     
      //$userRole->update(['role_id' => 1]);
    }
}
