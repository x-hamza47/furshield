<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $article['title'] }} - PetCare Article</title>
  <style>
    body {
      margin: 0;
      padding: 20px;
      background: #f8f9fc;
      font-family: 'Inter', sans-serif;
      line-height: 1.6;
      color: #333;
    }

    .article-container {
      max-width: 900px;
      margin: 0 auto;
    }

    .article-card {
      background: #fff;
      border-radius: 14px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      padding: 40px 30px;
    }

    .article-category {
      font-size: 0.9rem;
      font-weight: 600;
      color: #6a11cb;
      text-transform: uppercase;
      margin-bottom: 10px;
      display: inline-block;
    }

    .article-title {
      font-size: 2rem;
      font-weight: 800;
      margin-bottom: 20px;
      color: #222;
    }

    .article-content {
      font-size: 1rem;
      color: #444;
      white-space: pre-line; /* keep line breaks if JSON content has them */
    }

    .btn-back {
      display: inline-block;
      margin-top: 25px;
      padding: 10px 16px;
      border-radius: 8px;
      background: #f0f2ff;
      color: #2575fc;
      font-weight: 600;
      text-decoration: none;
      transition: background 0.2s;
    }

    .btn-back:hover {
      background: #e0e3ff;
    }
  </style>
</head>
<body>

  <div class="article-container">
    <div class="article-card">
      <div class="article-category">{{ $article['category'] }}</div>
      <h1 class="article-title">{{ $article['title'] }}</h1>
      <div class="article-content">
        {{ $article['content'] }}
      </div>
      <a href="{{ route('articles.index') }}" class="btn-back">← Back to Articles</a>
    </div>
  </div>

</body>
</html>