<?php
/*
Plugin Name: DPLOY
Plugin URI:
Description: Dashboard widget to trigger a webhook and deploy
Version: 0.4.3
Author: Jeremy Pittard
Author URI: jpittard.net
License: cc0
License URI: 
*/

add_action( 'wp_dashboard_setup', 'jp_dashboard_add_widgets' );
function jp_dashboard_add_widgets() {
	wp_add_dashboard_widget( 'jp_dashboard_dploy', __( 'DPLOY', 'jp' ), 'jp_dashboard_dploy_handler', 'jp_dashboard_dploy_config_handler' );
}

function jp_dashboard_dploy_handler() {
	$options = wp_parse_args( get_option( 'jp_dashboard_dploy' ), jp_dashboard_dploy_config_defaults() );
    ?> 
    <button id="dploy-button" type="button" data-address="<?php echo $options["address"] ?>">Click to build changes</button>
    <?php
}

function jp_dashboard_dploy_config_defaults() {
	return array(
		'address' => 'jpittard.net',
	);
}

function jp_dashboard_dploy_config_handler() {
	$options = wp_parse_args( get_option( 'jp_dashboard_dploy' ), jp_dashboard_dploy_config_defaults() );

	if ( isset( $_POST['submit'] ) ) {
		if ( isset( $_POST['dploy_address'] ) ) {
			$options['address'] = $_POST['dploy_address'];
		}

		update_option( 'jp_dashboard_dploy', $options );
	}

    ?>
	<p>
		<label><?php _e( 'address:', 'jp' ); ?>
			<input type="text" name="dploy_address" value="<?php echo esc_attr( $options['address'] ); ?>" />
		</label>
	</p>
	<?php
}

add_action( 'admin_enqueue_scripts', 'jp_scripts' );
function jp_scripts( $hook ) {
	$screen = get_current_screen();
	if ( 'dashboard' === $screen->id ) {
		wp_enqueue_script( 'jp_script', plugin_dir_url( __FILE__ ) . '/assets/scripts.js', array(), '1.0', true );
		// wp_enqueue_style( 'jp_style', plugin_dir_url( __FILE__ ) . 'path/to/style.css', array(), '1.0' );
	}
}