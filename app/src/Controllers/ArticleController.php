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
        // 1. Get data
        $articles = $this->articleService->getAll();

        // 2. Load the view (pass $articles so the view can see it)
        require __DIR__ . '/../Views/articles/index.php';
    }
}