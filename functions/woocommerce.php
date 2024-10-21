<?php

function mangia_woocommerce_add_support() {
    add_theme_support( 'woocommerce' );

    // add_theme_support( 'wc-product-gallery-zoom' );
    // add_theme_support( 'wc-product-gallery-lightbox' );
    // add_theme_support( 'wc-product-gallery-slider' );
    
        
}
add_action( 'after_setup_theme', 'mangia_woocommerce_add_support' );

// Remove Sidebar

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// Function to be executed before woocommerce_before_main_content
function content_blocks_on_woo_pages() {
    if (is_shop()) {
        $page_ID = wc_get_page_id('shop');
        content_blocks($page_ID);
    } elseif(is_cart()){
        $page_ID = wc_get_page_id('cart');
        content_blocks($page_ID);
    }
}

// Hooking the function to run before woocommerce_before_main_content
add_action('woocommerce_before_main_content', 'content_blocks_on_woo_pages', 5);


// Page checkout Wrap items
// Add the opening div before customer details
add_action( 'woocommerce_checkout_before_customer_details', 'custom_wrap_start', 1 );
function custom_wrap_start() {
    echo '<div class="checkout-grid">';
}

add_action( 'woocommerce_checkout_after_order_review', 'custom_wrap_end', 20 );
function custom_wrap_end() {
    echo '</div>';
}

// Remove breadcrumbs from shop & categories
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

function remove_woocommerce_product_image_gallery() {
    remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
}
add_action( 'wp', 'remove_woocommerce_product_image_gallery' );

function mangia_open_single_product(){
    echo '<section class="section section--single-product" data-color="#ff445c">
            <div class="block block--single-product">
            <div class="single-product">'; 

}

add_action('woocommerce_before_single_product_summary', 'mangia_open_single_product', 10);

function mangia_close_single_product(){
    echo '</div></div></div></div>'; // Close Single Product Block
}

add_action('woocommerce_after_single_product_summary', 'mangia_close_single_product', 16);

function custom_display_product_images() {
    global $product;

    $productID = $product->id;
    $color = get_field('color', $productID);
    $textColorCssVar = isLightOrDark($color) == 'light' ? '--txt-color: #000' : '--txt-color: #fff';
    $bgType = get_field('background_type', $productID);

    $attachment_ids = $product->get_gallery_image_ids();
    
    if ( $attachment_ids && $product->get_image_id() ) {
        array_unshift( $attachment_ids, $product->get_image_id() );
    }

    if ( $attachment_ids ) {
        echo '<div class="single-product__side single-product__side--media '. $bgType .'" style="--color: '. $color .'">';
        echo    '<div class="single-product__swiper swiper">';
        echo        '<div class="swiper-wrapper">';
        foreach ( $attachment_ids as $attachment_id ) {
            $image_url = wp_get_attachment_image_url( $attachment_id, 'large' );
                echo    '<div class="swiper-slide">';
                echo        '<div><img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) . '"></div>';
                echo     '</div>';
        }

        echo        '</div>';
        echo    '</div>';
        echo    '<div class="prev-next"><button class="prev-next__arrow prev-next__arrow--prev">→</button><button class="prev-next__arrow prev-next__arrow--next">→</button></div>';
        echo    '</div>';
        echo    '<div class="single-product__side single-product__side--text" style="--color: '. $color .';'. $textColorCssVar .' ">';
    }
}
add_action( 'woocommerce_before_single_product_summary', 'custom_display_product_images', 20 );



// Remove the default product title
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

// Add custom product title with extra class
add_action( 'woocommerce_single_product_summary', 'custom_woocommerce_template_single_title', 5 );
function custom_woocommerce_template_single_title() {
    $product_title = get_the_title();
    $title_length = strlen( $product_title ) / 2;
    echo '<h1 class="single-product__title" style="--numOfLetter: '. $title_length .'">' . $product_title . '</h1>';
}

add_action( 'woocommerce_product_after_tabs', 'content_blocks', 5 );

// Modify the structure of the Place Order button
add_filter('woocommerce_order_button_html', 'custom_place_order_button', 10, 2);

function custom_place_order_button($button) {
    // Create your custom button structure
    // $button = '<div class="custom-button-wrapper">';
    // $button .= '<span class="custom-button-text">Proceed to Payment</span>';
    // $button .= '<button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order">';
    // $button .= $order->get_order_total(); // Add order total or any other info
    // $button .= '</button>';
    // $button .= '</div>';

    $button = '<button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order"><span>';
    $button .= 'Sign up now';
    $button .= '</span></button>';
    return $button;
}

// Remove Message "has been added to your cart"

add_filter( 'wc_add_to_cart_message_html', '__return_false' );

// Add data-lenis-prevent to the .woocommerce-MyAccount-navigation

add_filter( 'wp_nav_menu_items', 'add_data_attribute_to_myaccount_menu', 10, 2 );

function add_data_attribute_to_myaccount_menu( $items, $args ) {
    // Check if it's the My Account menu
    if ( $args->theme_location === 'my-account' ) {
        // Add the data-lenis-prevent attribute to each menu item
        $items = str_replace( '<ul class="woocommerce-MyAccount-navigation', '<ul class="woocommerce-MyAccount-navigation" data-lenis-prevent', $items );
    }
    return $items;
}

// Custom Login Item Label (if logged In or Off)

function custom_menu_items($items, $menu, $args) {
    // Loop through each menu item
    // $helloLabel = get_field('hello_label', 'option');
    // $loginLabel = get_field('login_label', 'option');
    // $currentUser = wp_get_current_user();


    foreach ($items as $item) {
        // Check if the menu item URL is the My Account URL
        // if (strpos($item->url, wc_get_page_permalink('myaccount')) !== false) {
        if (strpos($item->url, wc_get_page_permalink('myaccount')) !== false && !in_array('wpml-ls-item', $item->classes)) {
            
            // Change the title based on login status
            if (is_user_logged_in()) {

                // $username = $currentUser->user_login;

                $item->title = 'My Account';
                // $item->title =  $helloLabel. ' ' .$username;
            } else {
                $item->title = 'Login';
                // Optionally, you can change the URL to the login page if needed
                // $item->url = wp_login_url(); // Redirect to the login page
            }
        }
    }
    return $items;
}
add_filter('wp_get_nav_menu_items', 'custom_menu_items', 10, 3);


