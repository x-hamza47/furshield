<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the articles (public + admin).
     */
    public function index(Request $request)
    {
        $path = storage_path('app/articles.json');

        if (!file_exists($path)) {
            abort(500, "articles.json not found");
        }

        $articles = collect(json_decode(file_get_contents($path), true));

        // Filtering: search
        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $articles = $articles->filter(function ($article) use ($search) {
                return str_contains(strtolower($article['title']), $search)
                    || str_contains(strtolower($article['content']), $search);
            });
        }

        // Filtering: category
        if ($request->filled('category')) {
            $articles = $articles->where('category', $request->category);
        }

        // Sort (newest first)
        $articles = $articles->sortByDesc('id')->values();

        // Pagination
        $perPage = 6;
        $currentPage = $request->input('page', 1);
        $currentItems = $articles->slice(($currentPage - 1) * $perPage, $perPage);
        $paginated = new \Illuminate\Pagination\LengthAwarePaginator(
            $currentItems,
            $articles->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // Categories for filter dropdown
        $categories = $articles->pluck('category')->unique();

        // 🔑 Detect if route is admin (dashboard) or public
        if ($request->is('dashboard/*')) {
            return view('dashboard.admin.articles.list', [
                'articles'   => $paginated,
                'categories' => $categories,
            ]);
        }

        return view('articles.list', [
            'articles'   => $paginated,
            'categories' => $categories,
            'search'     => $request->search,
            'category'   => $request->category,
        ]);
    }


    /**
     * Show one article (public).
     */
    public function show($id)
    {
        $path = storage_path('app/articles.json');

        if (!file_exists($path)) {
            abort(500, "articles.json not found");
        }

        $articles = collect(json_decode(file_get_contents($path), true));

        $article = $articles->firstWhere('id', (int) $id);

        abort_unless($article, 404);

        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for creating a new article (admin only).
     */
    public function create()
    {
        return view('dashboard.admin.articles.create');
    }

    /**
     * Store a new article (admin only).
     */
    // public function store(Request $request)
    // {
    //     // $this->authorizeAdmin();

    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'category' => 'required|string|max:100',
    //         'content' => 'required|string',
    //     ]);

    //     $path = storage_path('app/articles.json');
    //     $articles = collect(json_decode(file_get_contents($path), true) ?? []);

    //     $nextId = ($articles->max('id') ?? 0) + 1;

    //     $articles->push([
    //         'id' => $nextId,
    //         'title' => $request->title,
    //         'category' => $request->category,
    //         'content' => $request->content,
    //     ]);

    //     Storage::put('articles.json', $articles->toJson(JSON_PRETTY_PRINT));

    //     return redirect()->route('articles.index')->with('success', 'Article created successfully.');
    // }

    /**
     * Show edit form (admin only).
     */
    public function edit($id)
    {
        // Ensure only admins can access
        // if (Auth()::check() || auth()->user()->role !== 'admin') {
        //     abort(403, 'Unauthorized action.');
        // }

        $path = storage_path('app/articles.json');

        if (!file_exists($path)) {
            abort(500, "articles.json not found");
        }

        $decoded = json_decode(file_get_contents($path), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            abort(500, "Invalid JSON format in articles.json");
        }

        $articles = collect($decoded);

        $article = $articles->firstWhere('id', (int) $id);

        abort_unless($article, 404);

        $categories = $articles->pluck('category')->unique();

        return view('dashboard.admin.articles.edit', compact('article', 'categories'));
    }


    /**
     * Update an existing article (admin only).
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'content'  => 'required|string',
        ]);

        $path = storage_path('app/articles.json');

        if (!file_exists($path)) {
            abort(500, "articles.json not found");
        }

        $decoded = json_decode(file_get_contents($path), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            abort(500, "Invalid JSON format in articles.json");
        }

        $articles = collect($decoded);

        $index = $articles->search(fn($a) => $a['id'] == $id);

        abort_if($index === false, 404);

        $articles[$index] = array_merge($articles[$index], [
            'title'    => $request->title,
            'category' => $request->category,
            'content'  => $request->content,
        ]);

        // Write back to storage using storage_path + file_put_contents
        $written = file_put_contents($path, $articles->toJson(JSON_PRETTY_PRINT));

        if ($written === false) {
            abort(500, "Failed to write articles.json");
        }

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article updated successfully.');
    }



    /**
     * Delete an article (admin only).
     */
public function destroy($id)
{
    $path = storage_path('app/articles.json');

    if (!file_exists($path)) {
        abort(500, "articles.json not found");
    }

    $decoded = json_decode(file_get_contents($path), true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        abort(500, "Invalid JSON format in articles.json");
    }

    $articles = collect($decoded);

    // Remove the article with the given ID
    $articles = $articles->reject(fn($a) => $a['id'] == $id)->values();

    // Write updated JSON back to file
    $written = file_put_contents($path, $articles->toJson(JSON_PRETTY_PRINT));

    if ($written === false) {
        abort(500, "Failed to write articles.json");
    }

    return redirect()->route('admin.articles.index')
        ->with('success', 'Article deleted successfully.');
}


    /**
     * Utility: Restrict methods to admin role only.
     */
    private function authorizeAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
    }
}
