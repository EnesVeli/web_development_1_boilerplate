<?php
namespace App\Repositories;

use App\Models\ArticleModel;

interface IArticleRepository
{
    public function getAll(): array;
    public function create(ArticleModel $article): void;
}