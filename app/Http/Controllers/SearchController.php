<?php

namespace App\Http\Controllers;

use App\Api\Search\Services\SearchService;

use GetCandyClient;
use App\Http\Requests\SearchRequest;

class SearchController extends Controller
{
    protected $search;

    public function __construct(SearchService $search)
    {
        parent::__construct();

        $this->search = $search;
    }

    public function index(SearchRequest $request)
    {
        // List all parent categories
        return view('search')
            ->with('searchTerm', $request->q)
            ->with('page', $request->page)
            ->with('display', $request->display);
    }

    public function search(SearchRequest $request, $slug = null)
    {
        $params = [];

        // Set SortBy
        if ($request->has('sortBy') && $request->get('sortBy') !== null) {
            $sortBy = explode("-", $request->sortBy);
            $params['sort_by'][$sortBy[0]] = $sortBy[1];
        }

        try {
            $results = $this->search->get($request->get('keywords'), $request->get('filters'), $request->get('pagination'), 'product', $params);

        } catch(\Exception $e) {
            echo $e->getMessage();exit;
            return abort(404);
        }

        return response()->json($results);
    }
}
