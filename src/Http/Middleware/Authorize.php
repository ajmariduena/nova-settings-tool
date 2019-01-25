<?php

namespace Ajmariduena\SettingsTool\Http\Middleware;

use Ajmariduena\SettingsTool\SettingsTool;

class Authorize
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        return resolve(SettingsTool::class)->authorize($request) ? $next($request) : abort(403);
    }
}
