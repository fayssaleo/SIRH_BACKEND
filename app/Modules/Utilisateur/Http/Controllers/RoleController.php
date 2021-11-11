<?php

namespace App\Modules\Utilisateur\Http\Controllers;

use App\Enums\eResponseCode;
use App\Http\Controllers\Controller;
use App\Modules\Utilisateur\Models\Privilege;
use App\Modules\Utilisateur\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Object_;
use Psy\Util\Json;

class RoleController extends Controller
{
    public function index(){
        $roles=Role::leftJoin('utilisateurs',"utilisateurs.role_id","=","roles.id")
            ->selectRaw('roles.*,count(utilisateurs.id) as utilisateurs')
            ->groupBy('roles.id')->groupBy('roles.name')->groupBy('roles.created_at')->groupBy('roles.updated_at')
            ->get();
        for ($i=0;$i<$roles->count();$i++){
            $roles[$i]->privileges=$roles[$i]->privileges()->pluck("id");
        }

        return $this->resp->ok(eResponseCode::ROL_LISTED_200_00,$roles);
    }
    public function create(Request $request){
        $validator=Validator::make($request->all(),[
            "name" => "required|string|max:20,unique",
        ]);
        if ($validator->fails()) {
            return $this->resp->not_acceptable(eResponseCode::ROL_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $role =new Role;
        $role->name=$request->name;
        $role->save();
        $role->utilisateurs=0;
        return $this->resp->ok(eResponseCode::ROL_STORED_200_02,$role);
    }
    public function update(Request $request){
        $validator=Validator::make($request->all(),[
            "id" => "required",
            "name" => "required|string|max:20",
        ]);
        if ($validator->fails()) {
            return $this->resp->not_acceptable(eResponseCode::ROL_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $role =Role::find($request->id);
        if($role==null){
            return $this->resp->not_found(eResponseCode::ROL_NOT_FOUND_404_00);
        }
        $role->name=$request->name;
        $role->save();
        $role->utilisateurs=$role->utilisateurs()->count();
        return $this->resp->ok(eResponseCode::ROL_UPDATED_200_03,$role);

    }
    public function getRole($id){
        $role =Role::find($id);
        if($role==null){
            return $this->resp->not_found(eResponseCode::ROL_NOT_FOUND_404_00);
        }
        return $this->resp->ok(eResponseCode::ROL_GET_200_01,$role);
    }
    public function delete(Request $request){
        $validator=Validator::make($request->all(),[
            "id" => "required",
        ]);
        if ($validator->fails()) {
            return $this->resp->not_acceptable(eResponseCode::ROL_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $role =Role::find($request->id);
        if($role==null){
            return $this->resp->not_found(eResponseCode::ROL_NOT_FOUND_404_00);
        }
        $role->privileges()->detach();
        $role->delete();
        return $this->resp->ok(eResponseCode::ROL_DELETED_200_04);
    }
    public function setPrivileges(Request $request){
        $requestContent=json_decode($request->getContent());
        $role=Role::find($requestContent->role_id);
        if($role==null){
            return $this->resp->not_found(eResponseCode::ROL_NOT_FOUND_404_00);
        }
        if($role->privileges())
        $role->privileges()->detach();



        foreach ($requestContent->privileges as $privilege){
            if($privilege->roleHaveThis){
                $privilege=Privilege::find($privilege->id);
                if($role!=null && $privilege!=null){
                    $role->privileges()->attach($privilege);
                }
            }
        }



        $role->privileges=$role->privileges()->pluck("id");
        return $this->resp->ok(eResponseCode::ROL_SET_PRIVILEGES_200_05,$role);
    }
    public function getRolePrivileges($id){
        $role=Role::find($id);
        return $role->privileges;
    }
}
