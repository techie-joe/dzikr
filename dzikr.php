<?php
/**
 * @package Dzikr
 * @version 1.0.0
 */
/*
Plugin Name: Dzikr
Plugin URI: https://github.com/techie-joe/dzikr
Description: This plugin symbolizes hope and enthusiasm of an entire human kind.
Author: Techie Joe
Author URI: https://techie-joe.github.io/
Version: 1.0.0
License: GPLv2 or later
*/

function get_kalima() {
$kalima = "
سُبْحَانَ اللهِ
الْحَمْدُ للهِ
لاَ إِلَهَ إِلاَّ الله
اللهُ أَكْبَرُ
حَسْبِيْ رَبِّيْ جَلَّ اللهُ
مَا فِيْ قَلْبِيْ غَيْرُ اللهِ
نُوْرُ مُحَمَّدٍ صَلَّى اللهُ
تُبْنَا إِلَى اللهِ
وَرَجَعْنَا إِلَى اللهِ
وَنَدِمْنَا عَلَى مَا فَعَلْنَا
سُبْحَانَ مَنْ لاَ يَقْدِرُ الْخَلْقُ قَدْرَهُ
مَنْ هُوَ فَوْقَ الْعَرْشِ فَرْدٌ مُوَحَّدٌ
مَلِيْكٌ عَلَى عَرْشِ السَّمَاءِ مُهَيْمِنُ
لِعِزَّتِهِ تَعْنُو الْوُجُوْهُ وَتَسْجُدُ
لَيْسَ لَهَا مِنْ دُوْنِ اللهِ كَاشِفَةٌ
أَسْتَغْفِرُ اللهَ
إِنَّ اللهَ كَانَ تَوَّابًا
للهُمَّ صَلِّ عَلَى سَيِّدِنَا مُحَمَّدٍ
";

	// split it into lines.
	$kalima = explode( "\n", $kalima );

	// randomly choose a line.
	return wptexturize( $kalima[ wp_rand( 0, count( $kalima ) - 1 ) ] );
}

// echoes the chosen line
function dzikr() {
	$chosen = get_kalima();
	$lang   = '';
	if ( 'ar_' !== substr( get_user_locale(), 0, 3 ) ) {
		$lang = 'ar';
	}

	printf(
		esc_html('<p id="dzikr"><span class="screen-reader-text">%s</span><span dir="rtl" lang="%s">%s</span></p>'),
		esc_html('Dzikr by Techie Joe'),
		esc_html($lang),
		esc_html($chosen)
	);
}

// Now we set that function up to execute when the admin_notices action is called.
add_action( 'admin_notices', 'dzikr' );

// We need some CSS to position the paragraph.
function dzikr_css() {
	echo "
	<style type='text/css'>
	#dzikr {
		float: right;
		padding: 0 10px;
		margin: -3px 0;
		font-size: 1.5rem;
		line-height: 1.6666;
		font-family: auto;
	}
	.rtl #dzikr {
		float: left;
	}
	.block-editor-page #dzikr {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#dzikr,
		.rtl #dzikr {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action( 'admin_head', 'dzikr_css' );
