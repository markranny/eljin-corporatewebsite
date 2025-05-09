<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    
    <!-- Unique Circular Navigation -->
    <div class="nav-toggle" id="navToggle">
        <span></span>
        <span></span>
        <span></span>
    </div>
    
    <nav class="navigation-wrapper" id="navigation">
        <div class="nav-circle">
            <a href="<?php echo home_url(); ?>" class="nav-item">
                <span>Home</span>
            </a>
            <a href="<?php echo home_url('/about'); ?>" class="nav-item">
                <span>About</span>
            </a>
            <a href="<?php echo home_url('/menu'); ?>" class="nav-item">
                <span>Menu</span>
            </a>
            <a href="<?php echo home_url('/franchise'); ?>" class="nav-item">
                <span>Franchise</span>
            </a>
            <a href="<?php echo home_url('/career'); ?>" class="nav-item">
                <span>Career</span>
            </a>
            <a href="<?php echo home_url('/locations'); ?>" class="nav-item">
                <span>Locations</span>
            </a>
        </div>
    </nav>