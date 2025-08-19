<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of blog articles.
     */
    public function index(Request $request)
    {
        $query = Article::published()->with('author');
        
        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('excerpt', 'like', "%{$searchTerm}%")
                  ->orWhere('content', 'like', "%{$searchTerm}%")
                  ->orWhere('tags', 'like', "%{$searchTerm}%");
            });
        }
        
        // Category filter (multiple categories)
        if ($request->filled('category')) {
            $categories = $request->category;
            $query->whereIn('category', $categories);
        }
        
        // Sorting
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'oldest':
                $query->oldest('published_at');
                break;
            case 'popular':
                $query->orderBy('views', 'desc');
                break;
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            case 'latest':
            default:
                $query->latest('published_at');
                break;
        }
        
        // Get articles with pagination
        $articles = $query->paginate(12);
        
        // Get categories for sidebar
        $categories = Article::getCategories();
        
        return view('blog.index', compact('articles', 'categories'));
    }
    
    /**
     * Display the specified article.
     */
    public function show(Article $article)
    {
        // Check if article is published
        if (!$article->is_published || !$article->published_at || $article->published_at > now()) {
            abort(404);
        }
        
        // Increment views
        $article->incrementViews();
        
        // Get related articles
        $relatedArticles = Article::published()
            ->with('author')
            ->where('category', $article->category)
            ->where('id', '!=', $article->id)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();
        
        return view('blog.show', compact('article', 'relatedArticles'));
    }
}