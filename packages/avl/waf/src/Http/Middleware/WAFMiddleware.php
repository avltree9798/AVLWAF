<?php

namespace AVL\WAF\Http\Middleware;

use App\User;
use AVL\WAF\Blacklist;
use AVL\WAF\WAF;
use Closure;

class WAFMiddleware extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $auth = base64_decode($request->header('authorization'), true);
        if ( ! $auth) {
            return response()->json([
                'success' => false,
                'message' => 'Client key or Client secret is wrong'
            ]);
        }
        $authorization = explode(':', $auth);
        if (count($authorization) !== 3) {
            return response()->json([
                'success' => false,
                'message' => 'Client key or Client secret is wrong'
            ]);
        }
        $clientKey = $authorization[0];
        $clientSecret = $authorization[1];
        $ip = $authorization[2];
        $user = User::whereClientKey($clientKey)->whereClientSecret($clientSecret)->first();
        if ($user !== null) {
            /**
             * @var \AVL\WAF\WAF $firewall
             */
            $firewall = app()->make('waf');
            //        $firewall->setDisable();
            if ($this->enabled()) {
                if (Blacklist::whereIp($ip)->whereUserId($user->id)->first() !== null) {
                    return $firewall->blockAccess([
                        'status'  => WAF::BLOCK_ACCESS,
                        'message' => 'This IP has been blacklisted',
                        'ip'      => $ip,
                        'user'    => $user,
                        'payload' => $request->all(),
                        'url'     => $request->get('url')
                    ]);
                }
                $verdict = $firewall->analyzeTraffic($request);
                $verdict['ip'] = $ip;
                $verdict['user'] = $user;
                $verdict['payload'] = $request->all();
                $verdict['url'] = $request->input('url');
                if ($verdict['status'] === WAF::BLOCK_ACCESS) {
                    return $firewall->blockAccess($verdict);
                }
            }

            return $next($request);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Client key or Client secret is wrong'
            ]);
        }
    }
}
