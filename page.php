<?php
get_template_part( 'parts/profile' );
?>
				<div class="page">
					<div class="lg:rounded-2xl bg-white dark:bg-[#111111]">
						<div class="pt-12 md:py-12 px-2 sm:px-5 md:px-10 lg:px-14">
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

						<!-- what i do section start -->
						<?php //get_template_part( 'parts/what-i-do' ); ?>
						<!-- what i do section start -->

						<!-- clients -->
						<?php //get_template_part( 'parts/clients' ); ?>
						<!-- clients end -->

						<?php
						get_footer();
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>