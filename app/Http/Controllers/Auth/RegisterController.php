<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt', ['only' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function register(Request $request)
    {
        $validated = $this->validate(request(), [
            'first_name' => 'required|max:255',   
            'last_name' => 'required|max:255',    
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8',
            'accept_terms_and_conditions' => 'required'            
        ]);
        if(!(($validated['accept_terms_and_conditions'] === true) || ($validated['accept_terms_and_conditions'] === 1)))
        {
            return response()->json(
                array (
                    'message' => 'The given data was invalid.',
                    'errors' => 
                    array (
                      'accept_terms_and_conditions' => 
                      array (
                        0 => 'You must accept terms and conditions in order to proceed.',
                      ),
                    ),        
                ), 401);
        }
        else{
            $arrayDigits = ['0','1','2','3','4','5','6','7','8','9'];
            $proceed = false;
            foreach($arrayDigits as $digit){
                if(strpos($validated['password'], $digit)){
                    $proceed = true;
                    break;
                }
            }
            if ($proceed === false){                
                return response()->json(
                    array (
                        'message' => 'The given data was invalid.',
                        'errors' => 
                        array (
                          'password_digit_check' => 
                          array (
                            0 => 'Password must contain at lease 1 digit!',
                          ),
                        ),        
                    ), 401                    
                );
            }else{
                $user = new User();
                $user->first_name = $request->input('first_name');
                $user->last_name = $request->input('last_name');
                $user->email = $request->input('email');
                $user->password = bcrypt($request->input('password'));
                $user->save();

                return response()->json(['success' => 'You registered successfully, please login.']);                
            }
        }
    }
}
