<?php
$social_networks = array( 'Facebook', 'Twitter', 'Dribbble', 'LinkedIn' );
foreach ( $social_networks as $network ) {
	$network_url = get_theme_mod( strtolower( $network ) );
	if ( $network_url ) : ?>
		<a href="<?php echo esc_url( $network_url ); ?>" target="_blank" rel="noopener noreferrer">
            <span class="socialbtn text-[#1773EA]">
                <i class="fa-brands fa-<?php echo esc_attr( strtolower( $network ) ); ?>"></i>
            </span>
		</a>
	<?php endif;
}
?>
