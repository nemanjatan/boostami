<?php
// Retrieve the portfolio items from the theme options
$portfolio_items = get_option( 'bostami_portfolio' );

// Generate a list of unique categories for filtering
$categories = [];
foreach ( $portfolio_items as $item ) {
	$categories = array_merge( $categories, explode( " ", $item['category'] ) ); // Assuming categories are space-separated
}
$categories = array_unique( $categories );
?>

<section id="portfolio" class="bg-white lg:rounded-2xl dark:bg-[#111111]">
	<div class="container mb-8 px-4 sm:px-5 md:px-10 lg:px-[60px]">
		<div class="pb-12">
			<ul class="button-group isotop-menu-wrapper flex w-full justify-start md:justify-end flex-wrap font-medium">
				<li class="fillter-btn mr-4 md:mx-4 is-checked" data-filter="*">All</li>
				<?php foreach ( $categories as $category ): ?>
					<li class="fillter-btn mr-4 md:mx-4"
					    data-filter=".<?= esc_attr( strtolower( $category ) ); ?>"><?= esc_html( $category ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div id="isotop-gallery-wrapper" class="mymix portfolio_list-two two-col">
			<div class="grid-sizer"></div>
			<?php foreach ( $portfolio_items as $index => $item ): ?>
				<div
					class="portfolio_list-two-items isotop-item <?= esc_attr( strtolower( implode( ' ', explode( ' ', $item['category'] ) ) ) ); ?>">
					<div class="rounded-lg bg-[#fff0f0] p-6 dark:bg-transparent dark:border-[2px] border-[#212425]">
						<div class="overflow-hidden rounded-lg">
							<a href="<?= esc_url( $item['url'] ); ?>" rel="modal:open">
								<img
									class="w-full cursor-pointer transition duration-200 ease-in-out transform hover:scale-110 rounded-lg h-auto"
									src="<?= esc_url( $item['image'] ); ?>" alt="portfolio image"/>
							</a>
						</div>
						<span
							class="pt-5 text-[14px] font-normal text-gray-lite block dark:text-[#A6A6A6]"><?= esc_html( $item['category'] ); ?></span>
						<h2
							class="font-medium cursor-pointer text-xl duration-300 transition hover:text-[#FA5252] dark:hover:text-[#FA5252] dark:text-white mt-2">
							<a href="#portfolioModal<?= $index; ?>"
							   rel="modal:open"><?= esc_html( $item['title'] ); ?></a>
						</h2>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
