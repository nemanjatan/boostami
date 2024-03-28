<?php
get_header();
?>
	<div class="bg-homeBg dark:bg-homeTwoBg-dark min-h-screen bg-no-repeat bg-center bg-cover bg-fixed md:pb-16 w-full">
	<div class="section-bg">
		<div class="w-full flex justify-between px-4">
			<!-- website Logo -->
			<?php
			if ( has_custom_logo() ) {
				the_custom_logo();
			} else {
				?>
				<a href="/">
					<?php
					echo '<img class="h-[26px] lg:h-[32px]" src="' . esc_url( get_template_directory_uri() ) . '/images/logo/logo.png" alt="logo">';
					?>
				</a>
				<?php
			}
			?>

			<div class="flex items-center">
				<!-- dark and light mode toggle -->
				<button id="theme-toggle" type="button" class="dark-light-btn">
					<i id="theme-toggle-dark-icon" class="fa-solid text-xl fa-moon hidden"></i>
					<i id="theme-toggle-light-icon" class="fa-solid fa-sun text-xl hidden"></i>
				</button>
				<!-- mobile toggle button -->
				<button id="menu-toggle" type="button" class="menu-toggle-btn">
					<i id="menu-toggle-open-icon" class="fa-solid fa-bars text-xl "></i>
					<i id="menu-toggle-close-icon" class="fa-solid fa-xmark text-xl hidden  "></i>
				</button>
			</div>
		</div>
	</div>

<?php get_template_part( 'parts/mobile_menu' ); ?>

	<div class="container grid grid-cols-12 md:gap-10 justify-between lg:mt-[220px]">
	<!-- sidber personal info -->
	<div class="col-span-12 lg:col-span-4 hidden lg:block h-screen sticky top-44">
		<div
			class="w-full mb-6 lg:mb-0 mx-auto relative bg-white text-center dark:bg-[#111111] px-6 rounded-[20px] mt-[180px] md:mt-[220px] lg:mt-0">
			<!-- profile image -->
			<?php
			$profile_image = get_theme_mod( 'bostami_profile_image' );
			if ( $profile_image ) : ?>
				<img src="<?php echo esc_url( $profile_image ); ?>"
				     class="w-[240px] absolute left-[50%] transform -translate-x-[50%] h-[240px] drop-shadow-xl mx-auto rounded-[20px] -mt-[140px]"
				     alt="Profile Image"/>
			<?php else : ?>
				<img src="<?php echo esc_url( get_template_directory_uri() . '/images/about/avatar.jpg' ); ?>"
				     class="w-[240px] absolute left-[50%] transform -translate-x-[50%] h-[240px] drop-shadow-xl mx-auto rounded-[20px] -mt-[140px]"
				     alt="Default Profile Image"/>
			<?php endif; ?>
			<div class="pt-[100px] pb-8">
				<h2 class="mt-6 mb-1 text-[26px] font-semibold dark:text-white">
					<?php echo esc_html( get_theme_mod( 'bostami_profile_name', 'Monalisa Ashley' ) ); ?>
				</h2>
				<h3
					class="mb-4 text-[#7B7B7B] inline-block dark:bg-[#1D1D1D] px-5 py-1.5 rounded-lg dark:text-[#A6A6A6]">
					<?php echo esc_html( get_theme_mod( 'bostami_job_title', 'Ui/Ux Designer' ) ); ?>
				</h3>
				<div class="flex justify-center space-x-3">
					<?php
					$social_networks = array('Facebook', 'Twitter', 'Dribbble', 'LinkedIn');
					foreach ($social_networks as $network) {
						$network_url = get_theme_mod(strtolower($network));
						if ($network_url) : ?>
							<a href="<?php echo esc_url($network_url); ?>" target="_blank" rel="noopener noreferrer">
                <span class="socialbtn text-[#1773EA]">
                    <i class="fa-brands fa-<?php echo esc_attr(strtolower($network)); ?>"></i>
                </span>
							</a>
						<?php endif;
					}
					?>
				</div>
				<!-- personal infomation start -->
				<div class="p-7 rounded-2xl mt-7 bg-[#F3F6F6] dark:bg-[#1D1D1D]">
					<div class="flex border-b border-[#E3E3E3] dark:border-[#3D3A3A] pb-2.5">
                                <span class="socialbtn bg-white dark:bg-black text-[#E93B81] shadow-md">
                                    <i class="fa-solid fa-mobile-screen-button"></i>
                                </span>
						<div class="text-left ml-2.5">
							<p class="text-xs text-[#44566C] dark:text-[#A6A6A6]"> Phone </p>
							<p class="dark:text-white">+123 456 7890</p>
						</div>
					</div>
					<div class="flex border-b border-[#E3E3E3] dark:border-[#3D3A3A] py-2.5">
                                <span class="socialbtn bg-white dark:bg-black text-[#6AB5B9] shadow-md">
                                    <i class="fa-solid fa-envelope-open-text"></i>
                                </span>
						<div class="text-left ml-2.5">
							<p class="text-xs text-[#44566C] dark:text-[#A6A6A6]"> Email </p>
							<p class="dark:text-white">example@mail.com</p>
						</div>
					</div>
					<div class="flex border-b border-[#E3E3E3] dark:border-[#3D3A3A] py-2.5">
                                <span class="socialbtn bg-white dark:bg-black text-[#FD7590] shadow-md">
                                    <i class="fa-solid fa-location-dot"></i>
                                </span>
						<div class="text-left ml-2.5">
							<p class="text-xs text-[#44566C] dark:text-[#A6A6A6]"> Location </p>
							<p class="dark:text-white">Hong kong china</p>
						</div>
					</div>
					<div class="flex py-2.5">
                                <span class="socialbtn bg-white dark:bg-black text-[#C17CEB] shadow-md">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </span>
						<div class="text-left ml-2.5">
							<p class="text-xs text-[#44566C] dark:text-[#A6A6A6]"> Birthday </p>
							<p class="dark:text-white">May 27, 1990</p>
						</div>
					</div>
				</div>
				<!-- personal infomation end-->
				<!-- dowanload button -->
				<button class="dowanload-btn">
					<img class="mr-3" src="<?php echo get_template_directory_uri(); ?>/images/icons/dowanload.png" alt="icon"/>
					Download CV
				</button>
			</div>
		</div>
	</div>
	<div class="col-span-12 lg:col-span-8">
<?php get_template_part( 'parts/desktop_menu' ); ?>