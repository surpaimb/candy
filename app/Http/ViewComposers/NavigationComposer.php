<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use GetCandyClient;

class NavigationComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $categories = GetCandyClient::categories('?includes=routes')->get();
        $view->with('categories', $categories['data']);
    }
}
