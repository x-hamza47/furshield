<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Shelter;
use App\Models\User;
use App\Models\Vet;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $petCount =  Pet::count();
        $vetCount = Vet::count();
        $shelterCount = Shelter::count();
        $ownerCount = User::where('role', 'owner')->count();
        return view('site.index', compact('petCount', 'vetCount', 'shelterCount', 'ownerCount'));
    }

    public function article(Request $request)
    {

        $path = storage_path('app/articles.json');

        if (!file_exists($path)) {
            abort(500, "articles.json not found");
        }

        $articles = collect(json_decode(file_get_contents($path), true));

        // Apply filters
        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $articles = $articles->filter(function ($article) use ($search) {
                return str_contains(strtolower($article['title']), $search) ||
                    str_contains(strtolower($article['content']), $search);
            });
        }

        if ($request->filled('category')) {
            $articles = $articles->where('category', $request->category);
        }

        return view('site.articles', [
            'articles' => $articles,
            'search'   => $request->search,
            'category' => $request->category,
            'categories' => collect(json_decode(file_get_contents($path), true))
                ->pluck('category')
                ->unique()
        ]);
    }
    public function articleShow($id)
    {
        $path = storage_path('app/articles.json');

        if (!file_exists($path)) {
            abort(500, "articles.json not found");
        }

        $articles = collect(json_decode(file_get_contents($path), true));

        // Find the article by ID
        $article = $articles->firstWhere('id', (int) $id);

        if (!$article) {
            abort(404, "Article not found");
        }

        return view('site.article', compact('article'));
    }
}
