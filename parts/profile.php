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
		<?php get_template_part( 'parts/profile-info' ); ?>
	</div>
	<div class="col-span-12 lg:col-span-8">
<?php get_template_part( 'parts/desktop_menu' ); ?>