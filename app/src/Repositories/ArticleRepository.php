<?php
namespace App\Repositories;

use App\Framework\Repository;
use App\Models\ArticleModel;
use PDO;

class ArticleRepository extends Repository implements IArticleRepository
{
    public function getAll(): array
    {
        $sql = "SELECT * FROM article";
        $stmt = $this->connection->query($sql);
        // Map result directly to ArticleModel class
        return $stmt->fetchAll(PDO::FETCH_CLASS, ArticleModel::class);
    }

    public function create(ArticleModel $article): void
    {
        // We will implement this later, but the interface requires it to exist
    }
}