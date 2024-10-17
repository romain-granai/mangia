<?php

// // Cryptage des emails
function mangia_crypt_email( $atts , $content = null ) {
	if ( ! is_email( $content ) ) {
		return;
	}

	return '<a href="mailto:' . antispambot( $content ) . '">' . antispambot( $content ) . '</a>';
}
add_shortcode( 'email', 'mangia_crypt_email' );

function isLightOrDark($hexColor) {
    // Remove the '#' character if it's present
    $hexColor = ltrim($hexColor, '#');

    // Convert hex to RGB
    if (strlen($hexColor) == 6) {
        $r = hexdec(substr($hexColor, 0, 2));
        $g = hexdec(substr($hexColor, 2, 2));
        $b = hexdec(substr($hexColor, 4, 2));
    } elseif (strlen($hexColor) == 3) {
        // Short hex format: #FFF
        $r = hexdec(str_repeat(substr($hexColor, 0, 1), 2));
        $g = hexdec(str_repeat(substr($hexColor, 1, 1), 2));
        $b = hexdec(str_repeat(substr($hexColor, 2, 1), 2));
    } else {
        // Invalid hex format
        return null; // or throw an exception
    }

    // Calculate the luminance
    $luminance = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;

    // Determine if the color is light or dark
    return ($luminance >= 128) ? 'light' : 'dark';
};

// // RGPD

// // use priority 11 to be called after CF7 registered filter,
// // in which the `google-recaptcha` script must still be enqueued
// add_action('wp_footer', function () {
// 	// don’t do anything if reCAPTCHA is not enqueued
// 	if (!wp_script_is('google-recaptcha', 'enqueued')) {
// 		return;
// 	}

// 	// remove CF7 reCAPTCHA script
// 	wp_dequeue_script('google-recaptcha');

// 	// create customized TAC service (with callback parameter)
// 	// based on original (https://github.com/AmauriC/tarteaucitron.js/blob/master/tarteaucitron.services.js:1205)
// 	$tacReCaptchaService = 'tarteaucitron.services.recaptchacf7 = {
// 	"key": "recaptchacf7",
// 	"type": "api",
// 	"name": "reCAPTCHA",
// 	"uri": "http://www.google.com/policies/privacy/",
// 	"needConsent": true,
// 	"cookies": ["nid"],
// 	"js": function () {
// 		"use strict";
// 		tarteaucitron.fallback(["g-recaptcha"], "");
// 		tarteaucitron.addScript("https://www.google.com/recaptcha/api.js?onload=recaptchaCallback&render=explicit&ver=2.0");
// 	},
// 	"fallback": function () {
// 		"use strict";
// 		var id = "recaptchacf7";
// 		tarteaucitron.fallback(["g-recaptcha"], tarteaucitron.engage(id));
// 	}
// };';

// 	// add it after TarteAuCitron script
// 	wp_add_inline_script('tac', $tacReCaptchaService, 'after');

// 	// register the customized service
// 	wp_add_inline_script('tac', '(tarteaucitron.job = tarteaucitron.job || []).push("recaptchacf7");', 'after');
// }, 11);

add_theme_support( 'post-thumbnails', array( 'post' ) ); 