<?php
function shortcode_empty_paragraph_fix($content)
{
    $array = array (
        '<p>[' => '[',
        ']</p>' => ']',
        ']<br />' => ']'
    );
    $content = strtr($content, $array);
	return $content;
}
add_filter('the_content', 'shortcode_empty_paragraph_fix');

function tracklisting($params, $content = null) {
	return
		'<ol class="tracklisting">' .
			do_shortcode($content) .
		'</ol>';
	}
add_shortcode('tracklisting','tracklisting');

function track($params, $content = null) {
	extract( shortcode_atts( array(
      'track_no' => '1',
      'title'	 => 'Track title',
      'subtitle' => 'Track subtitle',
      'type'	 => 'soundcloud',
      'buy_url'	 => '',
      'download_url' => ''
    ), $params ) );

    $p = "";
    $b = "";
    $d = "";
    $s = "";

    if ($download_url != "") {
	    $d = '<a href="'. $download_url .'" class="action-btn buy download-track">' . __('Download track','xplosive') . '</a>';
    }

    if ($buy_url != "") {
	    $b = '<a href="'. $buy_url .'" class="action-btn buy buy-track">' . __('Buy track','xplosive') . '</a>';
    }

    if ('soundcloud' == strtolower($type)) {
	    $p =	'<div class="btns">' . $d . $b . '</div><a href="#track' . $track_no . '" class="track-listen sc">' . __('Listen','xplosive') . '</a>'.
				'<div id="track'. $track_no . '" class="track-audio">' .
					do_shortcode($content) .
				'</div>';
    }
    else {
	    $p =	'<div class="btns">' . $d . $b . '</div><a href="#track' . $track_no . '" class="track-listen">' . __('Listen','xplosive') . '</a>' .
				'<div id="track' . $track_no . '" class="track-audio jw">' .
				'<div id="player' . $track_no . '">' . __('Loading Player','xplosive') . '</div>' .
				'<script type="text/javascript">' .
					'setupjw("player' . $track_no . '","' . do_shortcode($content) . '");' .
				'</script>' .
				'</div>';
    }

    if ($subtitle != "")
    	$s = '<span class="main-head">' . $subtitle . '</span>';

	return
		'<li class="track group">' .
			'<span class="track-no">' . $track_no . '</span>' .
			'<p class="track-info">' .
				'<span class="sub-head">' . $title . '</span>' .
				$s .
			'</p>' . $p .
		'</li>';
	}
add_shortcode('track','track');


function ci_columns($params, $content = null) {
	return
		'<div class="row">' .
			do_shortcode($content) .
		'</div>';
	}
add_shortcode('columns','ci_columns');


function ci_column($params, $content = null) {
	extract( shortcode_atts( array(
      'position' => '',
      'number' => 'eight'
    ), $params ) );

	return
		'<div class="columns '. $position . ' ' . $number .'">' .
			do_shortcode($content) .
		'</div>';
	}
add_shortcode('column','ci_column');


?>
