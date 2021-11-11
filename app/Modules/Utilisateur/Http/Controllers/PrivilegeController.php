<?php

namespace App\Modules\Utilisateur\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Utilisateur\Models\Privilege;
use Illuminate\Http\Request;

class PrivilegeController extends Controller
{
    public function create(Request $request){
        $privilege =new Privilege;
        $privilege->name=$request->name;
        $privilege->save();
        return $privilege;
    }
    public function getPrivilege($id){
        $privilege=Privilege::find($id);
        return $privilege;
    }
}
