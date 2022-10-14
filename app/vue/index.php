<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actu</title>
</head>
<body>
    <header>
        <h1>Blog de Doud</h1>
        <?php
            $name = $user['first_name'] . ' ' . $user['last_name'];
            if ($user["admin"] == true) {
                $name = $name . ' (admin)';
            }
        ?>
        <h2><?=$name?></h2>
        <form action="/src/signout.php" method="POST">
            <button type="submit">Déconnexion</button>
        </form>
        <h3>Nouveau Post</h3>
        <form class="newPostForm" method="POST" action="/src/post.php" style="margin-top:20px; border: solid 1px black; padding: 10px; width: 300px">
            <label for="title">Titre</label><br>
            <input id="title" type="text" name="title"><br>
            <label for="contentInput">Article</label><br>
            <textarea id="contentInput" name="content" type="text"></textarea><br>
            <button class="submit" type="submit">Envoyer</button>
        </form>
    </header>
    <main>
        <h3> Actu </h3>
        <?php if ($articles):
            foreach ($articles as $article): ?>
                <div class="article" style="margin-top:20px; border: solid 1px black; padding: 10px; width: 500px">
                    <span class="title"><?= $article["title"]?></span><br>
                    <span class="content"><?= $article["content"] ?></span><br>
                    <span class="author"><?=$article["author"]?></span><br>
                    <?php if ($article["user_id"] === $user["id"] || $user["admin"] == true): ?>
                        <form class="deleteArticle" action="/src/delete.php" method="POST" style="margin-top: 10px">
                            <input type="hidden" name="articleId" value="<?= $article["id"] ?>">
                            <button type="submit">Supprimer</button>
                        </form>
                        <button class="modify" style="margin-top: 10px">Modifier</button>
                        <form class="modifyForm" action="/src/patch.php" method="POST">
                            <input class="modifyTitle" type="text" name="modifyTitle" value="<?= $article["title"] ?>"/><br>
                            <textarea name="modifyContent" value="<?= $article["content"] ?>"><?= $article["content"]?></textarea>
                            <input type="hidden" name="articleId" value="<?= $article["id"]?>">
                            <button type="submit">Valider</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach;
        else:
            echo 'Aucun articles';
        endif;?>
    </main>
    <footer>
        <script src="script/index.js?<?php echo time(); ?>"></script>
    </footer>
</body>
</html>