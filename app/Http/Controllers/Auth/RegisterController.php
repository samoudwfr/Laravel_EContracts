<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Civil;
use App\Rules\CheckAge;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Rules\CheckCustomerIdCard;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\CheckIdForRegistration;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;
    // protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        // dd(Civil::where('id_number', $data['id_card'])->first()->id);
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'id_card' => ['required', new CheckIdForRegistration()],
            'age' => ['required', new CheckAge()],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        ]);

        $user = User::latest()->first();
        
        Customer::create([
        'user_id' => $user->id,
        'civil_id' => Civil::where('id_number', $data['id_card'])->first()->id,
        'role_id' => $data['reg_as'],
        'phone' => $data['phone'],
        'address' => $data['address'],
        'gender' => $data['gender'],
        'age' => $data['age'],
        'customer_number' => Str::random(14),
        ]);

        
        
        
        return $user;
            
    }
        
}
