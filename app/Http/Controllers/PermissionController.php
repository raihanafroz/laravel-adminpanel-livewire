<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
  public function getPermissionByRole(Request $request){
    if ($request->isMethod('post')){
      $role_id = $request->post('role_id');
      $role = Role::find($role_id);
      $permission = $role->permissions()->get();
      return $permission;
    }
  }


  public function managePermission(Request $request){
    $roles = Role::all();
    $dataPer = Permission::all();
    if($request->isMethod("POST")){
      $data =  $request->all();

      $validator = Validator::make($data,[
        'role' => 'required',
      ]);

      if ($validator->fails()) {
        return redirect()->back()
          ->withErrors($validator)
          ->withInput();
      }
      DB::beginTransaction();
      try{
        $role = Role::find($data['role']);
        if (isset($data['permission'])){
          $role->syncPermissions($data['permission']);
        }else{
          DB::table('role_has_permissions')->where('role_id', $role->id)->delete();
        }
        DB::commit();
        $status = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Permission</strong> successfully updated.
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                        </div>';
        return redirect()->back()->with('status', $status);
      }catch(QueryException $e){
        DB::rollBack();
        $status = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                          Something Went wrong.
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                        </div>';
        return redirect()->back()->with('status', $status)->withInput();
      }
    }

    $permissions = [];
    foreach ($dataPer as $permission){
      $permissions[$permission->type][] = [
        'id' => $permission->id,
        'name' => $permission->name,
      ];
    }
    $permissions = collect($permissions);
    return view('admin.permission.index', compact('roles', 'permissions'));
  }
}
