<?php
/*-----------------------------------------------------------------------------------*/
/*  Plugin activation
/*-----------------------------------------------------------------------------------*/
if (!function_exists('ew_plugin_activation')) {

    function ew_plugin_activation() {

        // Declare plugin install
        $plugins = array(
            array(
                'name' => 'Contact Form 7',
                'slug' => 'contact-form-7',
                'required' => false,
                'force_activation' => false,
                'force_deactivation' => false,
            ),
            array(
                'name' => 'WP SMTP',
                'slug' => 'wp-smtp',
                'required' => false,
                'force_activation' => false,
                'force_deactivation' => false,
            ),
            array(
                'name' => 'EWWW Image Optimizer',
                'slug' => 'ewww-image-optimizer',
                'required' => false,
                'force_activation' => false,
                'force_deactivation' => false,
            ),
            array(
                'name' => 'TinyMCE Advanced',
                'slug' => 'tinymce-advanced',
                'required' => false,
                'force_activation' => false,
                'force_deactivation' => false,
            ),
            array(
                'name' => 'Woocommerce',
                'slug' => 'woocommerce',
                'required' => false,
                'force_activation' => false,
                'force_deactivation' => false,
            ),
            array(
                'name' => 'Remove slug from custom post type',
                'slug' => 'remove-slug-from-custom-post-type',
                'required' => false,
                'force_activation' => false,
                'force_deactivation' => false,
            ),
            array(
                'name' => 'WP htaccess Control',
                'slug' => 'wp-htaccess-control',
                'required' => false,
                'force_activation' => false,
                'force_deactivation' => false,
            )
        );

        // Config TGM
        $configs = array(
            'menu' => 'ew_plugin_install',
            'has_notice' => true,
            'dismissable' => false,
            'is_automatic' => true
        );
        tgmpa($plugins, $configs);
    }

    add_action('tgmpa_register', 'ew_plugin_activation');
}