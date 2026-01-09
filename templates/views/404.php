<!DOCTYPE html>
<html lang="<?= $current_language_code ?>">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>

    <link href="<?= BASE_URL . 'assets/css/main.css' ?>" rel="stylesheet" type="text/css"/>

    <title><?= $our_name ?></title>

    <?php
    require $root_dir . '/templates/partials/meta.php';
    ?>

    <script type="text/javascript">
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' ||
            (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
        ) {
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
    <section class="page-404">
        <h1><?= $page_not_found_title_text ?></h1>
        <p><?= $page_not_found_description_text ?></p>
        <a href="<?= BASE_URL ?>" class="button"><?= $page_not_found_link_text ?></a>
    </section>
</main>

<?php
require $root_dir . '/templates/partials/footer.php'; ?>

<script src="<?= BASE_URL . 'assets/js/main.js' ?>"></script>

</body>
</html>
