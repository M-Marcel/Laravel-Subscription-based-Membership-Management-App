<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Writer;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegWriterController extends Controller
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
        $this->middleware('guest:writer');
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
            'email' => 'required|string|email|max:255|unique:writers',
            'password' => 'nullable',
        ]);
    }

    public function showWriterRegisterForm()
    {
        return view('auth.registerMember', ['url' => 'writer']);
    }

    protected function createWriter(Request $request)
    {
        $this->validator($request->all())->validate();
        $writer = Writer::create([
            'name' => $request['name'],
            'email' => $request['email'],
        ]);
        // \Mail::to($writer)->send(new Notification($writer));
        //Event::fire(new EmailRegistered($writer->id));
        //event(new EmailRegistered($writer->id));
        //return redirect()->intended('login/writer');
        //return view('/working', compact('writer'));
        $id = $writer->id;
        return view('/link', compact('id'));
    }

    public function completeRegisterationForm($id)
    {
        $data = Writer::find($id);
        return view('/auth.completeRegistration', compact('data'));
    }

    public function completeRegisteration(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string||min:11',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $data = Writer::find($id);
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->phone = $request->input('phone');
        $data->password = Hash::make($request->input('password'));
        $data->save();
        return view('/paystack');
    }

}
