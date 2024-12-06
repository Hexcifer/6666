<?php
include 'database.php';

$articles = getArticles($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>aranboy</title>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="header">
    <div class="header-bar">
      <h1>Aran Japan</h1>
      <nav class="navigation">
        <ul>
          <li><a href="#">News</a></li>
          <li><a href="#">Japan Travel</a></li>
          <li><a href="#">Entertainment</a></li>
          <li><a href="#">Anime Manga</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <div class="articles">
  <?php foreach ($articles as $article): ?>
  <article>
  <a href="article-detail.php?id=<?= htmlspecialchars($article['id']) ?>">
      <img src="<?= htmlspecialchars($article['image_url']) ?>" alt="<?= htmlspecialchars($article['alt_text']) ?>">
      <h3><?= htmlspecialchars($article['title']) ?></h3>
    </a>
    <p class="date"><?= date("F d, Y", strtotime($article['publication_date'])) ?></p>
    <p class="description"><?= htmlspecialchars($article['description']) ?></p>
  </article>
  <?php endforeach; ?>
</div>
  <footer>
    <p>&copy; 2024 Aran Japan</p>
  </footer>
</body>
</html>