<?php
function bostami_theme_menu() {
	add_theme_page( 'Theme Options', 'Theme Options', 'edit_theme_options', 'bostami-theme-options', 'bostami_theme_page' );
}

add_action( 'admin_menu', 'bostami_theme_menu' );

function bostami_register_settings() {
	register_setting( 'bostami_options_group', 'bostami_what_i_do_items', 'bostami_sanitize_options' );
	register_setting( 'bostami_options_group', 'bostami_selected_page', 'absint' );
	register_setting( 'bostami_options_group', 'bostami_profile_image', 'esc_url_raw' );
	register_setting( 'bostami_options_group', 'bostami_profile_name', 'sanitize_text_field' );
	register_setting( 'bostami_options_group', 'bostami_job_title', 'sanitize_text_field' );
	register_setting( 'bostami_options_group', 'bostami_clients', 'bostami_sanitize_clients_options' );
	register_setting( 'bostami_options_group', 'bostami_clients_page', 'absint' );

}

add_action( 'admin_init', 'bostami_register_settings' );

function bostami_enqueue_media_uploader() {
	wp_enqueue_media();
}

add_action( 'admin_enqueue_scripts', 'bostami_enqueue_media_uploader' );

function bostami_sanitize_clients_options( $options ) {
	$sanitized_options = [];
	if ( is_array( $options ) && ! empty( $options ) ) {
		foreach ( $options as $item ) {
			$sanitized_item = [];
			if ( ! empty( $item['image'] ) ) {
				$sanitized_item['image'] = esc_url_raw( $item['image'] );
			}
			if ( ! empty( $item['url'] ) ) {
				$sanitized_item['url'] = esc_url_raw( $item['url'] );
			}
			$sanitized_options[] = $sanitized_item;
		}
	}

	return $sanitized_options;
}

function bostami_sanitize_options( $options ) {
	$sanitized_options = [];
	if ( is_array( $options ) && ! empty( $options ) ) {
		foreach ( $options as $item ) {
			$sanitized_item = [];
			if ( ! empty( $item['title'] ) ) {
				$sanitized_item['title'] = sanitize_text_field( $item['title'] );
			}
			if ( ! empty( $item['description'] ) ) {
				$sanitized_item['description'] = sanitize_textarea_field( $item['description'] );
			}
			if ( ! empty( $item['icon'] ) ) {
				$sanitized_item['icon'] = esc_url_raw( $item['icon'] );
			}
			$sanitized_options[] = $sanitized_item;
		}
	}

	return $sanitized_options;
}

function bostami_enqueue_theme_options_scripts( $hook ) {
	if ( 'appearance_page_bostami-theme-options' !== $hook ) {
		return;
	}
	wp_enqueue_script( 'bostami-admin-js', get_template_directory_uri() . '/admin-options.js', array( 'jquery' ), null, true );
	wp_enqueue_media();
	wp_enqueue_style( 'bostami-admin-css', get_template_directory_uri() . '/admin-style.css' );
}

add_action( 'admin_enqueue_scripts', 'bostami_enqueue_theme_options_scripts' );

