<!DOCTYPE html>
<html lang="de-DE" id="open-navigation" class="close-navigation">
    <head>
        <?php
        $og_info = apply_filters('c_get_ogobj','');
        ?>
        <meta charset="utf-8">
        <title><?= $og_info['title']; ?></title>
        <meta name="author" content="Neofluxe GmbH">
        <meta name="description" content="<?= $og_info['description']; ?>">


        <meta property="og:locale" content="<?= $og_info['locale']; ?>"/>
        <meta property="og:type" content="article"/>
        <meta property="og:title" content="<?= $og_info['title']; ?>"/>
        <meta property="og:description" content="<?= $og_info['description']; ?>"/>
        <?php if(!empty($og_info['image'])): ?>
        <meta property="og:image" content="<?= $og_info['image'][0]; ?>"/>
        <meta property="og:image:width" content="<?= $og_info['image'][1]; ?>" />
        <meta property="og:image:height" content="<?= $og_info['image'][2]; ?>" />
        <?php endif; ?>



        <link rel="apple-touch-icon" sizes="180x180" href="<?= get_stylesheet_directory_uri(); ?>/assets/images/icon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?= get_stylesheet_directory_uri(); ?>/assets/images/icon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?= get_stylesheet_directory_uri(); ?>/assets/images/icon/favicon-16x16.png">
        <link rel="manifest" href="<?= get_stylesheet_directory_uri(); ?>/assets/images/icon/site.webmanifest">
        <link rel="mask-icon" href="<?= get_stylesheet_directory_uri(); ?>/assets/images/icon/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">


        <!-- Preventing IE11 to request by default the /browserconfig.xml more than one time -->
        <meta name="msapplication-config" content="none">
        <!-- Disable touch highlighting in IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <!-- Ensure edge compatibility in IE (HTTP header can be set in web server config) -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <!-- Force viewport width and pixel density. Plus, disable shrinking. -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Disable Skype browser-plugin -->
        <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">

        <link rel="stylesheet" href="<?= get_stylesheet_directory_uri(); ?>/assets/css/justifiedGallery.css">
        <link rel="stylesheet" href="<?= get_stylesheet_directory_uri(); ?>/assets/css/main.css">

        <script>
            var img_active = 0;
            var images = [];
        </script>
    </head>
    <body id="top">