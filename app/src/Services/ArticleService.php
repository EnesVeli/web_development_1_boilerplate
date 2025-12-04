<?php
namespace App\Services;

use App\Repositories\IArticleRepository;
use App\Repositories\ArticleRepository;

class ArticleService implements IArticleService
{
    private IArticleRepository $repository;

    public function __construct()
    {
        // In the future we will use Dependency Injection, for now we manually create it
        $this->repository = new ArticleRepository();
    }

    public function getAll(): array
    {
        return $this->repository->getAll();
    }

    // Required by Interface
    public function create(\App\Models\ArticleModel $article): void {}
    public function get(int $id): ?\App\Models\ArticleModel { return null; }
    public function update(\App\Models\ArticleModel $article): void {}
    public function delete(int $id): void {}
}