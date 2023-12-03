<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Mail\UserCreated;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->showAll(User::all());
        //return (new UserCollection($users));
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
        return $this->showOne(new UserResource($user), 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $this->showOne(new UserResource($user));
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
                return $this->errorResponse('Not authorized', 401);
            }
            $user->admin = $request->admin;
        }

        if(!$user->isDirty()){
            return $this->errorResponse('There are any changes', 400);
        }

        $user->save();

        return $this->showOne(new UserResource($user));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $this->showOne(new UserResource($user));
    }

    public function verify($token)
    {
        $user = User::where('verification_token' , $token)->firstOrFail();
        $user->verified = true;
        $user->verification_token = false;

        $user->save();

        return $this->showMessage('User verified.');
    }

    public function resend(User $user)
    {
        if($user->isVerified()){
            return $this->errorResponse('This user is verified now.', 409);
        }

        Mail::to($user)->send(new UserCreated($user));

        return $this->showMessage('Vertfiication email was re-sent.');
    }
}
