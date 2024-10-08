<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\EmployeeInformation;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function index(){
        if(request()->ajax()){
            return datatables()->of(
                DB::table('account')->
                select('account.email', 'account.role', 'employeeinformation.*', DB::raw("CONCAT(employeeinformation.firstName,' ',employeeinformation.middleName,' ',employeeinformation.lastName) as fullname"), 'account.id as id')
                ->join('employeeinformation', 'employeeinformation.accountID', '=', 'account.id')
                ->get())
            ->addColumn('action', 'TableActions.table-action-addEdit') 
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }

        return view('index');
    }

    public function viewInfos(Request $request){
        $account = DB::table('account')
        ->select('account.email', 'account.role', 'employeeinformation.*')
        ->join('employeeinformation', 'employeeinformation.accountID', '=', 'account.id')
        ->where('employeeinformation.accountID', '=', $request->id)
        ->first();

        return Response()->json($account);
    }

    public function updatePersonal(Request $request){
        $validated = $request->validate([
            "firstName" => ['required', 'min:3'],
            "middleName" => ['required', 'min:3'],
            "lastName" => ['required', 'min:3'],
            "birthdate" => ['required', 'before:today'],
            "gender" => ['required'],
            "address" => ['required', 'min:5'],
            "contact" => ['required', 'min:11', 'max:11'],
        ]);

        $information = EmployeeInformation::where('accountID', '=', $request->id)->update($validated);

        return Response()->json($information);
    }

    public function updateAccount(Request $request){
        $validated = null;

        if($request->email === Account::where('id', '=', $request->id)->value('email')){
            $validated = $request->validate([
                "role" => ['required'],
            ]);
        }else{
            $validated = $request->validate([
                "email" => ['required', 'min:3', Rule::unique('account', 'email')],
                "role" => ['required'],
            ]);
        }
        
        $information = Account::where('id', '=', $request->id)->update($validated);

        return Response()->json($information);
    }
    
    public function destroy(Request $request){
        $table = Account::where('id', '=', $request->id)->delete();

        return Response()->json($table); 
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
            'password' => $validated['password'],
            'created_at' => now()->toDateString()
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
            return redirect()->route('home');
        }

        return back()->withErrors(['email' => 'Login failed'])->onlyInput('email');
    }

    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function changeEmail(Request $request){
        $validated = $request->validate([
            "email" => ['required', 'min:3', 'email', Rule::unique('account', 'email')],
        ]);

        $information = Account::where('id', '=', $request->id)->update(['email' => $validated['email']]);

        return Response()->json($information);
    }

    public function changePassword(Request $request){
        $validated = $request->validate([
            "password" => 'required|confirmed|min:5',
            'current_password' => ['required','string','min:5'],
        ]);

        $currentPasswordStatus = Hash::check($validated['current_password'], auth()->user()->password);

        if($currentPasswordStatus){
            $validated['password'] = bcrypt($validated['password']);
            $information = Account::where('id', '=', $request->id)->update(['password' => $validated['password']]);
            return Response()->json($information);
        }else{
            return Response()->json(['old_pass_error' => 'Current Password does not match with Old Password']);
        }
    }
}
