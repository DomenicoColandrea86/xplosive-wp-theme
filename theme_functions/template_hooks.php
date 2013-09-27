<?php
add_filter('ci_footer_credits', 'ci_theme_footer_credits');
if( !function_exists('ci_theme_footer_credits') ):
function ci_theme_footer_credits($string){

	if(!CI_WHITELABEL) {
		return '<a href="http://www.wordpress.org">'
			. __('Powered by WordPress', 'xplosive')
			. '</a> - <a href="http://www.cssigniter.com" '
			. 'title="'.esc_attr(__('Premium WordPress Themes', 'xplosive')).'">'
			. __('A theme by CSSIgniter.com', 'xplosive')
			. '</a>';
	}
	else {
		return '<a href="' . home_url() . '">'
			. get_bloginfo('name')
			. '</a> - <a href="http://www.wordpress.org">'
			. __('Powered by WordPress', 'xplosive')
			. '</a>';
	}

}
endif;
?>
