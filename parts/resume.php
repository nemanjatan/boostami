<?php
// Retrieve the resume items from the theme options
$resume_items       = get_option( 'bostami_resume_items' );

// Check if there are any items to display
if ( ! empty( $resume_items ) ) :
	// Separate items into education and experience based on some attribute or index
	$education_items = array_filter( $resume_items, function ( $item ) {
		return $item['type'] === 'education'; // Ensure you have a 'type' attribute or similar
	} );
	$experience_items = array_filter( $resume_items, function ( $item ) {
		return $item['type'] === 'experience'; // Ensure you have a 'type' attribute or similar
	} );
	?>
	<div class="container sm:px-5 md:px-10 lg:px-14">
		<div class="py-12 px-4 md:px-0">
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-x-6 gap-y-6 mt-[30px]">
				<!-- education start -->
				<div>
					<div class="flex items-center space-x-2 mb-4">
						<i class="fa-solid text-6xl text-[#F95054] fa-graduation-cap"></i>
						<h4 class="text-5xl dark:text-white font-medium"> Education </h4>
					</div>
					<?php foreach ( $education_items as $item ): ?>
						<div
							class="bg-[#fff4f4] dark:bg-transparent py-4 pl-5 pr-3 space-y-2 mb-6 rounded-lg dark:border-[#212425] dark:border-2">
							<span class="text-tiny text-gray-lite dark:text-[#b7b7b7]"><?php echo esc_html( $item['year'] ); ?></span>
							<h3 class="text-xl dark:text-white"><?php echo esc_html( $item['title'] ); ?></h3>
							<p class="dark:text-[#b7b7b7]"><?php echo esc_html( $item['description'] ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
				<!-- education end -->

				<!-- experience start -->
				<div>
					<div class="flex items-center space-x-2 mb-4">
						<i class="fa-solid text-6xl text-[#F95054] fa-briefcase"></i>
						<h4 class="text-5xl dark:text-white font-medium"> Experience </h4>
					</div>
					<?php foreach ( $experience_items as $item ): ?>
						<div
							class="py-4 pl-5 pr-3 space-y-2 mb-6 rounded-lg bg-[#eef5fa] dark:bg-transparent dark:border-[#212425] dark:border-2">
							<span class="text-tiny text-gray-lite dark:text-[#b7b7b7]"><?php echo esc_html( $item['year'] ); ?></span>
							<h3 class="text-xl dark:text-white"><?php echo esc_html( $item['title'] ); ?></h3>
							<p class="dark:text-[#b7b7b7]"><?php echo esc_html( $item['description'] ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
				<!-- experience end -->
			</div>
		</div>
	</div>
<?php
endif;
?>
