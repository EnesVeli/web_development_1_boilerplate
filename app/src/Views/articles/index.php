<!DOCTYPE html>
<html>

<head>
    <title>Articles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Articles</h1>
        <?php foreach ($articles as $article): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($article->title) ?></h5>
                <h6 class="card-subtitle mb-2 text-muted">By <?= htmlspecialchars($article->author) ?></h6>
                <p class="card-text"><?= htmlspecialchars($article->content) ?></p>
                <small class="text-muted">Posted on: <?= htmlspecialchars($article->datetime) ?></small>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</body>

</html>