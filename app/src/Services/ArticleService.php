<?php

namespace App\Services;

use App\Services\IArticleService;
use App\Services\ArticlezService;
 
Class ArticleController
{
    private IArticleService $articleService;

    public function __construct()
    {
        $this->articleService = new ArticleService();
    }

    public function index()
    {
        $articles = $this->articleService->getAll();
        var_dump($articles);
    }
}