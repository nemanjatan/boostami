<?php
// Retrieve the "What I Do" items from the theme options
$options = get_option( 'bostami_what_i_do_items' );

// Check if there are any items to display
if ( ! empty( $options ) ) :
	?>
	<!-- what i do section start -->
	<div class="pb-12 px-2 sm:px-5 md:px-10 lg:px-14 pt-12">
		<h3 class="text-[35px] dark:text-white font-bold font-robotoSlab pb-5"> What I do! </h3>
		<div class="grid gap-8 grid-cols-1 md:grid-cols-2 xl:grid-cols-2">
			<?php foreach ( $options as $item ):
				// Skip this iteration if there's no title or description
				if ( empty( $item['title'] ) && empty( $item['description'] ) ) {
					continue;
				}
				?>
				<div class="about-box bg-[#fcf4ff] dark:bg-transparent">
					<?php if ( ! empty( $item['icon'] ) ): ?>
						<img class="w-10 h-10 object-contain block" src="<?php echo esc_url( $item['icon'] ); ?>" alt="icon"/>
					<?php endif; ?>
					<div class="space-y-2">
						<?php if ( ! empty( $item['title'] ) ): ?>
							<h3 class="dark:text-white text-[22px] font-semibold"><?php echo esc_html( $item['title'] ); ?></h3>
						<?php endif; ?>
						<?php if ( ! empty( $item['description'] ) ): ?>
							<p
								class="leading-8 text-gray-lite dark:text-[#A6A6A6]"><?php echo esc_html( $item['description'] ); ?></p>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php
endif;
?>
