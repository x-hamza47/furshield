<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles - PetCare</title>
    <style>
        body {
            margin: 0;
            padding: 20px;
            background: #f8f9fc;
            font-family: 'Inter', sans-serif;
        }

        h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
        }

        .filter-bar {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            padding: 15px 20px;
            margin-bottom: 25px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .filter-bar input,
        .filter-bar select,
        .filter-bar button,
        .filter-bar a {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 8px 12px;
            font-size: 0.95rem;
        }

        .filter-bar button {
            background: #6a11cb;
            color: #fff;
            cursor: pointer;
            border: none;
            transition: background 0.2s;
        }

        .filter-bar button:hover {
            background: #2575fc;
        }

        .filter-bar a {
            text-decoration: none;
            color: #333;
            background: #f1f1f1;
        }

        .article-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .article-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            padding: 20px;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        .article-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
        }

        .article-category {
            font-size: 0.8rem;
            font-weight: 600;
            color: #6a11cb;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .article-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: #333;
        }

        .article-excerpt {
            flex-grow: 1;
            font-size: 0.95rem;
            color: #555;
            margin-bottom: 15px;
        }

        .btn-read {
            display: inline-block;
            text-align: center;
            padding: 8px 12px;
            border-radius: 8px;
            background: #f0f2ff;
            color: #2575fc;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.2s;
        }

        .btn-read:hover {
            background: #e0e3ff;
        }

        .pagination {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 6px;
            list-style: none;
            padding: 0;
        }

        .pagination li a,
        .pagination li span {
            display: block;
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #ddd;
            color: #333;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .pagination li.active span {
            background: #6a11cb;
            color: #fff;
            border-color: #6a11cb;
        }

        .pagination li a:hover {
            background: #f0f2ff;
            border-color: #ccc;
        }
    </style>
</head>

<body>

    <h2>PetCare Articles</h2>

    <!-- Filter / Search -->
    <form action="{{ route('articles.index') }}" method="GET" class="filter-bar">
        <input type="text" name="search" placeholder="Search articles..." value="{{ $search }}">
        <select name="category">
            <option value="">All Categories</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat }}" {{ $cat == $category ? 'selected' : '' }}>
                    {{ $cat }}
                </option>
            @endforeach
        </select>
        <button type="submit">Filter</button>
        <a href="{{ route('articles.index') }}">Reset</a>
    </form>

    <!-- Articles Grid -->
    <div class="article-grid">
        @forelse ($articles as $article)
            <div class="article-card">
                <div class="article-category">{{ $article['category'] }}</div>
                <h3 class="article-title">
                    <a href="{{ route('articles.show', $article['id']) }}">
                        {{ $article['title'] }}
                    </a>
                </h3>
                <p class="article-excerpt">
                    {{ \Illuminate\Support\Str::limit($article['content'], 120, '...') }}
                </p>
                <a href="{{ route('articles.show', $article['id']) }}" class="btn-read">Read More</a>
            </div>
        @empty
            <p>No articles found.</p>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="pagination-wrapper">
        {{ $articles->links() }}
    </div>

</body>

</html>
