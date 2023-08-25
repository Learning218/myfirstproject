<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;

class UserController extends Controller
{
    public function index()
    {
        return UserModel::get();
    }

    public function show(string $id)
    {
        $user_object = UserModel::find($id);

        if (!$user_object)
        {
            return response()->json(['message'=>'User not found']);
        }
        return $user_object;
    }

    public function store(Request $request)
    {
        $userdata = 
        [
            'name' =>$request->name,
            'email' =>$request->email,
            'password' =>$request->password,
        ];

        $inserted_users_object=UserModel::create($userdata);

        return response()->json(['message'=>'User Inserted successfully', 'data'=>$inserted_users_object]);

    }

    public function update(Request $request, string $id)
    {
        $user_object = UserModel::find($id);

        if(!$user_object) 
        {
            return response()->json(['message'=>'User not found'], 404);
        }

        $update_array=
        [
            'name'    =>    $request->name,
            'email' =>$request->email,
        ];

        UserModel::where('id', $id)->update($update_array);

        $updated_user_object = UserModel::find($id);

        return response()->json(['message'=>'User updated successfully', 'data'=>$updated_user_object]);

    }

    public function destroy(string $id)
    {
        $user_object=UserModel::find($id);

        if(!$user_object) 
        {
            return response()->json(['message'=>'User not found'], 404);
        }

        $user_object->delete();

        return response()->json(['message'=>'User deleted successfully']);

    }


}
