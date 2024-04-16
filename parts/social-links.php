<?php
$social_networks = array(
	'Facebook' => '#1773EA',   // Blue for Facebook
	'Twitter'  => '#1C9CEA',    // Light blue for Twitter
	'Dribbble' => '#e14a84',   // Pink for Dribbble
	'LinkedIn' => '#0072b1'    // Dark blue for LinkedIn
);

foreach ( $social_networks as $network => $color ) {
	$option_name = 'bostami_' . strtolower( $network );
	$network_url = get_option( $option_name );
	if ( $network_url ) : ?>
		<a href="<?php echo esc_url( $network_url ); ?>" target="_blank" rel="noopener noreferrer">
            <span class="socialbtn" style="color: <?php echo $color; ?>;">
                <i class="fa-brands fa-<?php echo esc_attr( strtolower( $network ) ); ?>"></i>
            </span>
		</a>
	<?php endif;
}
?>
