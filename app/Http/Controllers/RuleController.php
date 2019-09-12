<?php


namespace App\Http\Controllers;


use App\BillableAction;
use AVL\WAF\Blacklist;
use AVL\WAF\Http\Models\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RuleController extends Controller
{
    public function index()
    {
        $rules = Rule::whereUserId(Auth::user()->id)->get();
        return view('rule-index', compact('rules'));
    }

    public function create()
    {
        return view('rule-create');
    }

    public function store(Request $request)
    {
        $rule = Rule::create([
            'user_id'=>Auth::user()->id,
            'rule'=>$request->get('rule'),
            'description'=>$request->get('description'),
            'impact'=>$request->get('impact')
        ]);
        BillableAction::create([
            'user_id'=>Auth::user()->id,
            'rule_id'=>$rule->id,
            'amount'=>10000
        ]);
        return redirect(route('rules'));
    }

    public function edit($id)
    {
        $rule = Rule::find($id);
        return view('rule-edit', compact('rule'));
    }

    public function update($id, Request $request)
    {
        $rule = Rule::find($id);
        $rule->rule = $request->get('rule');
        $rule->description = $request->get('description');
        $rule->impact = $request->get('impact');
        $rule->save();

        return redirect(route('rules'));
    }

    public function destroy($id)
    {
        $rule = Rule::find($id);
        $rule->delete();
        return redirect(route('rules'));
    }
}