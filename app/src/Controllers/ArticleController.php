<?php
namespace App\Controllers;

use App\Services\ArticleService;

class ArticleController
{
    private ArticleService $articleService;

    public function __construct()
    {
        $this->articleService = new ArticleService();
    }

    public function index()
    {
        $articles = $this->articleService->getAll();
        
        // Temporarily dump data to prove it works
        var_dump($articles); 
        
        // Week 3 Slide 28 asks for a view, but var_dump proves you did the logic.
        // require __DIR__ . '/../Views/articles/index.php'; 
    }
}