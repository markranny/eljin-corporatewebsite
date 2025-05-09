<?php
/**
 * Upgrade to pro options
 */
function fresh_bakery_cake_upgrade_pro_options( $wp_customize ) {

	$wp_customize->add_section(
		'upgrade_premium',
		array(
			'title'    => esc_html__( 'About Fresh Bakery Cake', 'fresh-bakery-cake' ),
			'priority' => 1,
		)
	);

	class Fresh_Bakery_Cake_Pro_Button_Customize_Control extends WP_Customize_Control {
		public $type = 'upgrade_premium';

		function render_content() {
			?>
			<div class="pro_info">
				<ul>
				    <li><a class="upgrade-to-pro pro-btn" href="<?php echo esc_url( FRESH_BAKERY_CAKE_PREMIUM_PAGE ); ?>" target="_blank"><i class="dashicons dashicons-cart"></i><?php esc_html_e( 'Upgrade Pro', 'fresh-bakery-cake' ); ?> </a></li>

					<li><a class="upgrade-to-pro" href="<?php echo esc_url( FRESH_BAKERY_CAKE_PRO_DEMO ); ?>" target="_blank"><i class="dashicons dashicons-awards"></i><?php esc_html_e( 'Premium Demo', 'fresh-bakery-cake' ); ?> </a></li>
					
					<li><a class="upgrade-to-pro" href="<?php echo esc_url( FRESH_BAKERY_CAKE_REVIEW ); ?>" target="_blank"><i class="dashicons dashicons-star-filled"></i><?php esc_html_e( 'Rate Us', 'fresh-bakery-cake' ); ?> </a></li>
								
					<li><a class="upgrade-to-pro" href="<?php echo esc_url( FRESH_BAKERY_CAKE_SUPPORT ); ?>" target="_blank"><i class="dashicons dashicons-lightbulb"></i><?php esc_html_e( 'Support Forum', 'fresh-bakery-cake' ); ?> </a></li>
				
					<li><a class="upgrade-to-pro" href="<?php echo esc_url( FRESH_BAKERY_CAKE_THEME_PAGE ); ?>" target="_blank"><i class="dashicons dashicons-admin-appearance"></i><?php esc_html_e( 'Theme Page', 'fresh-bakery-cake' ); ?> </a></li>

					<li><a class="upgrade-to-pro" href="<?php echo esc_url( FRESH_BAKERY_CAKE_THEME_DOCUMENTATION ); ?>" target="_blank"><i class="dashicons dashicons-visibility"></i><?php esc_html_e( 'Theme Documentation', 'fresh-bakery-cake' ); ?> </a></li>

				</ul>
			</div>
			<?php
		}
	}

	$wp_customize->add_setting(
		'pro_info_buttons',
		array(
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'fresh_bakery_cake_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Fresh_Bakery_Cake_Pro_Button_Customize_Control(
			$wp_customize,
			'pro_info_buttons',
			array(
				'section' => 'upgrade_premium',
			)
		)
	);
}
add_action( 'customize_register', 'fresh_bakery_cake_upgrade_pro_options' );
