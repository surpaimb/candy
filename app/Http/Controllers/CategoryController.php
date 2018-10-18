<?php

namespace App\Http\Controllers;

use GetCandyClient;
use App\Http\Requests\Request;

use App\Api\Search\Services\SearchService;

class CategoryController extends Controller
{
    protected $search;
    public function __construct(SearchService $search)
    {
        parent::__construct();

        $this->search = $search;
    }

    public function index()
    {
        // List all parent categories
        return view('categories');
    }

    public function show(Request $request, $slug)
    {
        // Get Category
        $routes = GetCandyClient::Routes($slug.'?includes=element')->get();
        if (!isset($routes['data']['element']['data']['id']) || $routes['data']['type'] !== 'category') {
            return abort(404);
        }

        // Get Category
        $categoryID = $routes['data']['element']['data']['id'];
        $categoryParams['includes'] = 'routes,assets,channels';

        $category = GetCandyClient::Categories($categoryID.'?'.http_build_query($categoryParams))->get();

        // TODO Get snapshot of search results
        // $sortBy = $request->sortby ?? 'created_at-desc';
        // list($sortField, $sortDir) = explode('-', $sortBy);

        // Build Filters
        $filters = $request->get('filters');
        $filters[] = [
            'name' => 'categories',
            'value' => $categoryID
        ];

        // Build Pagination
        $pagination['per_page'] = $request->display ?? 10;
        $pagination['current_page'] = $request->page ?? 1;

        $searchResults = $this->search->get("", $filters, $pagination, 'product');

        return view('category')
            ->with('category', $category['data'])
            ->with('page', $request->page)
            ->with('display', $request->display)
            ->with('sortBy', $request->sortby)
            ->with('searchResults', $searchResults);
    }
}
