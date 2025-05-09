<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Skip Link -->
<a class="skip-link screen-reader-text" href="#main-content"><?php esc_html_e('Skip to content', 'eljin'); ?></a>

<!-- Preloader -->
<div class="preloader" id="preloader">
    <div class="loader"></div>
</div>
    
<!-- Unique Circular Navigation -->
<button class="nav-toggle" id="navToggle" aria-label="Toggle navigation">
    <span></span>
    <span></span>
    <span></span>
</button>

<nav class="navigation-wrapper" id="navigation" role="navigation" aria-label="Main navigation">
    <div class="nav-circle">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-item">
            <span>Home</span>
        </a>
        <a href="<?php echo esc_url(home_url('/about')); ?>" class="nav-item">
            <span>About</span>
        </a>
        <a href="<?php echo esc_url(home_url('/menu')); ?>" class="nav-item">
            <span>Menu</span>
        </a>
        <a href="<?php echo esc_url(home_url('/franchise')); ?>" class="nav-item">
            <span>Franchise</span>
        </a>
        <a href="<?php echo esc_url(home_url('/career')); ?>" class="nav-item">
            <span>Career</span>
        </a>
        <a href="<?php echo esc_url(home_url('/locations')); ?>" class="nav-item">
            <span>Locations</span>
        </a>
    </div>
</nav>