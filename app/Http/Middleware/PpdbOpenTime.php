<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;

class PpdbOpenTime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (app()->environment("local") || $this->openTime())
            return $next($request);
        else {
            return redirect("ppdb/waiting");
        }
    }

    private function openTime() {
        $now = Carbon::today();
        $openDate = Carbon::create(null, 06, 21,0,0,0);
        $closeDate = Carbon::create(null, 07, 20,0,0,0);
        if ($now >=$openDate && $now <= $closeDate) {
            return true;
        }
        return false;
    }
}
