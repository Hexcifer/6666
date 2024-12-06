<?php
include 'database.php';

if (isset($_GET['id'])) {
    $articleId = intval($_GET['id']);

    $query = $conn->prepare("SELECT * FROM articles WHERE id = ?");
    $query->bind_param("i", $articleId);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $article = $result->fetch_assoc();
    } else {
        http_response_code(404);
        echo "<h1>Article not found</h1>";
        exit;
    }
} else {
    http_response_code(400);
    echo "<h1>Invalid request</h1>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($article['title']) ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #1a1c2c;
            color: #f5f5f5;
        }

        header {
            background-color: #3b415a;
            padding: 15px;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        header h1 {
            font-size: 28px;
            color: #ffffff;
        }

        img {
            display: block;
            margin: 20px auto;
            max-width: 70%;
            height: auto;
            border-radius: 8px;
        }

        .content {
            padding: 30px;
            line-height: 1.8;
        }

        .content .date {
            font-size: 16px;
            color: #cccccc;
            margin-bottom: 20px;
        }

        .content p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        footer {
            background-color: #3b415a;
            text-align: center;
            padding: 10px;
            color: #ffffff;
            font-size: 14px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        @media (max-width: 768px) {
            header h1 {
                font-size: 24px;
            }

            .content p {
                font-size: 16px;
            }

            img {
                max-width: 90%;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1><?= htmlspecialchars($article['title']) ?></h1>
    </header>
    <main>
        <img src="<?= htmlspecialchars($article['image_url']) ?>" alt="<?= htmlspecialchars($article['alt_text']) ?>">
        <div class="content">
            <p class="date"><?= date("F d, Y", strtotime($article['publication_date'])) ?></p>
            <p><?= nl2br(htmlspecialchars($article['description'])) ?></p>
            <p><?= nl2br(htmlspecialchars($article['content TEXT'])) ?></p>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Aran Japan</p>
    </footer>
</body>
</html>
