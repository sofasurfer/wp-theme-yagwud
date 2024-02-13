<!DOCTYPE html>
<html lang="de-DE" id="open-navigation" class="close-navigation">
    <head>
        <?php
        $og_info = apply_filters('c_get_ogobj','');
        ?>
        <meta charset="utf-8">
        <title><?= $og_info['title']; ?></title>
        <meta name="author" content="Sofasurfer">
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
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Radio+Canada:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet"> 
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= get_stylesheet_directory_uri(); ?>/assets/css/justifiedGallery.css">
        <link rel="stylesheet" href="<?= get_stylesheet_directory_uri(); ?>/assets/css/main.css?v=<?= do_shortcode('[wp_version]') ;?>">
        <link rel="stylesheet" href="<?= get_stylesheet_directory_uri(); ?>/assets/css/nav.css?v=<?= do_shortcode('[wp_version]') ;?>">

        <script>
            var img_active = 0;
            var images = [];
        </script>
    </head>
    <body id="top" class="<?= get_field('template'); ?>">
        <div id="y-offcanvas-menu">
            <?php wp_nav_menu(
                array(
                    'theme_location' => 'header-menu',
                    'container'      => false,
                    'menu_class'     => 'c-header-navigation',
                )
            ); ?>
            <section class="sticky">
            <div class="bubbles">
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                
            </div>
            </section>
        </div>
        <input type="checkbox" id="y-offcanvas-trigger" name="y-offcanvas" />
        <nav class="">
            <label for="y-offcanvas-trigger">
                <div class="hamburger-lines">
                    <span class="line line1"></span>
                    <span class="line line2"></span>
                    <span class="line line3"></span>
                </div>
            </label>
        </nav> 