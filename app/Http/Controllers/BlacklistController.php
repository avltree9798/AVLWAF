<?php


namespace App\Http\Controllers;


use App\BillableAction;
use AVL\WAF\Blacklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlacklistController extends Controller
{
    public function index()
    {
        $blacklists = Blacklist::whereUserId(Auth::user()->id)->get();
        return view('blacklist-index', compact('blacklists'));
    }

    public function create()
    {
        return view('blacklist-create');
    }

    public function store(Request $request)
    {
        $blacklist = Blacklist::create([
            'ip'=>$request->get('ip'),
            'user_id'=>Auth::user()->id
        ]);
        BillableAction::create([
            'blacklist_id'=>$blacklist->id,
            'user_id'=>Auth::user()->id,
            'amount'=>2500
        ]);

        return redirect(route('blacklist'));
    }

    public function destroy($id)
    {
        $blacklist = Blacklist::find($id);
        $blacklist->delete();

        return redirect(route('blacklist'));
    }
}