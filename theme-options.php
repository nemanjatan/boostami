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
	register_setting( 'bostami_options_group', 'bostami_portfolio_page', 'absint' );
	register_setting( 'bostami_options_group', 'bostami_phone', 'sanitize_text_field' );
	register_setting( 'bostami_options_group', 'bostami_email', 'sanitize_email' );
	register_setting( 'bostami_options_group', 'bostami_location', 'sanitize_text_field' );
	register_setting( 'bostami_options_group', 'bostami_birthday', 'sanitize_text_field' );
	register_setting( 'bostami_options_group', 'bostami_facebook', 'esc_url_raw' );
	register_setting( 'bostami_options_group', 'bostami_twitter', 'esc_url_raw' );
	register_setting( 'bostami_options_group', 'bostami_dribbble', 'esc_url_raw' );
	register_setting( 'bostami_options_group', 'bostami_linkedin', 'esc_url_raw' );
	register_setting( 'bostami_options_group', 'bostami_cv', 'esc_url_raw' );
	register_setting( 'bostami_options_group', 'bostami_resume_items', 'bostami_sanitize_options' );
	register_setting( 'bostami_options_group', 'bostami_resume_skills_items', 'bostami_sanitize_resume_skills_options' );
	register_setting( 'bostami_options_group', 'bostami_resume_knowledge_items', 'bostami_sanitize_resume_knowledge_options' );
	register_setting( 'bostami_options_group', 'bostami_resume_selected_page', 'absint' );
	register_setting( 'bostami_options_group', 'bostami_portfolio', 'bostami_sanitize_portfolio_options' );
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

function bostami_sanitize_portfolio_options( $options ) {
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
			if ( ! empty( $item['title'] ) ) {
				$sanitized_item['title'] = sanitize_text_field( $item['title'] );
			}
			if ( ! empty( $item['category'] ) ) {
				$sanitized_item['category'] = sanitize_text_field( $item['category'] );
			}
			$sanitized_options[] = $sanitized_item;
		}
	}

	return $sanitized_options;
}

function bostami_sanitize_resume_skills_options( $options ) {
	$sanitized_options = [];
	if ( is_array( $options ) ) {
		foreach ( $options as $option ) {
			$sanitized_option    = [
				'title'      => sanitize_text_field( $option['title'] ),
				'percentage' => max( 0, min( 100, intval( $option['percentage'] ) ) )
			];
			$sanitized_options[] = $sanitized_option;
		}
	}

	return $sanitized_options;
}

