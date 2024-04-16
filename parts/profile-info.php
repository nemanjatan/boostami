<div
	class="w-full mb-6 lg:mb-0 mx-auto relative bg-white text-center dark:bg-[#111111] px-6 rounded-[20px] mt-[180px] md:mt-[220px] lg:mt-0">
	<?php
	// Fetch each setting individually since they are stored as separate options
	$profile_image = get_option( 'bostami_profile_image', get_template_directory_uri() . '/images/about/avatar.jpg' );
	$profile_name  = get_option( 'bostami_profile_name', 'Monalisa Ashley' );
	$job_title     = get_option( 'bostami_job_title', 'Ui/Ux Designer' );
	?>
	<img src="<?php echo esc_url( $profile_image ); ?>"
	     class="w-[240px] absolute left-[50%] transform -translate-x-[50%] h-[240px] drop-shadow-xl mx-auto rounded-[20px] -mt-[140px]"
	     alt="Profile Image"/>
	<div class="pt-[100px] pb-8">
		<h2 class="mt-6 mb-1 text-[26px] font-semibold dark:text-white">
			<?php echo esc_html( $profile_name ); ?>
		</h2>
		<h3 class="mb-4 text-[#7B7B7B] inline-block dark:bg-[#1D1D1D] px-5 py-1.5 rounded-lg dark:text-[#A6A6A6]">
			<?php echo esc_html( $job_title ); ?>
		</h3>
		<!-- Social Links -->
		<div class="flex justify-center space-x-3">
			<?php include get_template_directory() . '/parts/social-links.php'; ?>
		</div>
		<!-- Personal Information -->
		<?php include get_template_directory() . '/parts/personal-info.php'; ?>
		<!-- Download CV Button -->
		<a href="<?php echo esc_url(get_option('bostami_cv')); ?>" download>
			<button class="dowanload-btn">
				<img class="mr-3" src="<?php echo get_template_directory_uri(); ?>/images/icons/dowanload.png" alt="icon"/>
				Download CV
			</button>
		</a>
	</div>
</div>
