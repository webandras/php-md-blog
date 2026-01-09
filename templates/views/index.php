<!DOCTYPE html>
<html lang="<?= $current_language_code ?>">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>

    <link href="<?= BASE_URL.'assets/css/main.css' ?>" rel="stylesheet" type="text/css"/>

    <title><?= $our_name ?></title>

    <?php
    require $root_dir.'/templates/partials/meta.php';
    ?>

    <script type="text/javascript">
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body>

<?php
require $root_dir . '/templates/partials/header.php'; ?>

<main class="container container-narrow">

    <?php
    require $root_dir . '/templates/partials/introduction.php'; ?>

    <section>
        <h2><?= $newest_writings_text ?></h2>
        <ol class="post-list">
            <?php
            foreach ($posts as $post) { ?>
                <li>
                    <time class="post-date"><?= $post['date'] ?></time>
                    <h3>
                        <a href="<?= $post['slug'] ?>"><?= $post['title'] ?></a>
                    </h3>
                    <p><?= $post['excerpt'] ?></p>
                </li>
                <?php
            } ?>
        </ol>
        <p>
            <a href="<?= BASE_URL ?>archive"><?= $archive_text ?> &raquo;</a>
        </p>
    </section>
</main>

<?php
require $root_dir . '/templates/partials/footer.php'; ?>

<script src="<?= BASE_URL . 'assets/js/main.js' ?>"></script>

</body>
</html>

