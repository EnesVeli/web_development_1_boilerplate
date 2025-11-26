<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <!-- Add Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootsrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php if (!empty($posts)) { ?>
    <h1>Guestbook Entries</h1>
    <ul>
        <?php foreach ($posts as $post) { ?>
        <li>
            <p>Name: <?=  htmlspecialchars($post['name']); ?></p>
            <p>Message: <?= htmlspecialchars($post['message']); ?></p>
        </li>
        <?php } ?>
    </ul>
    <?php } else { ?>
    <p>No guestbook entries found.</p>
    <?php } ?>
    <div class="mt-5">
        <h2 class="mb-3">Add a New Entry</h2>
        <form action="/guestbook" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email ">Email (optional)</label>
                <input type="email" id="email" class="form-control" name="email" placeholder="name@example.com">
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>