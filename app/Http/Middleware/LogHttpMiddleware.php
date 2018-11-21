<?php
/**
 * Created for someline-starter.
 * User: Libern
 */

namespace App\Http\Middleware;

use Closure;
use Log;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * This is the oauth middleware class.
 *
 * @author Luca Degasperi <packages@lucadegasperi.com>
 */
class LogHttpMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws HttpException
     */
    public function handle($request, Closure $next)
    {
        $response =  $next($request);
        //
        if(env('LOG_REQUEST_AND_RESPONSE',false)){
            Log::info('Dump request and response:', [
                'request' => $request,
               'response' => $response,
            ]);
        }
        return $response;
    }



}

