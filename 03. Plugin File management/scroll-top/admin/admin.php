<?php
/**
 * Settings functions for the plugin.
 *
 * @package Scroll Top
 */

/**
 * Sets up the plugin settings page and registers the plugin settings.
 *
 * @link   http://codex.wordpress.org/Function_Reference/add_options_page
 */
function scroll_top_admin_menu() {

	$settings = add_options_page(
		esc_html__( 'Scroll To Top Settings', 'scroll-top' ),
		esc_html__( 'Scroll To Top', 'scroll-top' ),
		'manage_options',
		'scroll_top_settings_page',
		'scroll_top_plugin_settings_render_page'
	);

	if ( ! $settings ) {
		return;
	}

	// Provided hook_suffix that's returned to add scripts only on settings page.
	add_action( 'load-' . $settings, 'scroll_top_styles_scripts' );
}
add_action( 'admin_menu', 'scroll_top_admin_menu' );

/**
 * Enqueue custom styles & scripts for plugin usage.
 */
function scroll_top_styles_scripts() {

	// Load plugin admin style.
	wp_enqueue_style( 'scroll-top-css', trailingslashit( ST_ASSETS ) . 'css/scroll-top-admin.css', array( 'wp-color-picker' ), ST_VERSION );

	// Load plugin admin script.
	wp_enqueue_script( 'scroll-top-scripts', trailingslashit( ST_ASSETS ) . 'js/scroll-top-admin.js', array( 'jquery', 'wp-color-picker' ), ST_VERSION, true );
}

/**
 * Registers the Scroll To Top settings.
 *
 * @link   http://codex.wordpress.org/Function_Reference/register_setting
 */
function scroll_top_register_settings() {

	register_setting(
		'scroll_top_settings',
		'scroll_top_plugin_settings',
		'scroll_top_plugin_settings_validate'
	);
}
add_action( 'admin_init', 'scroll_top_register_settings' );

/**
 * Register the setting sections and fields.
 *
 * @link   http://codex.wordpress.org/Function_Reference/add_settings_section
 * @link   http://codex.wordpress.org/Function_Reference/add_settings_field
 */
