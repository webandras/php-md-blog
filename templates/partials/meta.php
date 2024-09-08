<?php

if ($page_name !== 'post' && !isset($frontmatter)) {
    $description = $website_description;
    $title       = $website_name;
    $url         = BASE_URL. ($language_code !== DEFAULT_LANGUAGE ? ($language_code.'/') : '') .($page_name !== 'index' ? $page_name : '');
    $image       = BASE_URL.'assets/images/static.jpg';
} else {
    $description = $frontmatter['excerpt'];
    $title       = $frontmatter['title'];
    $url         = $frontmatter['slug'];
    $image       = BASE_URL.$frontmatter['cover_image'];
}
?>

    <!-- Metas for social media-->
    <meta name="description" content="<?= $description ?>"/>
    <meta property="og:title" content="<?= $title ?>"/>
    <meta property="og:url" content="<?= $url ?>"/>
    <meta property="og:site_name" content="<?= $website_name ?>"/>
    <meta property="og:description" content="<?= $description ?>"/>
    <meta property="og:image" content="<?= $image ?>"/>
    <meta property="og:type" content="website"/>

    <!-- Twitter -->
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="<?= $website_name ?>"/>
    <meta name="twitter:creator" content="<?= $author ?>"/>
    <meta name="twitter:title" content="<?= $title ?>"/>
    <meta name="twitter:description" content="<?= $description ?>"/>
    <meta name="twitter:url" content="<?= $url ?>"/>
    <meta name="twitter:image" content="<?= $image ?>"/>

    <link rel="canonical" href="<?= $url ?>"/>
