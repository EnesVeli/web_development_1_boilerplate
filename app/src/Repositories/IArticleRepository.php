<?php

namespace App\Repositories;

use App\Repositories\IArticleRepository;
use App\Models\ArticleModel;

class ArticleRepository implements IArticleRepository
{
    public fucntion getAll(): array
    {
        // Implementation to retrieve all articles
        return [];
    }

    public function create(ArticleModel $article): void 
    {
        //
    }
}