function scroll_top_setting_sections_fields() {

	// Add General section.
	add_settings_section(
		'scroll_top_general_settings',
		'',
		'__return_false',
		'scroll_top_settings_page'
	);

	// Add enable/disable checkbox setting field.
	add_settings_field(
		'scroll_top_enable',
		esc_html__( 'Enable', 'scroll-top' ),
		'scroll_top_enable_field',
		'scroll_top_settings_page',
		'scroll_top_general_settings'
	);

	// Add enable/disable on mobile checkbox setting field.
	add_settings_field(
		'scroll_top_mobile_enable',
		esc_html__( 'Mobile', 'scroll-top' ),
		'scroll_top_mobile_enable_field',
		'scroll_top_settings_page',
		'scroll_top_general_settings'
	);

	// Add enable/disable async script checkbox setting field.
	add_settings_field(
		'scroll_top_async_enable',
		esc_html__( 'Async script', 'scroll-top' ),
		'scroll_top_async_enable_field',
		'scroll_top_settings_page',
		'scroll_top_general_settings'
	);

	// Add 'type' selectbox setting field.
	add_settings_field(
		'scroll_top_type',
		esc_html__( 'Type', 'scroll-top' ),
		'scroll_top_type_field',
		'scroll_top_settings_page',
		'scroll_top_general_settings'
	);

	// Add 'text' input setting field.
	add_settings_field(
		'scroll_top_text',
		esc_html__( 'Text', 'scroll-top' ),
		'scroll_top_text_field',
		'scroll_top_settings_page',
		'scroll_top_general_settings'
	);

	// Add 'position' selectbox setting field.
	add_settings_field(
		'scroll_top_position',
		esc_html__( 'Position', 'scroll-top' ),
		'scroll_top_position_field',
		'scroll_top_settings_page',
		'scroll_top_general_settings'
	);

	// Add 'color' input setting field.
	add_settings_field(
		'scroll_top_color',
		esc_html__( 'Color', 'scroll-top' ),
		'scroll_top_color_field',
		'scroll_top_settings_page',
		'scroll_top_general_settings'
	);

	// Add 'background color' input setting field.
	add_settings_field(
		'scroll_top_bg_color',
		esc_html__( 'Background Color', 'scroll-top' ),
		'scroll_top_bg_color_field',
		'scroll_top_settings_page',
		'scroll_top_general_settings'
	);

	// Add 'radius' radio setting field.
	add_settings_field(
		'scroll_top_radius',
		esc_html__( 'Style', 'scroll-top' ),
		'scroll_top_radius_field',
		'scroll_top_settings_page',
		'scroll_top_general_settings'
	);

	// Add 'animation' radio setting field.
	add_settings_field(
		'scroll_top_animation',
		esc_html__( 'Animation', 'scroll-top' ),
		'scroll_top_animation_field',
		'scroll_top_settings_page',
		'scroll_top_general_settings'
	);

	// Add 'speed' input setting field.
	add_settings_field(
		'scroll_top_speed',
		esc_html__( 'Speed', 'scroll-top' ),
		'scroll_top_speed_field',
		'scroll_top_settings_page',
		'scroll_top_general_settings'
	);

	// Add 'Distance' input setting field.
	add_settings_field(
		'scroll_top_distance',
		esc_html__( 'Distance', 'scroll-top' ),
		'scroll_top_distance_field',
		'scroll_top_settings_page',
		'scroll_top_general_settings'
	);

	// Add 'Target' input setting field.
	add_settings_field(
		'scroll_top_target',
		esc_html__( 'Target (optional)', 'scroll-top' ),
		'scroll_top_target_field',
		'scroll_top_settings_page',
		'scroll_top_general_settings'
	);

	// Add 'Custom CSS' textarea setting field.
	add_settings_field(
		'scroll_top_css',
		esc_html__( 'Custom CSS', 'scroll-top' ),
		'scroll_top_css_field',
		'scroll_top_settings_page',
		'scroll_top_general_settings'
	);
}
add_action( 'admin_init', 'scroll_top_setting_sections_fields' );

/**
 * Enable/disable field
 */
function scroll_top_enable_field() {
	$settings = scroll_top_get_plugin_settings( 'scroll_top_enable' );
	?>

	<fieldset>
		<legend class="screen-reader-text"><span><?php esc_html_e( 'Enable', 'scroll-top' ); ?></span></legend>
		<p>
			<label for="enable_scroll_top">
				<input id="enable_scroll_top" type="checkbox" name="scroll_top_plugin_settings[scroll_top_enable]" value="1" <?php checked( 1, $settings ); ?> />
				<?php esc_html_e( 'Enable Back To Top?', 'scroll-top' ); ?>
			</label>
		</p>
	</fieldset>

	<?php
}

/**
 * Enable/disable on mobile field
 */
function scroll_top_mobile_enable_field() {
	$settings = scroll_top_get_plugin_settings( 'scroll_top_mobile_enable' );
	?>

	<fieldset>
		<legend class="screen-reader-text"><span><?php esc_html_e( 'Mobile', 'scroll-top' ); ?></span></legend>
		<p>
			<label for="scroll_top_mobile_enable">
				<input id="scroll_top_mobile_enable" type="checkbox" name="scroll_top_plugin_settings[scroll_top_mobile_enable]" value="1" <?php checked( 1, $settings ); ?> />
				<?php esc_html_e( 'Enable on mobile?', 'scroll-top' ); ?>
			</label>
		</p>
	</fieldset>

	<?php
}

/**
 * Enable/disable on mobile field
 */
function scroll_top_async_enable_field() {
	$settings = scroll_top_get_plugin_settings( 'scroll_top_async_enable' );
	?>

	<fieldset>
		<legend class="screen-reader-text"><span><?php esc_html_e( 'Async script', 'scroll-top' ); ?></span></legend>
		<p>
			<label for="scroll_top_async_enable">
				<input id="scroll_top_async_enable" type="checkbox" name="scroll_top_plugin_settings[scroll_top_async_enable]" value="1" <?php checked( 1, $settings ); ?> />
				<?php esc_html_e( 'Enable async to improve performance.', 'scroll-top' ); ?>
			</label>
		</p>
	</fieldset>

	<?php
}

