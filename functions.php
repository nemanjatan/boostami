<?php

require_once get_template_directory() . '/lib/Desktop_Icon_Walker.php';
require_once get_template_directory() . '/lib/Mobile_Icon_Walker.php';

function bostami_enqueue_styles() {
	wp_enqueue_style( 'fontawesome_all', get_template_directory_uri() . '/assets/fontaswesome/css/all.min.css' );
	wp_enqueue_style( 'fontawesome_min', get_template_directory_uri() . '/assets/fontaswesome/css/fontawesome.min.css' );
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,400;1,500;1,600&family=Roboto+Slab:wght@300;400;500;600;700&display=swap', array(), null );
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/css/vendor/slick.css' );
	wp_enqueue_style( 'tailwind', get_template_directory_uri() . '/css/tailwind.css' );
	wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/css/custom.css' );
}

add_action( 'wp_enqueue_scripts', 'bostami_enqueue_styles' );

function bostami_enqueue_scripts() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'slick-slider', get_template_directory_uri() . '/js/vendor/slick.js', array( 'jquery' ), null, true );

	if ( is_page_template( 'page_portfolio.php' ) ) {
		wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/vendor/isotope.pkgd.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'jquery-modal', get_template_directory_uri() . '/js/vendor/jquery.modal.min.js', array( 'jquery' ), null, true );
	}
	wp_enqueue_script( 'bostami-main-js', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), null, true );
}

add_action( 'wp_enqueue_scripts', 'bostami_enqueue_scripts' );

function bostami_preconnect_and_inline_scripts() {
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
	?>
	<script>
      if (localStorage.getItem("color-theme") === "dark" || (!("color-theme" in localStorage) && window.matchMedia("(prefers-color-scheme: dark)").matches)) {
          document.documentElement.classList.add("dark");
      } else {
          document.documentElement.classList.remove("dark");
      }
	</script>
	<?php
}

add_action( 'wp_head', 'bostami_preconnect_and_inline_scripts', 5 );

function bostami_add_root_css_variable() {
	echo '<style>:root { --theme-url: "' . get_template_directory_uri() . '/"; }</style>';
}

add_action( 'wp_head', 'bostami_add_root_css_variable' );

function bostami_register_nav_menu() {
	register_nav_menus( array(
		'primary_menu' => 'Primary Menu',
		'footer_menu'  => 'Footer Menu',
	) );
}

add_action( 'after_setup_theme', 'bostami_register_nav_menu', 0 );

function bostami_custom_logo_setup() {
	$defaults = array(
		'height'      => 100,
		'width'       => 400,
		'flex-height' => false,
		'flex-width'  => false,
	);
	add_theme_support( 'custom-logo', $defaults );
}

add_action( 'after_setup_theme', 'bostami_custom_logo_setup' );

function bostami_customize_register( $wp_customize ) {
	// Add a new section for 'Profile' settings.
	$wp_customize->add_section( 'bostami_profile_section', array(
		'title'    => __( 'Profile', 'bostami' ),
		'priority' => 30,
	) );

	// Add a setting for the 'Profile Image'.
	$wp_customize->add_setting( 'bostami_profile_image', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'esc_url_raw',
	) );

	// Add a control to upload the profile image.
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bostami_profile_image', array(
		'label'    => __( 'Profile Image', 'bostami' ),
		'section'  => 'bostami_profile_section',
		'settings' => 'bostami_profile_image',
	) ) );

	// Add a setting for the 'Profile Name'.
	$wp_customize->add_setting( 'bostami_profile_name', array(
		'default'           => 'Monalisa Ashley',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Add a control to input the profile name.
	$wp_customize->add_control( 'bostami_profile_name', array(
		'label'    => __( 'Profile Name', 'bostami' ),
		'section'  => 'bostami_profile_section',
		'settings' => 'bostami_profile_name',
		'type'     => 'text',
	) );

	// Add a setting for the 'Job title'.
	$wp_customize->add_setting( 'bostami_job_title', array(
		'default'           => 'Ui/Ux Designer',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Add a control to input the job title.
	$wp_customize->add_control( 'bostami_job_title', array(
		'label'    => __( 'Job Title', 'bostami' ),
		'section'  => 'bostami_profile_section',
		'settings' => 'bostami_job_title',
		'type'     => 'text',
	) );

	// Add a new section for 'Social Networks' settings.
	$wp_customize->add_section( 'bostami_social_section', array(
		'title'      => __( 'Social Networks', 'bostami' ),
		'priority'   => 35,
	));

	$social_networks = array('Facebook', 'Twitter', 'Dribbble', 'LinkedIn');
	foreach ($social_networks as $network) {
		$wp_customize->add_setting( strtolower($network), array(
			'default'           => get_bloginfo('url'),
			'transport'         => 'refresh',
			'sanitize_callback' => 'esc_url_raw',
		));

		$wp_customize->add_control( strtolower($network), array(
			'label'    => $network,
			'section'  => 'bostami_social_section',
			'settings' => strtolower($network),
			'type'     => 'text',
		));
	}
}

add_action( 'customize_register', 'bostami_customize_register' );
