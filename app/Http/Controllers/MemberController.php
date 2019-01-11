<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function showMemberRegisterForm()
    {
        return view();
    }

    public function memberRegister(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $member = new Member();
        $member->name = $request->input('name');
        $member->email = $request->input('email');
        $member->password = Hash::make($request->input('password'));
        $member->save();
        return view('/working', compact('member'));
    }
}
