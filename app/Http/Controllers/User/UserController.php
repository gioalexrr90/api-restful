<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserCollection::make(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $campos = $request->all();
        $campos['password'] = bcrypt($request->password);
        $campos['verified'] = User::IS_VERIFIED;
        $campos['verification_token'] = User::generateVerificationToken();
        $campos['admin'] = User::IS_ADMIN;


        $user = User::create($campos);
        return (new UserResource($user))->response()->setStatusCode(201);

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return UserResource::make($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if($request->name){
            $user->name = $request->name;
        }

        if($request->email and $user->email != $request->email){
            $user->verified = false;
            $user->verification_token = User::generateVerificationToken();
            $user->email = $request->email;
        }

        if($request->password and $user->password != $request->password){
            $user->password = bcrypt($request->password);
        }

        if($request->admin and $request->admin == false){
            if(!$user->isVerified()){
                return response()->json(['message' => 'Not authorized', 'code' => '401'], 401);
            }
            $user->admin = $request->admin;
        }

        if(!$user->isDirty()){
            return response()->json(['error' => 'There are any changes', 'code' => 400], 400);
        }

        $user->save();

        return UserResource::make($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return (new UserResource($user))->response()->setStatusCode(200);
    }
}
