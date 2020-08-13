<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;

class UserController extends Controller
{

    public $successStatus = 200;
/** 
     * LOG SUR L'API 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            return response()->json(['success' => $success], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Wrong Email or Password'], 401); 
        } 
    }
/** 
     * S'INSCRIRE SUR L'API
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'firstname' => 'required', 
            'lastname' => 'required', 
            'email' => ['unique:users','required','email'], 
            'phone' => ['unique:users','required','numeric'], 
            'birthday' => 'date',
            'hiring_day' => 'date',
            'password' => 'required', 
            'c_password' => 'required|same:password',
            'admin_right' => '',
        ]);


        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        User::create($input);
        
       /*  $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['name'] =  $user->name;  */
        return response()->json(['success'=>'You can now log in '], $this-> successStatus); 
    }
 

    /** 
     * FONCTION USER POUR RECUPERER AUTH 
     * 
     * @return \Illuminate\Http\Response 
     */ 

    public function details() 
    { 
        $user = Auth::user();
       
        return response()->json(['user' => $user], $this-> successStatus); 
    } 


    public function index(){
        $user = User::all();

        return response()->json(['user' => $user], $this-> successStatus); 
        }

    // Show a User (by id)

    public function show(User $user){
        return $user;
    }

    // Update a User

    public function update(Request $request, User $user){

        $validator = Validator::make($request->all(),[ 
            'email' => ['unique:users,email,'.$user->id],
            'phone' => ['unique:users,phone,'.$user->id],

            ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $data = $request->all();
        $user->update($data);

        return response()->json([
            'profil_id' => $user->id,
            'Firstname' => $user->firstname,
            'Lastname' => $user->lastname,
            'Email' => $user->email,
            'Phone' => $user->phone,
            'birthday' => $user->birthday,
            'hiring_day' => $user->hiring_day,

            'success' => 'You can now log in !'
        
        ], $this-> successStatus); 

    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([

            'success' => 'User Deleted Successfully !'

        ], $this-> successStatus);    
     }


}
