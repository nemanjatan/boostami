<!-- mobile menu start -->
<nav id="navbar" class="hidden lg:hidden">
	<ul
		class="block rounded-b-[20px] shadow-md absolute left-0 top-20 z-[22222222222222] w-full bg-white dark:bg-[#1d1d1d]">
		<?php
		if ( has_nav_menu( 'primary_menu' ) ) {
			$locations  = get_nav_menu_locations();
			$menu_id    = $locations['primary_menu'];
			$menu_items = wp_get_nav_menu_items( $menu_id );

			if ( ! empty( $menu_items ) ) {
				foreach ( $menu_items as $menu_item ) {
					$page_template = get_page_template_slug( $menu_item->object_id );
					$is_home       = $menu_item->url === home_url( '/' );

					if ( $is_home ) {
						$icon_class = 'fa-regular fa-user';
					} else {
						switch ( $page_template ) {
							case 'page_resume.php':
								$icon_class = 'fa-regular fa-file-lines';
								break;
							case 'page_portfolio.php':
								$icon_class = 'fas fa-briefcase';
								break;
							case 'page_blog.php':
								$icon_class = 'fa-brands fa-blogger';
								break;
							case 'page_contact.php':
								$icon_class = 'fa-solid fa-address-book';
								break;
							default:
								$icon_class = '';
								break;
						}
					}

					$classes           = empty( $menu_item->classes ) ? array() : (array) $menu_item->classes;
					$is_active         = in_array( 'current-menu-item', $classes );
					$menu_item_classes = $is_active ? 'mobile-menu-items-active' : 'mobile-menu-items';

					// Output the menu item
					echo sprintf(
						'<li class="%s"><a href="%s" class="%s"><span class="mr-2 text-xl"><i class="%s"></i></span> %s</a></li>',
						esc_attr( $menu_item_classes ),
						esc_url( $menu_item->url ),
						esc_attr( $menu_item_classes ),
						esc_attr( $icon_class ),
						esc_html( $menu_item->title )
					);
				}
			}
		}
		?>
	</ul>
</nav>
<!-- mobile menu end -->
