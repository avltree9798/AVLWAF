<?php
/**
 * Created by PhpStorm.
 * User: avltree
 * Date: 18/09/18
 * Time: 9:10
 */

namespace AVL\WAF;

use App\BillableAction;
use AVL\WAF\Http\Models\Rule;
use AVL\WAF\Http\Support\Responder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WAF
{
    const BLOCK_ACCESS = 0;
    const ALLOW_ACCESS = 1;

    /**
     * @return $this
     */
    public function setEnable()
    {
        config(['waf.enabled' => true]);

        return $this;
    }

    /**
     * @return $this
     */
    public function setDisable()
    {
        config(['waf.enabled' => false]);

        return $this;
    }

    /**
     * @param array $verdict
     * @return array|\Illuminate\Http\RedirectResponse
     */
    public function blockAccess($verdict)
    {

        $hackingAttemptCount = HackingAttempt::whereIp($verdict['ip'])->count();
        $hackingAttempt = HackingAttempt::create([
            'ip' => $verdict['ip'],
            'description' => $verdict['message'],
            'payload' => json_encode($verdict['payload']),
            'url' => $verdict['url'],
            'user_id' => $verdict['user']->id
        ]);
        BillableAction::create([
            'user_id'=>$verdict['user']->id,
            'hacking_attempt_id'=>$hackingAttempt->id,
            'amount'=>5000
        ]);
        $blacklistCount = Blacklist::whereIp($verdict['ip'])->count();
        if ($hackingAttemptCount >= 3 && $blacklistCount === 0) {
            $blacklist = Blacklist::create([
                'user_id' => $verdict['user']->id,
                'ip' => $verdict['ip']
            ]);
            BillableAction::create([
                'user_id'=>$verdict['user']->id,
                'blacklist_id'=>$blacklist->id,
                'amount'=>2500
            ]);
        }

        return (new Responder())->respond([
            'abort' => false,
            'code' => 403,
            'message' => json_encode([
                'success' => false,
                'message' => 'You\'ve been banned from this site, by AVL-WAF',
                'reason' => $verdict['message']
            ])
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function analyzeTraffic(Request $request)
    {
        /**
         * @var \AVL\WAF\Http\Models\Rule[] $rules
         */
        $rules = Rule::all();
        $form = $request->all();
        foreach ($form as $key => $value) {
            foreach ($rules as $rule) {
                preg_match('/' . $rule->getRule() . '/im', $key, $matchKey);
                preg_match('/' . $rule->getRule() . '/im', $value, $matchValue);
                if ($matchKey || $matchValue) {
                    return [
                        'status' => self::BLOCK_ACCESS,
                        'message' => $rule->getDescription(),
                        'impact' => $rule->getImpact()
                    ];
                }
            }
        }

        return [
            'status' => self::ALLOW_ACCESS
        ];
    }
}