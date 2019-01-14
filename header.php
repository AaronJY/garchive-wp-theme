<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-75664743-2"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-75664743-2');
    </script>


    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content="A collection of scripts and other content made by Graal Online players"/>
    <title><?php echo get_bloginfo('name'); ?> - <?php echo get_bloginfo('description'); ?></title>
    <?php wp_head() ?>
</head>
    
<body <?php body_class(); ?>>

<?php
$curr_user = wp_get_current_user();
?>


    <div class="gar-userbox">
        <?php if ($curr_user->ID !== 0) : ?>
            <span class="gar-userbox-username"><?php echo $curr_user->user_login ?></span>
            <a href="<?php echo wp_logout_url(esc_url(home_url('/'))) ?>">Logout</a>
        <?php else : ?>
            <a href="<?php echo wp_login_url(esc_url(home_url('/'))) ?>">Login</a>
        <?php endif; ?>
    </div>


<div id="search">
    <div class="container">
        <form action="<?php echo esc_url(home_url('/')); ?>">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-10">
                    <input type="text" name="s" id="searchBox" class="gar-input" placeholder="Type your query here..." />
                </div>
                <div class="col-12 col-sm-4 col-md-2">
                    <button id="searchBtn" class="gar-btn" type="submit">
                        <span class="fa fa-search"></span>&nbsp;Search
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="container">
    <header class="gar-header">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="gar-header-title">
                    <a href="<?php echo esc_url(home_url('/')) ?>"><?php echo get_bloginfo('name'); ?></a>
                </span>
            </div>
            <div class="col-sm-12">
                <div class="text-center">
                    <nav>
                        <!-- <ul class="gar-list-flat gar-header-nav">
                            <li><a href="<?php echo esc_url(home_url('/category/scripts')) ?>">Scripts</a></li>
                            <li><a href="<?php echo esc_url(home_url('/category/server-backups')) ?>">Backups</a></li>
                            <li><a href="<?php echo esc_url(home_url('/category/tools')) ?>">Tools</a></li>
                            <li><a href="<?php echo esc_url(home_url('/category/levels')) ?>">Other</a></li>
                            <li><a href="#" data-toggle="search"><span class="fa fa-search"></span></a></li>
                            <li class="gar-menu-submit"><a href="<?php echo esc_url(home_url('/submit')) ?>">Submit</a></li>
                        </ul> -->

                        <div class="gar-header-nav">
                            <?php 
                                wp_nav_menu(array(
                                    'theme_location' => 'header-menu'
                                ));
                            ?>
                        </div>
                        
                    </nav>
                </div>
            </div>
        </div>
    </header>
</div>

    