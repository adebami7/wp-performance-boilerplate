<?php
/**
 * WP Performance Boilerplate - Custom Functions Asset
 * Engineered specifically to maximize Google PageSpeed Insights, optimize 
 * Core Web Vitals (LCP, CLS, INP), and conditionally manage resource execution.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Prevent direct script access for security compliance
}

// 1. ELIMINATE RENDER-BLOCKING ASSETS (Defer & Async Dequeues)
function cwv_optimize_script_attributes( $tag, $handle, $src ) {
    $synchronous_scripts = array( 'jquery', 'jquery-core', 'jquery-migrate' );
    if ( ! in_array( $handle, $synchronous_scripts, true ) && ! is_admin() ) {
        return str_replace( ' src', ' defer="defer" src', $tag );
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'cwv_optimize_script_attributes', 10, 3 );

// 2. CONDITIONAL RESOURCE ISOLATION (WooCommerce Optimization)
function cwv_conditional_woocommerce_offload() {
    if ( ! class_exists( 'WooCommerce' ) ) return;
    if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() && ! is_account_page() ) {
        wp_dequeue_style( 'woocommerce-layout' );
        wp_dequeue_style( 'woocommerce-general' );
        wp_dequeue_style( 'woocommerce-smallscreen' );
        wp_dequeue_style( 'wc-blocks-style' );
        wp_dequeue_script( 'wc-cart-fragments' );
        wp_dequeue_script( 'woocommerce' );
        wp_dequeue_script( 'wc-add-to-cart' );
    }
}
add_action( 'wp_enqueue_scripts', 'cwv_conditional_woocommerce_offload', 999 );
