<!-- desktop menu start -->
<header class="lg:w-[560px] h-[144px] hidden lg:block p-[30px] ml-auto mb-10 rounded-[16px] bg-white dark:bg-[#111111]">
	<nav class="hidden lg:block">
		<ul class="flex">
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
						$class_names       = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $menu_item ) );
						$is_active         = in_array( 'current-menu-item', $classes );
						$menu_item_classes = $is_active ? 'menu-active' : 'menu-item';

						// Output the menu item
						echo sprintf(
							'<li class="%s"><a href="%s" class="%s"><span class="text-xl mb-1"><i class="%s"></i></span> %s</a></li>',
							esc_attr( $class_names ),
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
</header>
<!-- desktop menu end -->
