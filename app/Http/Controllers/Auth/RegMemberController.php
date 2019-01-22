<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Member;
use Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegMemberController extends Controller
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
        $this->middleware('guest:member');
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:members',
            'password' => 'nullable',
        ]);
    }

    public function showMemberRegisterForm()
    {
        return view('auth.registerMember', ['url' => 'member']);
    }

    protected function createMember(Request $request)
    {
        $this->validator($request->all())->validate();
        $member = Member::create([
            'name' => ucwords($request['name']),
            'email' => $request['email'],
        ]);
        // \Mail::to($member)->send(new Notification($member));
        //Event::fire(new EmailRegistered($member->id));
        //event(new EmailRegistered($member->id));
        //return redirect()->intended('login/member');
        //return view('/working', compact('member'));
        $id = $member->id;
        return view('/link', compact('id'));
    }

    public function completeRegisterationForm($id)
    {
        $data = Member::find($id);
        return view('/auth.completeRegistration', compact('data'));
    }

    public function completeRegisteration(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string||min:11',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $data = Member::find($id);
        $data->name = ucwords($request->input('first_name')) . ' ' . ucwords($request->input('last_name'));
        $data->first_name = ucwords($request->input('first_name'));
        $data->last_name = ucwords($request->input('last_name'));
        $data->email = $request->input('email');
        $data->phone = $request->input('phone');
        $data->password = Hash::make($request->input('password'));
        $data->save();
        return view('/pay')->with('data', $data);
    }

}
