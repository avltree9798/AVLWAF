<?php


namespace App\Http\Controllers;


use App\Payment;
use App\User;
use AVL\WAF\Blacklist;
use AVL\WAF\HackingAttempt;
use AVL\WAF\Http\Models\Rule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name'=>$request->get('name'),
            'email'=>$request->get('email'),
            'password'=>bcrypt($request->get('password'))
        ]);
        Auth::loginUsingId($user->id);
        return redirect(route('dashboard'));
    }

    public function billing()
    {
        $payments = Payment::whereUserId(Auth::user()->id)->whereRemark("Unpaid")->get();
        $amount = 0;
        $startDate = null;
        $endDate = null;
        $i=0;
        foreach ($payments as $payment){
            $amount += $payment->amount;
            if($i++===0){
                $startDate = $payment->start_date;
            }
            $endDate = $payment->end_date;
        }

        return view('billing-info', compact('amount', 'startDate', 'endDate'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if($request->get('password')){
            $user->password = bcrypt($request->get('password'));
        }
        $user->save();
        return redirect(route('profile'));
    }

    public function profile()
    {
        return view('profile');
    }

    public function dashboard()
    {
        $blacklists = Blacklist::whereUserId(Auth::user()->id)->get();
        $rules = Rule::whereUserId(Auth::user()->id)->get();
        $hackingAttemptsToday = HackingAttempt::whereUserId(Auth::user()->id)->whereDate('created_at', Carbon::today())->get();
        return view('dashboard', compact('blacklists', 'rules', 'hackingAttemptsToday'));
    }
}