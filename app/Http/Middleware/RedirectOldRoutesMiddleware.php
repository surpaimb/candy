<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use GuzzleHttp\Exception\ClientException;
use Session;

class RedirectOldRoutesMiddleware
{
    protected $redirected = false;

    protected $hardRedirects = [
        'cart' => 'basket',
        'about-us' => 'about',
        'profiles-add' => 'register',
        'trade-account-information' => 'trade'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $path = $request->segment(1);

        // Only worry if the route doesn't exist in laravel
        if ($path && !$this->hasRoute($path)) {
            // If it's in our hard redirects, just do it, no questions.
            if (isset($this->hardRedirects[$path])) {
                return redirect()->to($this->hardRedirects[$path], 301);
            }
            // Out of luck, try and get it from the API and redirect to it.
            if ($path = $this->getRoutePathFromApi($path)) {
                return redirect()->to($path, 301);
            }
        }

        return $next($request);
    }

    /**
     * Checks whether a path is actually loaded in laravel
     *
     * @param string $path
     *
     * @return boolean
     */
    private function hasRoute($path)
    {
        return in_array(
            $path,
            $this->getRouteSlugs()
        );
    }

    /**
     * Gets a fully qualified url from the api from a path
     *
     * @param string $path
     *
     * @return mixed
     */
    private function getRoutePathFromApi($path)
    {
        $newPath = null;
        try {
            $route = \GetCandyClient::Routes($path . '?includes=element')->get();
            $slug = $route['data']['slug'];
            switch ($route['data']['type']) {
                case 'category':
                    $newPath = route('categories.show', $slug);
                    break;
                case 'product':
                    $newPath = route('get-product', $slug);
                    break;
                default:
                    //
            }
        } catch (ClientException $e) {
            // Fall through, don't care
        }
        return $newPath;
    }

    /**
     * Get all routes as slugs that are loaded into Laravel
     *
     * @return array
     */
    private function getRouteSlugs()
    {
        $slugs = [];
        $routes = \Route::getRoutes();

        foreach ($routes as $route) {
            $slugs[] = $route->uri();
        }

        return array_unique($slugs);
    }
}
