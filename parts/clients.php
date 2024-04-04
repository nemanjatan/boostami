<?php
$clients = get_option( 'bostami_clients' );
if ( ! empty( $clients ) ): ?>
	<div class="slickOne text-center px-2 pt-8">
		<?php foreach ( $clients as $client ): ?>
			<div>
				<a href="<?php echo esc_url( $client['url'] ); ?>">
					<img class="overflow-hidden brand-img" src="<?php echo esc_url( $client['image'] ); ?>" alt="brand icon"/>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
