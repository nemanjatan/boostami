<?php
get_template_part( 'parts/profile' );
?>
<div class="page">
	<div class="lg:rounded-2xl bg-white dark:bg-[#111111]">
		<div class="pt-12 px-2 sm:px-5 md:px-10 lg:px-14">
			<!-- about page title -->
			<h2 class="after-effect after:left-52"><?php the_title(); ?></h2>
			<?php get_template_part( 'parts/mobile-profile' ); ?>

			<div class="lg:grid grid-cols-12 md:gap-10 pt-4 md:pt-[30px] items-center">
				<div class="col-span-12 space-y-2.5">
					<div class="lg:mr-16 dark:text-white">
						<?php the_content(); ?>
					</div>
					<div></div>
				</div>
			</div>

		</div>

		<?php
		$selected_page_id              = get_option( 'bostami_selected_page' );
		$selected_clients_page_id      = get_option( 'bostami_clients_page' );
		$bostami_resume_selected_page  = get_option( 'bostami_resume_selected_page' );
		$bostami_portfolio_page        = get_option( 'bostami_portfolio_page' );
		$bostami_blogs_selected_page   = get_option( 'bostami_blogs_selected_page' );
		$bostami_contact_selected_page = get_option( 'bostami_contact_selected_page' );

		if ( $selected_page_id && (int) $selected_page_id === get_the_ID() ) {
			get_template_part( 'parts/what-i-do' );
		}

		// Check if the current page is the selected page for clients and display the section
		if ( $selected_clients_page_id && (int) $selected_clients_page_id === get_the_ID() ) {
			get_template_part( 'parts/clients' );
		}

		if ( $bostami_resume_selected_page && (int) $bostami_resume_selected_page === get_the_ID() ) {
			get_template_part( 'parts/resume' );
		}

		if ( $bostami_portfolio_page && (int) $bostami_portfolio_page === get_the_ID() ) {
			get_template_part( 'parts/portfolio' );
		}

		if ( $bostami_blogs_selected_page && (int) $bostami_blogs_selected_page === get_the_ID() ) {
			get_template_part( 'parts/blogs' );
		}

		if ( $bostami_contact_selected_page && (int) $bostami_contact_selected_page === get_the_ID() ) {
			get_template_part( 'parts/contact' );
		}

		get_footer();
		?>
	</div>
</div>
</div>
</div>
</div>
</body>
</html>