/**
 * Type field
 */
function scroll_top_type_field() {
	$settings = scroll_top_get_plugin_settings( 'scroll_top_type' );
	?>

	<fieldset>
		<legend class="screen-reader-text"><span><?php esc_html_e( 'Type', 'scroll-top' ); ?></span></legend>
		<p>
			<label>
				<input class="scroll-top-type" type="radio" name="scroll_top_plugin_settings[scroll_top_type]" value="icon" <?php checked( 'icon', $settings ); ?> />
				<?php esc_html_e( 'Icon', 'scroll-top' ); ?>
			</label><br />

			<label>
				<input class="scroll-top-type" type="radio" name="scroll_top_plugin_settings[scroll_top_type]" value="text" <?php checked( 'text', $settings ); ?> />
				<?php esc_html_e( 'Text', 'scroll-top' ); ?>
			</label>
		</p>
	</fieldset>

	<?php
}

/**
 * Text field
 */
function scroll_top_text_field() {
	$settings = scroll_top_get_plugin_settings( 'scroll_top_text' );
	?>
	<input class="regular-text" id="scroll-top-text" type="text" name="scroll_top_plugin_settings[scroll_top_text]" value="<?php echo esc_attr( $settings ); ?>" />

	<?php
}

/**
 * Position field
 */
function scroll_top_position_field() {
	$settings = scroll_top_get_plugin_settings( 'scroll_top_position' );
	?>

	<fieldset class="scroll-top-vertical">
		<legend class="screen-reader-text"><span><?php esc_html_e( 'Position', 'scroll-top' ); ?></span></legend>
		<p>
			<label>
				<input type="radio" name="scroll_top_plugin_settings[scroll_top_position]" value="right" <?php checked( 'right', $settings ); ?> />
				<?php esc_html_e( 'Right Side', 'scroll-top' ); ?>
			</label>

			<label>
				<input type="radio" name="scroll_top_plugin_settings[scroll_top_position]" value="left" <?php checked( 'left', $settings ); ?> />
				<?php esc_html_e( 'Left Side', 'scroll-top' ); ?>
			</label>
		</p>
	</fieldset>

	<?php
}

/**
 * Color field
 */
function scroll_top_color_field() {
	$settings = scroll_top_get_plugin_settings( 'scroll_top_color' );
	?>
	<input class="color-scroll" type="text" name="scroll_top_plugin_settings[scroll_top_color]" value="<?php echo esc_attr( $settings ); ?>" data-default-color="#ffffff" />
	<?php
}

/**
 * Background Color field
 */
function scroll_top_bg_color_field() {
	$settings = scroll_top_get_plugin_settings( 'scroll_top_bg_color' );
	?>
	<input class="color-scroll" type="text" name="scroll_top_plugin_settings[scroll_top_bg_color]" value="<?php echo esc_attr( $settings ); ?>" data-default-color="#000000" />
	<?php
}

/**
 * Radius field
 */
