<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ELJIN - BWSUPERBAKESHOP - Premium Bakery with Fresh Bread, Pastries, and Cakes">
    <meta name="keywords" content="bakery, bread, pastries, cakes, ELJIN, BWSUPERBAKESHOP, fresh baked goods">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div class="site-wrapper">
        <!-- Side Navigation -->
        <nav class="side-nav" id="sideNav">
            <div class="nav-toggle" id="navToggle">☰</div>
            <div class="logo-section">
                <?php 
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo '<h2>ELJIN<br>BWSUPERBAKESHOP</h2>';
                }
                ?>
            </div>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'nav-menu',
                'fallback_cb' => 'bwsuperbakeshop_default_menu'
            ));
            ?>
        </nav>
        
        <!-- Main Content Area -->
        <main class="main-content" id="mainContent">