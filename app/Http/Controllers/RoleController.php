<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleModel;

class RoleController extends Controller
{
    public function index()
    {
        return RoleModel::get();
    }

    public function show(string $id)
    {
        $role_object = RoleModel::find($id);

        if (!$role_object)
        {
            return response()->json(['message'=>'Role not found']);
        }
        return $role_object;
    }

    public function store(Request $request)
    {
        $roleName = $request->role_name;
        $createdBy = $request->created_by;

        $existingRole = RoleModel::where('role_name', $roleName)->first();

        if ($existingRole)
        {
            return response()->json(['message'=>'Data Exists', 'data'=>$existingRole]);
        }

        $insert_array=
        [
            'role_name'    =>$request->role_name,
            'created_by' =>$request->created_by,
        ];

        $inserted_roles_object=RoleModel::create($insert_array);

        return response()->json(['message'=>'Role Inserted successfully', 'data'=>$inserted_roles_object]);
    }

    public function update(Request $request, string $id)
    {
        $role_object=RoleModel::find($id);

        if(!$role_object) 
        {
            return response()->json(['message'=>'Role not found'], 404);
        }

        $roleName = $request->role_name;
        $updatedBy = $request->updated_by;

        $existingRole = RoleModel::where('role_name', $roleName)->first();

        if ($existingRole)
        {
            return response()->json(['message'=>'Data Exists', 'data'=>$existingRole]);
        }
        
        $update_array=
        [
            'role_name'    =>$request->role_name,
            'updated_by' =>$request->updated_by,
        ];

        RoleModel::where('role_id', $id)->update($update_array);

        $updated_role_object=RoleModel::find($id);

        return response()->json(['message'=>'Role updated successfully', 'data'=>$updated_role_object]);

    }

    public function destroy(string $id)
    {
        $role_object=RoleModel::find($id);

        if(!$role_object) 
        {
            return response()->json(['message'=>'Role not found'], 404);
        }

        $role_object->delete();

        return response()->json(['message'=>'Role deleted successfully']);

    }

}
