<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\EmployeeInformation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            "firstName" => ['required', 'min:3'],
            "middleName" => ['required', 'min:3'],
            "lastName" => ['required', 'min:3'],
            "birthdate" => ['required', 'before:today'],
            "gender" => ['required'],
            "address" => ['required', 'min:5'],
            "contact" => ['required', 'min:11', 'max:11'],
            "email" => ['required', 'email', Rule::unique('account', 'email')],
            "password" => 'required|confirmed|min:5',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $account = Account::create([
            'email' => $validated['email'],
            'password' => $validated['password']
        ]);

        $empInformation = EmployeeInformation::create([
            'accountID' => $account->id,
            'firstName' => $validated['firstName'],
            'middleName' => $validated['middleName'],
            'lastName' => $validated['lastName'],
            'birthdate' => $validated['birthdate'],
            'gender' => $validated['gender'],
            'address' => $validated['address'],
            'contact' => $validated['contact']
        ]);

        return redirect('/');
    }

    public function login(Request $request){
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(auth()->attempt($validated)){
            $request->session()->regenerate();
            return redirect('/')->with(['message' => 'Testttt']);
        }

        return back()->withErrors(['email' => 'Login failed'])->onlyInput('email');
    }
}
