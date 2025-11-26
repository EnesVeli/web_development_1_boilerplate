<?php

namespace App\Services;

use App\Models\ArticleModel;

interface IArticleService{
    public function getAll() : array;
    public function create(ArticleModel $article) : void;
    public function get(int $id) : ?ArticleModel;
    public function update(ArticleModel $article) : void;

    public function delete(int $id) : void;
}