function bostami_theme_page() {
	$options       = get_option( 'bostami_what_i_do_items' );
	$selected_page = get_option( 'bostami_selected_page' );
	$profile_image = get_option( 'bostami_profile_image' );
	$profile_name  = get_option( 'bostami_profile_name' );
	$job_title     = get_option( 'bostami_job_title' );

	$profile_image = get_option( 'bostami_profile_image' );
	?>
	<div class="wrap">
		<h1>Theme Options</h1>
		<h2 class="nav-tab-wrapper">
			<a href="#profile" class="nav-tab nav-tab-active" data-tab="profile">Profile</a>
			<a href="#what-i-do" class="nav-tab" data-tab="what-i-do">What I Do</a>
			<a href="#clients" class="nav-tab" data-tab="clients">Clients</a>
		</h2>
		<form method="post" action="options.php">
			<?php settings_fields( 'bostami_options_group' ); ?>
			<?php do_settings_sections( 'bostami-theme-options' ); ?>

			<div id="profile" class="tab-content active">
				<h2>Profile Settings</h2>
				<table class="form-table">
					<tr>
						<th scope="row"><label for="bostami_profile_image">Profile Image:</label></th>
						<td>
							<input type="text" id="bostami_profile_image" name="bostami_profile_image"
							       value="<?php echo esc_attr( $profile_image ); ?>" class="regular-text">
							<button type="button" class="button bostami_upload_button" data-input="bostami_profile_image">Upload
								Image
							</button>
							<img src="<?php echo esc_attr( $profile_image ); ?>" class="bostami_icon_preview"
							     style="max-width: 100px; max-height: 100px;"/>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="bostami_profile_name">Profile Name:</label></th>
						<td><input type="text" id="bostami_profile_name" name="bostami_profile_name"
						           value="<?php echo esc_attr( $profile_name ); ?>" class="regular-text"></td>
					</tr>
					<tr>
						<th scope="row"><label for="bostami_job_title">Job Title:</label></th>
						<td><input type="text" id="bostami_job_title" name="bostami_job_title"
						           value="<?php echo esc_attr( $job_title ); ?>" class="regular-text"></td>
					</tr>
				</table>
			</div>

			<div id="what-i-do" class="tab-content">
				<h2>Display Settings</h2>
				<table class="form-table">
					<tr>
						<th scope="row">
							<label for="bostami_selected_page">On which page you want this section to be shown:</label>
						</th>
						<td>
							<select id="bostami_selected_page" name="bostami_selected_page">
								<?php
								// Get list of pages
								$pages = get_pages();
								foreach ( $pages as $page ) {
									$option = '<option value="' . intval( $page->ID ) . '"';
									$option .= selected( $selected_page, $page->ID, false );
									$option .= '>';
									$option .= $page->post_title;
									$option .= '</option>';
									echo $option;
								}
								?>
							</select>
						</td>
					</tr>
				</table>

				<h2>What I Do</h2>
				<div id="bostami_what_i_do_container">
					<?php
					if ( ! empty( $options ) ) {
						foreach ( $options as $index => $item ) {
							?>
							<div class="bostami_what_i_do_item">
								<p>
									<label for="bostami_icon_<?php echo $index; ?>">Icon:</label>
									<input type="hidden" id="bostami_icon_<?php echo $index; ?>"
									       name="bostami_what_i_do_items[<?php echo $index; ?>][icon]"
									       value="<?php echo esc_attr( $item['icon'] ); ?>"/>
									<button type="button" class="button bostami_upload_button"
									        data-input="bostami_icon_<?php echo $index; ?>">Upload Icon
									</button>
									<input type="hidden" id="bostami_icon_<?php echo $index; ?>"
									       name="bostami_what_i_do_items[<?php echo $index; ?>][icon]"
									       value="<?php echo esc_attr( $item['icon'] ); ?>"/>
									<img src="<?php echo esc_attr( $item['icon'] ); ?>" class="bostami_icon_preview"
									     style="max-width: 100px; max-height: 100px;"/>
								</p>
								<p>
									<label>Title:</label>
									<input type="text" name="bostami_what_i_do_items[<?php echo $index; ?>][title]"
									       value="<?php echo esc_attr( $item['title'] ); ?>"/>
								</p>
								<p>
									<label>Description:</label>
									<textarea
										name="bostami_what_i_do_items[<?php echo $index; ?>][description]"><?php echo esc_textarea( $item['description'] ); ?></textarea>
								</p>
								<button type="button" class="button bostami_remove_icon_button">Remove Element</button>
							</div>
							<?php
						}
					}
					?>
				</div>
				<button type="button" id="bostami_add_new_item" class="button">Add New Element</button>
			</div>

			<div id="clients" class="tab-content">
				<h2>Clients</h2>
				<table class="form-table">
					<tr>
						<th scope="row">
							<label for="bostami_clients_page">Select a page for Clients:</label>
						</th>
						<td>
							<select id="bostami_clients_page" name="bostami_clients_page">
								<?php
								$pages                 = get_pages();
								$selected_clients_page = get_option( 'bostami_clients_page' );
								foreach ( $pages as $page ) {
									$option = '<option value="' . intval( $page->ID ) . '"';
									$option .= selected( $selected_clients_page, $page->ID, false );
									$option .= '>';
									$option .= $page->post_title;
									$option .= '</option>';
									echo $option;
								}
								?>
							</select>
						</td>
					</tr>
				</table>
				<div id="bostami_clients_container">
					<?php
					$clients = get_option( 'bostami_clients' );
					if ( ! empty( $clients ) ) {
					foreach ( $clients

					as $index => $item ) {
					?>
					<p class="bostami_client_item">
					<p>
						<label for="bostami_client_image_<?php echo $index; ?>">Client Image:</label>
						<input type="text" id="bostami_client_image_<?php echo $index; ?>"
						       name="bostami_clients[<?php echo $index; ?>][image]"
						       value="<?php echo esc_attr( $item['image'] ); ?>" class="regular-text"/>
						<button type="button" class="button bostami_upload_button"
						        data-input="bostami_client_image_<?php echo $index; ?>">Upload Image
						</button>
						<img src="<?php echo esc_attr( $item['image'] ); ?>" class="bostami_icon_preview"
						     style="max-width: 100px; max-height: 100px;"/>
					</p>
					<p>
						<label for="bostami_client_url_<?php echo $index; ?>">Client URL:</label>
						<input type="url" id="bostami_client_url_<?php echo $index; ?>"
						       name="bostami_clients[<?php echo $index; ?>][url]" value="<?php echo esc_attr( $item['url'] ); ?>"
						       class="regular-text"/>
					</p>
					<button type="button" class="button bostami_remove_client_button">Remove Client</button>
				</div>
				<?php
				}
				}
				?>
			</div>
			<button type="button" id="bostami_add_new_client" class="button">Add New Client</button>
	</div>

	<?php submit_button(); ?>
	</form>
	</div>
	<script type="text/template" id="bostami_what_i_do_template">
		<div class="bostami_what_i_do_item">
			<p>
				<label for="bostami_icon_{{index}}">Icon:</label>
				<input type="hidden" id="bostami_icon_{{index}}" name="bostami_what_i_do_items[{{index}}][icon]" value=""/>
				<!-- Notice the addition of the data-input attribute here -->
				<button type="button" class="button bostami_upload_button" data-input="bostami_icon_{{index}}">Upload Icon
				</button>
				<img src="" class="bostami_icon_preview" style="max-width: 100px; max-height: 100px;"/>
			</p>
			<p>
				<label>Title:</label>
				<input type="text" name="bostami_what_i_do_items[{{index}}][title]" value=""/>
			</p>
			<p>
				<label>Description:</label>
				<textarea name="bostami_what_i_do_items[{{index}}][description]"></textarea>
			</p>
			<button type="button" class="button bostami_remove_icon_button">Remove Element</button>
		</div>
	</script>
	<script type="text/template" id="bostami_client_template">
		<div class="bostami_client_item">
			<p>
				<label for="bostami_client_image_{{index}}">Client Image:</label>
				<input type="text" id="bostami_client_image_{{index}}" name="bostami_clients[{{index}}][image]" value=""
				       class="regular-text"/>
				<button type="button" class="button bostami_upload_button" data-input="bostami_client_image_{{index}}">Upload
					Image
				</button>
			</p>
			<p>
				<label for="bostami_client_url_{{index}}">Client URL:</label>
				<input type="url" id="bostami_client_url_{{index}}" name="bostami_clients[{{index}}][url]" value=""
				       class="regular-text"/>
			</p>
			<button type="button" class="button bostami_remove_client_button">Remove Client</button>
		</div>
	</script>
	<?php
}

