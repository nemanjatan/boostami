<div class="p-7 rounded-2xl mt-7 bg-[#F3F6F6] dark:bg-[#1D1D1D]">
	<?php if ($phone = get_option('bostami_phone')) : ?>
		<!-- Phone Section -->
		<div class="flex border-b border-[#E3E3E3] dark:border-[#3D3A3A] pb-2.5">
            <span class="socialbtn bg-white dark:bg-black text-[#E93B81] shadow-md">
                <i class="fa-solid fa-mobile-screen-button"></i>
            </span>
			<div class="text-left ml-2.5">
				<p class="text-xs text-[#44566C] dark:text-[#A6A6A6]">Phone</p>
				<p class="dark:text-white"><?php echo esc_html($phone); ?></p>
			</div>
		</div>
	<?php endif; ?>

	<?php if ($email = get_option('bostami_email')) : ?>
		<!-- Email Section -->
		<div class="flex border-b border-[#E3E3E3] dark:border-[#3D3A3A] py-2.5">
            <span class="socialbtn bg-white dark:bg-black text-[#6AB5B9] shadow-md">
                <i class="fa-solid fa-envelope-open-text"></i>
            </span>
			<div class="text-left ml-2.5">
				<p class="text-xs text-[#44566C] dark:text-[#A6A6A6]">Email</p>
				<p class="dark:text-white"><?php echo esc_html($email); ?></p>
			</div>
		</div>
	<?php endif; ?>

	<?php if ($location = get_option('bostami_location')) : ?>
		<!-- Location Section -->
		<div class="flex border-b border-[#E3E3E3] dark:border-[#3D3A3A] py-2.5">
            <span class="socialbtn bg-white dark:bg-black text-[#FD7590] shadow-md">
                <i class="fa-solid fa-location-dot"></i>
            </span>
			<div class="text-left ml-2.5">
				<p class="text-xs text-[#44566C] dark:text-[#A6A6A6]">Location</p>
				<p class="dark:text-white"><?php echo esc_html($location); ?></p>
			</div>
		</div>
	<?php endif; ?>

	<?php if ($birthday = get_option('bostami_birthday')) : ?>
		<!-- Birthday Section -->
		<div class="flex py-2.5">
            <span class="socialbtn bg-white dark:bg-black text-[#C17CEB] shadow-md">
                <i class="fa-solid fa-calendar-days"></i>
            </span>
			<div class="text-left ml-2.5">
				<p class="text-xs text-[#44566C] dark:text-[#A6A6A6]">Birthday</p>
				<p class="dark:text-white"><?php echo esc_html($birthday); ?></p>
			</div>
		</div>
	<?php endif; ?>
</div>
