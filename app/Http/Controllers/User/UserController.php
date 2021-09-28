<?php

namespace App\Http\Controllers\User;

use App\Events\UserAccountCreated;
use App\Events\UserAccountEmailChanged;
use App\Http\Controllers\ApiController;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return $this->showAll($users);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //rules
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'designation' => 'required',
            'contact' => 'required',
            'image' => 'image'
        ];

        //validation
        $this->validate($request, $rules);


        //set default values
        $userData = $request->all();

        $userData['password'] = bcrypt($request->password);
        $userData['image'] =  $request->image->store('');
        $userData['admin'] = User::REGULAR_USER;
        $userData['verified'] = User::UNVERIFIED_USER;
        $userData['verification_token'] = User::generateVerificationToken();


        //save
        $user = User::create($userData);

        event(new UserAccountCreated($user));

        return $this->showOne($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $this->showOne($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //rules
        $rules = [
            'email' => 'email|unique:users,email,' . $user->id,
            'password' => 'min:6|confirmed',
            'admin' => 'in:' . User::ADMIN_USER . ',' . User::REGULAR_USER,
            'image' => 'image'
        ];

        if($request->has('name')){
            if($request->name == null){
                return $this->errorResponse('Name field cannot be empty', 409);
            }

            $user->name = $request->name;
        }

        if($request->has('email') &&  $user->email != $request->email ){
            $this->validate($request, $rules);

            $user->verified = User::UNVERIFIED_USER;
            $user->verification_token = User::generateVerificationToken();
            $user->email = $request->email;


        }


        if($request->has('password')){
            $this->validate($request, $rules);
            $user->password = bcrypt($request->password);
        }

        if($request->has('admin')){
            $this->validate($request, $rules);

           if(!$user->isVerified() && !$user->isAdmin()){
               return $this->errorResponse('Only verified admin users can modify this field', 409);
           }

           $user->admin = $request->admin;
       }

       if($request->has('image')){
            $this->validate($request, $rules);
            $user->image  = $request->image->store('');
        }


        if($request->has('contact')){
            $user->contact  = $request->contact;
        }


        if($request->has('designation')){
            $user->designation  = $request->designation;
        }


        if($user->isClean()){
            return $this->errorResponse('You must specify a value to update', 422);
        }

        if($user->isDirty('email')){
            event(new UserAccountEmailChanged($user));
        }

         //save
         $user->save();

        return $this->showOne($user, 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $this->showOne($user, 200);
    }


    public function verify($token)
    {
        $user = User::where('verification_token', $token)->firstOrFail();
        $user->verified = User::VERIFIED_USER;
        $user->verification_token = null;
        $user->save();


        return $this->showMessage('Your account has been verified');
    }


    public function currentUser(Request $request){
        $user = $request->user();
        return $this->showOne($user);
    }
}