function scroll_top_radius_field() {
	$settings = scroll_top_get_plugin_settings( 'scroll_top_radius' );
	?>
	<fieldset class="scroll-top-vertical">
		<legend class="screen-reader-text"><span><?php esc_html_e( 'Radius', 'scroll-top' ); ?></span></legend>
		<p class="checkbox-img">
			<label>
				<input type="radio" name="scroll_top_plugin_settings[scroll_top_radius]" value="rounded" <?php checked( 'rounded', $settings ); ?> />
				<span class="scroll-top-demo scroll-top-demo-rounded"><svg width="36px" height="36px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
						<defs>
							<style>
								.top-icon {
									fill: none;
									stroke-linecap: round;
									stroke-linejoin: bevel;
									stroke-width: 1.5px;
									stroke: #fff;
								}
							</style>
						</defs>
						<g id="ic-chevron-top">
							<path class="top-icon" d="M16.78,14.2l-4.11-4.11a1,1,0,0,0-1.41,0l-4,4" />
						</g>
					</svg>
				</span>
				<span class="screen-reader-text"><?php esc_html_e( 'Rounded', 'scroll-top' ); ?></span>
			</label>

			<label>
				<input type="radio" name="scroll_top_plugin_settings[scroll_top_radius]" value="square" <?php checked( 'square', $settings ); ?> />
				<span class="scroll-top-demo scroll-top-demo-square"><svg width="36px" height="36px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
						<defs>
							<style>
								.top-icon {
									fill: none;
									stroke-linecap: round;
									stroke-linejoin: bevel;
									stroke-width: 1.5px;
									stroke: #fff;
								}
							</style>
						</defs>
						<g id="ic-chevron-top">
							<path class="top-icon" d="M16.78,14.2l-4.11-4.11a1,1,0,0,0-1.41,0l-4,4" />
						</g>
					</svg>
				</span>
				<span class="screen-reader-text"><?php esc_html_e( 'Square', 'scroll-top' ); ?></span>
			</label>

			<label>
				<input type="radio" name="scroll_top_plugin_settings[scroll_top_radius]" value="circle" <?php checked( 'circle', $settings ); ?> />
				<span class="scroll-top-demo scroll-top-demo-circle"><svg width="36px" height="36px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
						<defs>
							<style>
								.top-icon {
									fill: none;
									stroke-linecap: round;
									stroke-linejoin: bevel;
									stroke-width: 1.5px;
									stroke: #fff;
								}
							</style>
						</defs>
						<g id="ic-chevron-top">
							<path class="top-icon" d="M16.78,14.2l-4.11-4.11a1,1,0,0,0-1.41,0l-4,4" />
						</g>
					</svg>
				</span>
				<span class="screen-reader-text"><?php esc_html_e( 'Circle', 'scroll-top' ); ?></span>
			</label>
		</p>
	</fieldset>
	<?php
}

/**
 * Animation field
 */
function scroll_top_animation_field() {
	$settings = scroll_top_get_plugin_settings( 'scroll_top_animation' );
	?>
	<fieldset class="scroll-top-vertical">
		<legend class="screen-reader-text"><span><?php esc_html_e( 'Animation', 'scroll-top' ); ?></span></legend>
		<p>
			<label>
				<input type="radio" name="scroll_top_plugin_settings[scroll_top_animation]" value="fade" <?php checked( 'fade', $settings ); ?> />
				<?php esc_html_e( 'Fade', 'scroll-top' ); ?>
			</label>

			<label>
				<input type="radio" name="scroll_top_plugin_settings[scroll_top_animation]" value="slide" <?php checked( 'slide', $settings ); ?> />
				<?php esc_html_e( 'Slide', 'scroll-top' ); ?>
			</label>

			<label>
				<input type="radio" name="scroll_top_plugin_settings[scroll_top_animation]" value="none" <?php checked( 'none', $settings ); ?> />
				<?php esc_html_e( 'None', 'scroll-top' ); ?>
			</label>
		</p>
	</fieldset>
	<?php
}

/**
 * Speed field
 */
function scroll_top_speed_field() {
	$settings = scroll_top_get_plugin_settings( 'scroll_top_speed' );
	?>
	<input name="scroll_top_plugin_settings[scroll_top_speed]" type="number" step="50" min="50" id="scroll_top_speed" value="<?php echo (int) $settings; ?>" class="small-text" />
	<?php esc_html_e( ' millisecond', 'scroll-top' ); ?>
	<?php
}

/**
 * Distance field
 */
function scroll_top_distance_field() {
	$settings = scroll_top_get_plugin_settings( 'scroll_top_distance' );
	?>
	<input name="scroll_top_plugin_settings[scroll_top_distance]" type="number" step="100" min="100" id="scroll_top_distance" value="<?php echo (int) $settings; ?>" class="small-text" />
	<?php esc_html_e( ' px', 'scroll-top' ); ?>
	<?php
}

/**
 * Target field
 */
function scroll_top_target_field() {
	$settings = scroll_top_get_plugin_settings( 'scroll_top_target' );
	?>
	<input name="scroll_top_plugin_settings[scroll_top_target]" type="text" id="scroll_top_target" value="<?php echo esc_attr( $settings ); ?>" />
	<?php esc_html_e( ' example: #page', 'scroll-top' ); ?>
	<?php
}

