<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllUsers(){
        $users = User::all();
        return parent::resp(true, $users, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:user,name|alpha',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'

        ]);

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => $request->role,
            ]);
            return parent::resp(true, 'User Created!', 201);
        } catch (Exception $ex) {
            return parent::resp(false, $ex->getMessage(), 422);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($request->id);


        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => $request->role,
            ]);
            return parent::resp(true, 'User updated!', 201);
        } catch (Exception $ex) {
            return parent::resp(false, 'Failed User Updated!', 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteUser()
    {
        $user = User::findOrFail(request()->id);
        try {
            $user->delete();
            return parent::resp(true, 'Successfully Deleted', 201);
        } catch (Exception $ex) {
            return parent::resp(false, 'Failed', 422);
        }
    }
}
