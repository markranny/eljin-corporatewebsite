<?php
/**
 * Template part for displaying navigation
 */
?>

<nav class="navigation-wrapper" id="navigation" role="navigation" aria-label="Main navigation">
    <div class="nav-circle">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-item" aria-label="Home">
            <span>Home</span>
        </a>
        <a href="<?php echo esc_url(home_url('/about')); ?>" class="nav-item" aria-label="About">
            <span>About</span>
        </a>
        <a href="<?php echo esc_url(home_url('/menu')); ?>" class="nav-item" aria-label="Menu">
            <span>Menu</span>
        </a>
        <a href="<?php echo esc_url(home_url('/franchise')); ?>" class="nav-item" aria-label="Franchise">
            <span>Franchise</span>
        </a>
        <a href="<?php echo esc_url(home_url('/career')); ?>" class="nav-item" aria-label="Career">
            <span>Career</span>
        </a>
        <a href="<?php echo esc_url(home_url('/locations')); ?>" class="nav-item" aria-label="Locations">
            <span>Locations</span>
        </a>
    </div>
</nav>

<!-- Mobile Navigation Toggle -->
<button class="nav-toggle" id="navToggle" aria-label="Toggle navigation" aria-expanded="false">
    <span></span>
    <span></span>
    <span></span>
</button>