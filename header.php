<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content="A collection of scripts and other content made by Graal Online players"/>
    <title>G-Archive - Graal's player-made content archive</title>
    <?php wp_head() ?>
</head>
    
<body <?php body_class(); ?>>
<div id="search">
    <div class="container">
        <form action="<?php echo esc_url(home_url('/')); ?>">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-10">
                    <input type="text" name="s" id="searchBox" placeholder="Type your query here..." />
                </div>
                <div class="col-12 col-sm-4 col-md-2">
                    <button id="searchBtn" type="submit">
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
                        <ul class="gar-list-flat gar-header-nav">
                            <li><a href="<?php echo esc_url(home_url('/category/scripts')) ?>">Scripts</a></li>
                            <li><a href="<?php echo esc_url(home_url('/category/server-backups')) ?>">Backups</a></li>
                            <li><a href="<?php echo esc_url(home_url('/category/tools')) ?>">Tools</a></li>
                            <li><a href="<?php echo esc_url(home_url('/category/levels')) ?>">Other</a></li>
                            <li><a href="#" data-toggle="search"><span class="fa fa-search"></span></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
</div>

    