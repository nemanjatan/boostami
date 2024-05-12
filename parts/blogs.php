<section class="bg-white lg:rounded-2xl dark:bg-[#111111]">
	<div class="container px-4 sm:px-5 md:px-10 lg:px-[60px]">
		<div class="pb-12">
			<div class="grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 mt-[30px] grid gap-x-10 gap-y-7 mb-6">
				<?php
				$args  = array(
					'posts_per_page' => - 1, // Retrieves all posts
					'post_type'      => 'post', // Ensures only blog posts are retrieved
				);
				$query = new WP_Query( $args );
				if ( $query->have_posts() ) :
					while ( $query->have_posts() ) : $query->the_post();
						$post_id          = get_the_ID();
						$post_permalink   = get_permalink();
						$post_title       = get_the_title();
						$post_date        = get_the_date( 'd F' );
						$featured_img_url = get_the_post_thumbnail_url( $post_id, 'full' ); // Assuming 'full' size is appropriate
						?>
						<div
							class="p-5 rounded-lg mb-2 h-full bg-[#fcf4ff] dark:bg-transparent dark:border-[#212425] dark:border-2">
							<div class="overflow-hidden rounded-lg">
								<a href="<?php echo esc_url( $post_permalink ); ?>">
									<img
										class="rounded-lg w-full cursor-pointer transition duration-200 ease-in-out transform hover:scale-110"
										src="<?php echo esc_url( $featured_img_url ); ?>"
										alt="<?php echo esc_attr( $post_title ); ?>"/>
								</a>
							</div>
							<div class="flex mt-4 text-tiny text-gray-lite dark:text-[#A6A6A6]">
								<span><?php echo esc_html( $post_date ); ?></span>
							</div>
							<h3
								class="text-lg font-medium dark:text-white duration-300 transition cursor-pointer mt-3 pr-4 hover:text-[#FA5252] dark:hover:text-[#FA5252]">
								<a href="<?php echo esc_url( $post_permalink ); ?>"><?php echo esc_html( $post_title ); ?></a>
							</h3>
						</div>
					<?php
					endwhile;
				endif;
				wp_reset_postdata();
				?>
			</div>
		</div>
	</div>
</section>