/**
 * Custom CSS
 */
function scroll_top_css_field() {
	$settings = scroll_top_get_plugin_settings( 'scroll_top_css' );
	?>
	<textarea name="scroll_top_plugin_settings[scroll_top_css]" id="scroll_top_css" cols="50" rows="12"><?php echo esc_attr( $settings ); ?></textarea>
	<?php
}

/**
 * Render the plugin settings page.
 */
function scroll_top_plugin_settings_render_page() {
	?>

	<div class="wrap">

		<h2><?php esc_html_e( 'Scroll To Top Settings', 'scroll-top' ); ?></h2>

		<div id="poststuff">

			<div id="post-body" class="scroll-top-settings metabox-holder columns-2">

				<div id="post-body-content">
					<form method="post" action="options.php">
						<?php settings_fields( 'scroll_top_settings' ); ?>
						<?php do_settings_sections( 'scroll_top_settings_page' ); ?>
						<?php submit_button( esc_html__( 'Save Settings', 'scroll-top' ), 'primary large' ); ?>
					</form>
				</div><!-- .post-body-content -->

				<div id="postbox-container-1" class="postbox-container">
					<div class="postbox">
						<h3>Support The Project</h3>
						<div class="inside">
							<p>If you want to support this plugin, please consider donating to help keep it going. I truly appreciate any contribution.</p>
							<a href="https://paypal.me/satrya" target="_blank" class="button-primary">Buy me a Coffee</a>
						</div>
					</div>
				</div><!-- .postbox-container -->

			</div><!-- .scroll-top-settings -->

			<br class="clear">
		</div>

	</div>

	<?php
}

/**
 * Validates/sanitizes the plugins settings after they've been submitted.
 *
 * @param array $settings The plugin settings.
 */
function scroll_top_plugin_settings_validate( $settings ) {

	// Set up an array of valid settings.
	$valid_type     = array( 'text', 'icon' );
	$valid_position = array( 'left', 'right' );
	$valid_radius   = array( 'square', 'rounded', 'circle' );
	$valid_animate  = array( 'fade', 'slide', 'none' );

	// If the option is NOT in the array, set it to a default option. Do nothing if the option is valid.
	if ( ! in_array( $settings['scroll_top_type'], $valid_type, true ) ) {
		$settings['scroll_top_type'] = 'icon';
	}

	if ( ! in_array( $settings['scroll_top_position'], $valid_position, true ) ) {
		$settings['scroll_top_position'] = 'right';
	}

	if ( ! in_array( $settings['scroll_top_radius'], $valid_radius, true ) ) {
		$settings['scroll_top_radius'] = 'rounded';
	}

	if ( ! in_array( $settings['scroll_top_animation'], $valid_animate, true ) ) {
		$settings['scroll_top_animation'] = 'fade';
	}

	$settings['scroll_top_enable']        = isset( $settings['scroll_top_enable'] ) ? (bool) $settings['scroll_top_enable'] : false;
	$settings['scroll_top_mobile_enable'] = isset( $settings['scroll_top_mobile_enable'] ) ? (bool) $settings['scroll_top_mobile_enable'] : false;
	$settings['scroll_top_async_enable']  = isset( $settings['scroll_top_async_enable'] ) ? (bool) $settings['scroll_top_async_enable'] : false;
	$settings['scroll_top_text']          = sanitize_text_field( $settings['scroll_top_text'] );
	$settings['scroll_top_color']         = sanitize_hex_color( $settings['scroll_top_color'] );
	$settings['scroll_top_bg_color']      = sanitize_hex_color( $settings['scroll_top_bg_color'] );
	$settings['scroll_top_speed']         = absint( $settings['scroll_top_speed'] );
	$settings['scroll_top_distance']      = absint( $settings['scroll_top_distance'] );
	$settings['scroll_top_target']        = sanitize_text_field( $settings['scroll_top_target'] );
	$settings['scroll_top_css']           = sanitize_text_field( $settings['scroll_top_css'] );

	return $settings;
}
