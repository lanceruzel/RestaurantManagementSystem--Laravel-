<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\EmployeeInformation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function index(){
        $data  = DB::table('account')
        ->select('account.email', 'account.role', 'employeeinformation.*')
        ->join('employeeinformation', 'employeeinformation.accountID', '=', 'account.id')
        ->get();

        return view('index', ['account' => $data]);
    }

    public function update(Request $request){
        
        return response()->json(['success' => 'Successfully.']);
    }

    public function register(Request $request){
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

            $data = DB::table('employeeinformation')->where('accountID', '=', Auth::user()->id)->first();

            //return view('index', ['user' => $data]);
            return redirect()->route('home')->with(['fullName' => $data->firstName. ' ' .$data->lastName]);
        }

        return back()->withErrors(['email' => 'Login failed'])->onlyInput('email');
    }

    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