function bostami_sanitize_resume_knowledge_options( $options ) {
	$sanitized_options = [];
	if ( is_array( $options ) ) {
		foreach ( $options as $option ) {
			$sanitized_option    = [
				'title' => sanitize_text_field( $option['title'] ),
			];
			$sanitized_options[] = $sanitized_option;
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
			if ( ! empty( $item['year'] ) ) {
				$sanitized_item['year'] = sanitize_text_field( $item['year'] );
			}
			if ( ! empty( $item['type'] ) ) {
				$sanitized_item['type'] = sanitize_text_field( $item['type'] ); // Ensure 'type' is also sanitized
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
	$options                  = get_option( 'bostami_what_i_do_items' );
	$resume_options           = get_option( 'bostami_resume_items' );
	$resume_skills_options    = get_option( 'bostami_resume_skills_items' );
	$resume_knowledge_options = get_option( 'bostami_resume_knowledge_items' );
	$selected_page            = get_option( 'bostami_selected_page' );
	$resume_selected_page     = get_option( 'bostami_resume_selected_page' );
	$profile_image            = get_option( 'bostami_profile_image' );
	$profile_name             = get_option( 'bostami_profile_name' );
	$job_title                = get_option( 'bostami_job_title' );

	$profile_image = get_option( 'bostami_profile_image' );
	?>
	<div class="wrap">
		<h1>Theme Options</h1>
		<h2 class="nav-tab-wrapper">
			<a href="#profile" class="nav-tab nav-tab-active" data-tab="profile">Profile</a>
			<a href="#personal-info" class="nav-tab" data-tab="personal-info">Personal Info</a>
			<a href="#what-i-do" class="nav-tab" data-tab="what-i-do">What I Do</a>
			<a href="#clients" class="nav-tab" data-tab="clients">Clients</a>
			<a href="#socials" class="nav-tab" data-tab="socials">Socials</a>
			<a href="#resume" class="nav-tab" data-tab="resume">Resume</a>
			<a href="#portfolio" class="nav-tab" data-tab="portfolio">Portfolio</a>
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
						foreach ( $clients as $index => $item ) {
							?>
							<div class="bostami_client_item">
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
									       name="bostami_clients[<?php echo $index; ?>][url]"
									       value="<?php echo esc_attr( $item['url'] ); ?>" class="regular-text"/>
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

			<div id="personal-info" class="tab-content">
				<table class="form-table">
					<!-- Existing fields... -->
					<tr>
						<th scope="row"><label for="bostami_phone">Phone:</label></th>
						<td>
							<input type="text" id="bostami_phone" name="bostami_phone"
							       value="<?php echo esc_attr( get_option( 'bostami_phone' ) ); ?>" class="regular-text">
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="bostami_email">Email:</label></th>
						<td>
							<input type="email" id="bostami_email" name="bostami_email"
							       value="<?php echo esc_attr( get_option( 'bostami_email' ) ); ?>" class="regular-text">
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="bostami_location">Location:</label></th>
						<td>
							<input type="text" id="bostami_location" name="bostami_location"
							       value="<?php echo esc_attr( get_option( 'bostami_location' ) ); ?>" class="regular-text">
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="bostami_birthday">Birthday:</label></th>
						<td>
							<input type="text" id="bostami_birthday" name="bostami_birthday"
							       value="<?php echo esc_attr( get_option( 'bostami_birthday' ) ); ?>" class="regular-text">
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="bostami_cv">CV Upload:</label></th>
						<td>
							<input type="text" id="bostami_cv" name="bostami_cv"
							       value="<?php echo esc_attr( get_option( 'bostami_cv' ) ); ?>" class="regular-text">
							<button type="button" class="button bostami_upload_button" data-input="bostami_cv">Upload CV</button>
						</td>
					</tr>
				</table>
			</div>

			<div id="socials" class="tab-content">
				<h2>Social Media Settings</h2>
				<table class="form-table">
					<tr>
						<th scope="row"><label for="bostami_facebook">Facebook URL:</label></th>
						<td>
							<input type="text" id="bostami_facebook" name="bostami_facebook"
							       value="<?php echo esc_attr( get_option( 'bostami_facebook' ) ); ?>" class="regular-text"/>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="bostami_twitter">Twitter URL:</label></th>
						<td>
							<input type="text" id="bostami_twitter" name="bostami_twitter"
							       value="<?php echo esc_attr( get_option( 'bostami_twitter' ) ); ?>" class="regular-text"/>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="bostami_dribbble">Dribbble URL:</label></th>
						<td>
							<input type="text" id="bostami_dribbble" name="bostami_dribbble"
							       value="<?php echo esc_attr( get_option( 'bostami_dribbble' ) ); ?>" class="regular-text"/>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="bostami_linkedin">LinkedIn URL:</label></th>
						<td>
							<input type="text" id="bostami_linkedin" name="bostami_linkedin"
							       value="<?php echo esc_attr( get_option( 'bostami_linkedin' ) ); ?>" class="regular-text"/>
						</td>
					</tr>
				</table>
			</div>

			<div id="resume" class="tab-content">
				<div class="resume-tabs">
					<a href="#" class="resume-tab-link active" data-tab="resume-education-experience">Education & Experience</a>
					<a href="#" class="resume-tab-link" data-tab="resume-skills">Working Skills</a>
					<a href="#" class="resume-tab-link" data-tab="resume-knowledge">knowledge</a>
				</div>
				<div class="resume-tab-content active" id="resume-education-experience">
					<h2>Display Settings</h2>
					<table class="form-table">
						<tr>
							<th scope="row">
								<label for="bostami_resume_selected_page">On which page you want this section to be shown:</label>
							</th>
							<td>
								<select id="bostami_resume_selected_page" name="bostami_resume_selected_page">
									<?php
									// Get list of pages
									$pages = get_pages();
									foreach ( $pages as $page ) {
										$option = '<option value="' . intval( $page->ID ) . '"';
										$option .= selected( $resume_selected_page, $page->ID, false );
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

					<div id="bostami_resume_container">
						<?php
						if ( ! empty( $resume_options ) ) {
							foreach ( $resume_options as $index => $item ) {
								?>
								<div class="bostami_resume_item">
									<p>
										<label>Type:</label>
										<select name="bostami_resume_items[<?php echo $index; ?>][type]">
											<option value="education" <?php echo( $item['type'] == 'education' ? 'selected' : '' ); ?>>
												Education
											</option>
											<option value="experience" <?php echo( $item['type'] == 'experience' ? 'selected' : '' ); ?>>
												Experience
											</option>
										</select>
									</p>
									<p>
										<label>Year:</label>
										<input type="text" name="bostami_resume_items[<?php echo $index; ?>][year]"
										       value="<?php echo esc_attr( $item['year'] ); ?>"/>
									</p>
									<p>
										<label>Title:</label>
										<input type="text" name="bostami_resume_items[<?php echo $index; ?>][title]"
										       value="<?php echo esc_attr( $item['title'] ); ?>"/>
									</p>
									<p>
										<label>Description:</label>
										<textarea
											name="bostami_resume_items[<?php echo $index; ?>][description]"><?php echo esc_textarea( $item['description'] ); ?></textarea>
									</p>
									<button type="button" class="button bostami_resume_remove_icon_button">Remove Element</button>
								</div>
								<?php
							}
						}
						?>
					</div>
					<button type="button" id="bostami_add_new_resume_item" class="button">Add New Element</button>
				</div>
				<div class="resume-tab-content" id="resume-skills">
					<div id="bostami_resume_skills_container">
						<?php
						if ( ! empty( $resume_skills_options ) ) {
							foreach ( $resume_skills_options as $index => $item ) {
								?>
								<div class="bostami_resume_skills_item">
									<p>
										<label>Skill title:</label>
										<input type="text" name="bostami_resume_skills_items[<?php echo $index; ?>][title]"
										       value="<?php echo esc_attr( $item['title'] ); ?>"/>
									</p>
									<p>
										<label>Percentage:</label>
										<input type="number" name="bostami_resume_skills_items[<?php echo $index; ?>][percentage]"
										       value="<?php echo esc_attr( $item['percentage'] ); ?>" min="0" max="100"/>
									</p>
									<button type="button" class="button bostami_resume_skills_remove_icon_button">Remove Element</button>
								</div>
								<?php
							}
						}
						?>
					</div>
					<button type="button" id="bostami_add_new_resume_skills_item" class="button">Add New Element</button>
				</div>
				<div class="resume-tab-content" id="resume-knowledge">
					<div id="bostami_resume_knowledge_container">
						<?php
						if ( ! empty( $resume_knowledge_options ) ) {
							foreach ( $resume_knowledge_options as $index => $item ) {
								?>
								<div class="bostami_resume_knowledge_item">
									<p>
										<label>Knowledge title:</label>
										<input type="text" name="bostami_resume_knowledge_items[<?php echo $index; ?>][title]"
										       value="<?php echo esc_attr( $item['title'] ); ?>"/>
									</p>
									<button type="button" class="button bostami_resume_knowledge_remove_icon_button">Remove Element
									</button>
								</div>
								<?php
							}
						}
						?>
					</div>
					<button type="button" id="bostami_add_new_resume_knowledge_item" class="button">Add New Element</button>
				</div>
			</div>

			<div id="portfolio" class="tab-content">
				<h2>Portfolio</h2>
				<table class="form-table">
					<tr>
						<th scope="row">
							<label for="bostami_portfolio_page">Select a page for Portfolio:</label>
						</th>
						<td>
							<select id="bostami_portfolio_page" name="bostami_portfolio_page">
								<?php
								$pages                   = get_pages();
								$selected_portfolio_page = get_option( 'bostami_portfolio_page' );
								foreach ( $pages as $page ) {
									$option = '<option value="' . intval( $page->ID ) . '"';
									$option .= selected( $selected_portfolio_page, $page->ID, false );
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
				<div id="bostami_portfolio_container">
					<?php
					$portfolio = get_option( 'bostami_portfolio' );
					if ( ! empty( $portfolio ) ) {
						foreach ( $portfolio as $index => $item ) {
							?>
							<div class="bostami_portfolio_item">
								<p>
									<label for="bostami_portfolio_image_<?php echo $index; ?>">Image:</label>
									<input type="text" id="bostami_portfolio_image_<?php echo $index; ?>"
									       name="bostami_portfolio[<?php echo $index; ?>][image]"
									       value="<?php echo esc_attr( $item['image'] ); ?>" class="regular-text"/>
									<button type="button" class="button bostami_upload_button"
									        data-input="bostami_portfolio_image_<?php echo $index; ?>">Upload Image
									</button>
									<img src="<?php echo esc_attr( $item['image'] ); ?>" class="bostami_icon_preview"
									     style="max-width: 100px; max-height: 100px;"/>
								</p>
								<p>
									<label for="bostami_portfolio_url_<?php echo $index; ?>">Website URL:</label>
									<input type="url" id="bostami_portfolio_url_<?php echo $index; ?>"
									       name="bostami_portfolio[<?php echo $index; ?>][url]"
									       value="<?php echo esc_attr( $item['url'] ); ?>" class="regular-text"/>
								</p>
								<p>
									<label for="bostami_portfolio_title_<?php echo $index; ?>">Title:</label>
									<input type="text"
									       id="bostami_portfolio_title_<?php echo $index; ?>"
									       name="bostami_portfolio[<?php echo $index; ?>][title]"
									       value="<?php echo esc_attr( $item['title'] ); ?>"/>
								</p>
								<p>
									<label for="bostami_portfolio_category_<?php echo $index; ?>">Category:</label>
									<input type="text"
									       id="bostami_portfolio_category_<?php echo $index; ?>"
									       name="bostami_portfolio[<?php echo $index; ?>][category]"
									       value="<?php echo esc_attr( $item['category'] ); ?>"/>
								</p>
								<button type="button" class="button bostami_remove_portfolio_button">Remove Portfolio</button>
							</div>
							<?php
						}
					}
					?>
				</div>
				<button type="button" id="bostami_add_new_portfolio" class="button">Add New Portfolio</button>
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
	<script type="text/template" id="bostami_resume_template">
		<div class="bostami_resume_item">
			<p>
				<label>Type:</label>
				<select name="bostami_resume_items[{{index}}][type]">
					<option value="education" selected>
						Education
					</option>
					<option value="experience">
						Experience
					</option>
				</select>
			</p>
			<p>
				<label>Year:</label>
				<input type="text" name="bostami_resume_items[{{index}}][year]" value=""/>
			</p>
			<p>
				<label>Title:</label>
				<input type="text" name="bostami_resume_items[{{index}}][title]" value=""/>
			</p>
			<p>
				<label>Description:</label>
				<textarea name="bostami_resume_items[{{index}}][description]"></textarea>
			</p>
			<button type="button" class="button bostami_resume_remove_icon_button">Remove Element</button>
		</div>
	</script>
	<script type="text/template" id="bostami_resume_skills_template">
		<div class="bostami_resume_skills_item">
			<p>
				<label>Skill title:</label>
				<input type="text" name="bostami_resume_skills_items[{{index}}][title]" value=""/>
			</p>
			<p>
				<label>Percentage:</label>
				<input type="number" name="bostami_resume_skills_items[{{index}}][percentage]" value="" min="0" max="100"/>
			</p>
			<button type="button" class="button bostami_resume_skills_remove_icon_button">Remove Element</button>
		</div>
	</script>
	<script type="text/template" id="bostami_resume_knowledge_template">
		<div class="bostami_resume_knowledge_item">
			<p>
				<label>Knowledge title:</label>
				<input type="text" name="bostami_resume_knowledge_items[{{index}}][title]" value=""/>
			</p>
			<button type="button" class="button bostami_resume_knowledge_remove_icon_button">Remove Element</button>
		</div>
	</script>
	<script type="text/template" id="bostami_portfolio_template">
		<div class="bostami_portfolio_item">
			<p>
				<label for="bostami_portfolio_image_{{index}}">Image:</label>
				<input type="text" id="bostami_portfolio_image_{{index}}" name="bostami_portfolio[{{index}}][image]" value=""
				       class="regular-text"/>
				<button type="button" class="button bostami_upload_button" data-input="bostami_portfolio_image_{{index}}">Upload
					Image
				</button>
			</p>
			<p>
				<label for="bostami_portfolio_url_{{index}}">Website URL:</label>
				<input type="url" id="bostami_portfolio_url_{{index}}" name="bostami_portfolio[{{index}}][url]" value=""
				       class="regular-text"/>
			</p>
			<p>
				<label for="bostami_portfolio_title_{{index}}">Title:</label>
				<input type="text"
				       id="bostami_portfolio_title_{{index}}"
				       name="bostami_portfolio[{{index}}][title]"
				       value=""/>
			</p>
			<p>
				<label for="bostami_portfolio_category_{{index}}">Category:</label>
				<input type="text"
				       id="bostami_portfolio_category_{{index}}"
				       name="bostami_portfolio[{{index}}][category]"
				       value=""/>
			</p>
			<button type="button" class="button bostami_remove_portfolio_button">Remove Portfolio</button>
		</div>
	</script>

	<?php
}

