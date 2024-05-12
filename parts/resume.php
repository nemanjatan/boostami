<?php
// Retrieve the data from the theme options
$resume_items   = get_option( 'bostami_resume_items' );
$working_skills = get_option( 'bostami_resume_skills_items' );
$knowledge      = get_option( 'bostami_resume_knowledge_items' );

// Define colors for skills
$colors = [ '#FF6464', '#9272d4', '#5185d4', '#ca56f2' ];

// Begin the page content
?>
<div class="container sm:px-5 md:px-10 lg:px-14">
	<div class="px-4 md:px-0">
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-x-6 gap-y-6">
			<!-- Check and display education and experience -->
			<?php if ( ! empty( $resume_items ) ) :
				$education_items = array_filter( $resume_items, function ( $item ) {
					return $item['type'] === 'education';
				} );
				$experience_items = array_filter( $resume_items, function ( $item ) {
					return $item['type'] === 'experience';
				} );
				?>
				<!-- Education Section -->
				<div>
					<div class="flex items-center space-x-2 mb-4">
						<i class="fa-solid text-6xl text-[#F95054] fa-graduation-cap"></i>
						<h4 class="text-5xl dark:text-white font-medium">Education</h4>
					</div>
					<?php foreach ( $education_items as $item ) : ?>
						<div
							class="bg-[#fff4f4] dark:bg-transparent py-4 pl-5 pr-3 space-y-2 mb-6 rounded-lg dark:border-[#212425] dark:border-2">
							<span
								class="text-tiny text-gray-lite dark:text-[#b7b7b7]"><?php echo esc_html( $item['year'] ); ?></span>
							<h3 class="text-xl dark:text-white"><?php echo esc_html( $item['title'] ); ?></h3>
							<p class="dark:text-[#b7b7b7]"><?php echo esc_html( $item['description'] ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
				<!-- Experience Section -->
				<div>
					<div class="flex items-center space-x-2 mb-4">
						<i class="fa-solid text-6xl text-[#F95054] fa-briefcase"></i>
						<h4 class="text-5xl dark:text-white font-medium">Experience</h4>
					</div>
					<?php foreach ( $experience_items as $item ) : ?>
						<div
							class="py-4 pl-5 pr-3 space-y-2 mb-6 rounded-lg bg-[#eef5fa] dark:bg-transparent dark:border-[#212425] dark:border-2">
							<span
								class="text-tiny text-gray-lite dark:text-[#b7b7b7]"><?php echo esc_html( $item['year'] ); ?></span>
							<h3 class="text-xl dark:text-white"><?php echo esc_html( $item['title'] ); ?></h3>
							<p class="dark:text-[#b7b7b7]"><?php echo esc_html( $item['description'] ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<div class="container bg-color-810 dark:bg-[#0D0D0D] py-12 px-2 sm:px-5 md:px-10 lg:px-20">
	<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
		<!-- Working Skills Section -->
		<?php if ( ! empty( $working_skills ) ) : ?>
			<div class="col-span-1">
				<h4 class="text-5xl dark:text-white font-medium mb-6">Working Skills</h4>
				<?php foreach ( $working_skills as $index => $skill ) : ?>
					<div class="mb-5">
						<div class="flex justify-between mb-1">
							<span
								class="font-semibold text-[#526377] dark:text-[#A6A6A6]"><?php echo esc_html( $skill['title'] ); ?></span>
							<span
								class="font-semibold text-[#526377] dark:text-[#A6A6A6]"><?php echo esc_html( $skill['percentage'] ); ?>%</span>
						</div>
						<div class="w-full bg-[#edf2f2] rounded-full h-1 dark:bg-[#1c1c1c]">
							<div class="bg-[<?php echo $colors[ $index % count( $colors ) ]; ?>] h-1 rounded-full"
							     style="width: <?php echo intval( $skill['percentage'] ); ?>%"></div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		<!-- knowledge Section -->
		<?php if ( ! empty( $knowledge ) ) : ?>
			<div class="col-span-1">
				<h4 class="text-5xl dark:text-white font-medium mb-8">knowledge</h4>
				<div class="flex gap-y-5 gap-x-2.5 flex-wrap">
					<?php foreach ( $knowledge as $k ) : ?>
						<button class="resume-btn"><?php echo esc_html( $k['title'] ); ?></button>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
