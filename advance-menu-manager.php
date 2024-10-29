<?php

/**
* Plugin Name: Advance Menu Manager
* Plugin URI:   https://www.thedotstore.com/advance-menu-manager-wordpress/
* Description:  Customize and manage your menu from here. Add, edit, and delete menu items.
* Author:       theDotstore
* Author URI:   https://www.thedotstore.com/
* License:      GPL-2.0+
* License URI:  http://www.gnu.org/licenses/gpl-2.0.txt
* Text Domain:  advance-menu-manager
* Version:      3.1.1
* License:      GNU General Public License v3.0
* License URI:  http://www.gnu.org/licenses/gpl-3.0.html
* 
* WP tested up to:     6.6.2
* Requires PHP:        7.2
* Requires at least:   5.0
*
* @author    theDotstore
* @category  Plugin
* @copyright Copyright (c) 2019-2020 theDotstore.
* @license
*/
if ( !defined( 'WPINC' ) ) {
    die;
}
if ( function_exists( 'ammp_fs' ) ) {
    ammp_fs()->set_basename( false, __FILE__ );
    return;
}
if ( !function_exists( 'ammp_fs' ) ) {
    // Create a helper function for easy SDK access.
    function ammp_fs() {
        global $ammp_fs;
        if ( !isset( $ammp_fs ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $ammp_fs = fs_dynamic_init( array(
                'id'              => '3496',
                'slug'            => 'advance-menu-manager',
                'type'            => 'plugin',
                'public_key'      => 'pk_20a3cb3184ddb17fc7c53bf40727d',
                'is_premium'      => false,
                'premium_suffix'  => 'Premium',
                'has_addons'      => false,
                'has_paid_plans'  => true,
                'has_affiliation' => 'selected',
                'trial'           => array(
                    'days'               => 14,
                    'is_require_payment' => true,
                ),
                'menu'            => array(
                    'slug'       => 'advance-menu-manager',
                    'first-path' => 'admin.php?page=advance-menu-manager-pro&tab=menu_advance_manager_get_started_method',
                    'contact'    => false,
                    'support'    => false,
                ),
                'is_live'         => true,
            ) );
        }
        return $ammp_fs;
    }

    // Init Freemius.
    ammp_fs();
    // Signal that SDK was initiated.
    do_action( 'ammp_fs_loaded' );
    ammp_fs()->get_upgrade_url();
    ammp_fs()->add_action( 'after_uninstall', 'ammp_fs_uninstall_cleanup' );
}
/**
 * prevent direct access data leaks
 *
 * This is the condition to prevent direct access data leaks.
 *
 * @version     3.0.0
 * @author      theDotstore
 * 
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly
}
if ( !defined( 'DSAMM_PLUGIN_NAME' ) ) {
    define( 'DSAMM_PLUGIN_NAME', 'Advance Menu Manager' );
}
if ( !defined( 'DSAMM_PLUGIN_SLUG' ) ) {
    define( 'DSAMM_PLUGIN_SLUG', 'advance-menu-manager' );
}
if ( !defined( 'DSAMM_PLUGIN_VERSION_TYPE' ) ) {
    define( 'DSAMM_PLUGIN_VERSION_TYPE', esc_html__( 'Free', 'advance-menu-manager' ) );
}
if ( !defined( 'DSAMM_PLUGIN_TITLE_NAME' ) ) {
    define( 'DSAMM_PLUGIN_TITLE_NAME', 'Advance Menu Manager' );
}
if ( !defined( 'DSAMM_PRO_PLUGIN_URL' ) ) {
    define( 'DSAMM_PRO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}
if ( !defined( 'DSAMM_PLUGIN_BASENAME' ) ) {
    define( 'DSAMM_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}
if ( !defined( 'DSAMM_PLUGINPRO_VERSION' ) ) {
    define( 'DSAMM_PLUGINPRO_VERSION', '3.1.1' );
}
if ( !defined( 'DSAMM_PRO_PLUGIN_BASENAME' ) ) {
    define( 'DSAMM_PRO_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}
define( 'DSAMM_PLUGIN_BASE_PATH', plugin_dir_url( __FILE__ ) . "/images/" );
define( 'DSAMM_PLUGIN_PATH', plugin_dir_url( __FILE__ ) . "includes/" );
define( 'DSAMM_PLUGIN_FILE', plugin_basename( __FILE__ ) );
if ( !defined( 'DSAMM_STORE_URL' ) ) {
    define( 'DSAMM_STORE_URL', 'https://www.thedotstore.com/' );
}
/**
 * 
 * Hook fire on activation of plugin
 * 
 * @version     3.0.0
 * @author      theDotstore
 * 
 */
if ( !function_exists( 'dsamm_activate_pro' ) ) {
    register_activation_hook( __FILE__, 'dsamm_activate_pro' );
    function dsamm_activate_pro() {
        require_once plugin_dir_path( __FILE__ ) . 'includes/classes/class_activator.php';
        set_transient( '_welcome_screen_activation_redirect_data', true, 30 );
    }

}
/**
 * 
 * Hook for add links on plugin listing 
 * 
 * @version     3.0.0
 * @author      theDotstore
 * 
 */
if ( !function_exists( 'dsamm_plugin_action_links' ) ) {
    $prefix = ( is_network_admin() ? 'network_admin_' : '' );
    function dsamm_plugin_action_links(  $actions  ) {
        $custom_actions = array(
            'configure' => sprintf( '<a href="%s">%s</a>', esc_url( add_query_arg( array(
                'page' => 'advance-menu-manager-pro&tab=menu-manager-add&section=menu-add',
            ), admin_url( 'admin.php' ) ) ), __( 'Settings', 'advance-menu-manager' ) ),
            'support'   => sprintf( '<a href="%s" target="_blank">%s</a>', esc_url( 'www.thedotstore.com/support' ), __( 'Support', 'advance-menu-manager' ) ),
        );
        // add the links to the front of the actions list
        return array_merge( $custom_actions, $actions );
    }

    add_filter(
        "{$prefix}plugin_action_links_" . DSAMM_PRO_PLUGIN_BASENAME,
        'dsamm_plugin_action_links',
        10,
        4
    );
}
/**
 * Add review stars in plugin row meta
 *
 * @since 1.0.0
 */
if ( !function_exists( 'dsamm_plugin_row_meta_action_links' ) ) {
    function dsamm_plugin_row_meta_action_links(  $plugin_meta, $plugin_file, $plugin_data  ) {
        if ( isset( $plugin_data['TextDomain'] ) && $plugin_data['TextDomain'] !== 'advance-menu-manager' ) {
            return $plugin_meta;
        }
        $url = '';
        $url = esc_url( 'https://wordpress.org/plugins/advance-menu-manager/#reviews' );
        $plugin_meta[] = sprintf( '<a href="%s" target="_blank" style="color:#f5bb00;">%s</a>', $url, esc_html( '★★★★★' ) );
        return $plugin_meta;
    }

    add_filter(
        'plugin_row_meta',
        'dsamm_plugin_row_meta_action_links',
        20,
        3
    );
}
/**
 * 
 * This function will run for register text domain for translation compatible
 * 
 * @version     3.0.0
 * @author      theDotstore
 * 
 */
if ( !function_exists( 'dsamm_load_plugin_textdomain' ) ) {
    function dsamm_load_plugin_textdomain() {
        load_plugin_textdomain( 'advance-menu-manager', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    }

    add_action( 'plugins_loaded', 'dsamm_load_plugin_textdomain' );
}
/**
 * 
 * This function will run for enqueue the styles and scripts for plugin only in admin.
 *
 * @version     3.0.0
 * @author      theDotstore
 * 
 */
if ( !function_exists( 'dsamm_add_scripts_styles_admin' ) ) {
    function dsamm_add_scripts_styles_admin() {
        $current_page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        if ( !empty( $current_page ) && isset( $current_page ) && ($current_page === 'advance-menu-manager-pro' || $current_page === 'advance-menu-manager' || $current_page === 'advance-menu-manager-pro-account' || $current_page === 'advance-menu-manager-account') ) {
            wp_enqueue_style( 'dsamm_style_fancy', plugin_dir_url( __FILE__ ) . 'includes/admin/css/fancy_alert.css' );
            wp_enqueue_style( 'dsamm_style_fancy' );
            wp_register_script(
                'dsamm_fancy_alert',
                plugin_dir_url( __FILE__ ) . '/includes/js/fancy_alert.js',
                array('jquery'),
                false
            );
            wp_enqueue_script( 'dsamm_fancy_alert' );
            wp_register_script(
                'dsamm_pagination',
                plugin_dir_url( __FILE__ ) . '/includes/js/dsamm_pagination.js',
                array('jquery'),
                false
            );
            wp_enqueue_script( 'dsamm_pagination' );
            wp_enqueue_script(
                'custom-js-own',
                plugin_dir_url( __FILE__ ) . 'includes/js/custom.js',
                array('jquery'),
                false
            );
            wp_register_style(
                'dsamm-setup-wizard-css',
                plugin_dir_url( __FILE__ ) . 'includes/admin/css/plugin-setup-wizard.css',
                array(),
                false,
                'all'
            );
            wp_enqueue_style( 'dsamm-setup-wizard-css' );
            wp_register_style(
                'own-style-css',
                plugin_dir_url( __FILE__ ) . 'includes/admin/css/style.css',
                array('wp-jquery-ui-dialog'),
                'all'
            );
            wp_enqueue_style( 'own-style-css' );
            wp_register_style(
                'own-media-style',
                plugin_dir_url( __FILE__ ) . 'includes/admin/css/media.css',
                array(),
                false,
                'all'
            );
            wp_register_style(
                'dsamm-upgrade-dashboard-css',
                plugin_dir_url( __FILE__ ) . 'includes/admin/css/upgrade-dashboard.css',
                array(),
                false,
                'all'
            );
            wp_enqueue_style( 'dsamm-upgrade-dashboard-css' );
            wp_register_style(
                'dsamm-plugin-new-style',
                plugin_dir_url( __FILE__ ) . 'includes/admin/css/plugin-new-style.css',
                array(),
                false,
                'all'
            );
            wp_enqueue_style( 'dsamm-plugin-new-style' );
            // Freemius checkout popup library for upgrade
            wp_enqueue_script(
                'dsamm-plugin-freemius_pro',
                'https://checkout.freemius.com/checkout.min.js',
                array('jquery'),
                false
            );
            wp_enqueue_script(
                'dsamm-plugin-help-beacon',
                plugin_dir_url( __FILE__ ) . 'includes/js/help-scout-beacon.js',
                array('jquery'),
                false
            );
            wp_enqueue_script(
                'custom-js-dsamm',
                plugin_dir_url( __FILE__ ) . 'includes/js/dsamm_custom.js',
                array('jquery', 'jquery-ui-dialog'),
                false
            );
            $params = array(
                'ajaxurl'                 => admin_url( 'admin-ajax.php' ),
                'ajax_nonce'              => wp_create_nonce( 'dsamm_ajax_value_nonce' ),
                'setup_wizard_ajax_nonce' => wp_create_nonce( 'wizard_ajax_nonce' ),
            );
            wp_localize_script( 'custom-js-own', 'ajax_object', $params );
            $params = array(
                'ajaxurl'    => admin_url( 'admin-ajax.php' ),
                'ajax_nonce' => wp_create_nonce( 'dsamm_ajax_value_nonce' ),
            );
            wp_localize_script( 'dsamm_pagination', 'ajax_object', $params );
        }
        wp_enqueue_style( 'amm_style_notice', plugin_dir_url( __FILE__ ) . 'includes/admin/css/notice.css' );
        wp_enqueue_style( 'amm_style_notice' );
    }

    add_action( 'admin_enqueue_scripts', 'dsamm_add_scripts_styles_admin' );
}
/**
 * Welcome screen activation redirect
 * 
 * @version     3.0.0
 * @author      theDotstore
 * 
 */
if ( !function_exists( 'dsamm_welcome_pro_screen_do_activation_redirect' ) ) {
    function dsamm_welcome_pro_screen_do_activation_redirect() {
        // if no activation redirect
        if ( !get_transient( '_welcome_screen_activation_redirect_data' ) ) {
            return;
        }
        // Delete the redirect transient
        delete_transient( '_welcome_screen_activation_redirect_data' );
        // if activating from network, or bulk
        $activate_multi = filter_input( INPUT_GET, 'activate-multi', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        if ( is_network_admin() || isset( $activate_multi ) ) {
            return;
        }
        // Redirect to extra cost welcome page
        wp_safe_redirect( add_query_arg( array(
            'page' => 'advance-menu-manager',
            'tab'  => 'menu_advance_manager_get_started_method',
        ), admin_url( 'admin.php' ) ) );
        exit;
    }

    add_action( 'admin_init', 'dsamm_welcome_pro_screen_do_activation_redirect' );
}
/**
 * spl_autoload_register function
 *
 * This function will run admin panel loades.
 *
 * @version     3.0.0
 * @author      theDotstore
 * 
 */
if ( !function_exists( 'dsamm_pro_autoloader' ) ) {
    function dsamm_pro_autoloader() {
        require_once plugin_dir_path( __FILE__ ) . 'includes/classes/class_admin_page.php';
        require_once plugin_dir_path( __FILE__ ) . 'includes/classes/class_admin_menu_walker.php';
        require_once plugin_dir_path( __FILE__ ) . 'includes/classes/class_menu_ajax_action.php';
    }

    spl_autoload_register( 'dsamm_pro_autoloader' );
}
/**
 * 
 * Admin menu for plugin
 * 
 * @version     3.0.0
 * @author      theDotstore
 * 
 */
if ( !function_exists( 'dsamm_menu_advance_menu_manager_pro' ) ) {
    function dsamm_menu_advance_menu_manager_pro() {
        global $GLOBALS;
        if ( empty( $GLOBALS['admin_page_hooks']['dots_store'] ) ) {
            add_menu_page(
                __( 'Dotstore Plugins', 'advance-menu-manager' ),
                'Dotstore Plugins',
                'NULL',
                'dots_store',
                'dot_store_advance_menu',
                'dashicons-marker',
                6
            );
        }
        add_submenu_page(
            "dots_store",
            "Advance Menu Manager",
            "Advance Menu Manager",
            "manage_options",
            "advance-menu-manager-pro",
            "dsamm_advance_submenu_extra_pro"
        );
    }

    add_action( 'admin_menu', 'dsamm_menu_advance_menu_manager_pro' );
}
/**
 * Callback function of sub menu function
 *  
 * @version     3.0.0
 * @author      theDotstore
 * 
 */
if ( !function_exists( 'dsamm_advance_submenu_extra_pro' ) ) {
    function dsamm_advance_submenu_extra_pro() {
        require_once plugin_dir_path( __FILE__ ) . 'includes/admin/header/plugin-header.php';
        wp_enqueue_style( 'own-webkit-style' );
        wp_enqueue_style( 'own-media-style' );
        $tab = filter_input( INPUT_GET, 'tab', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        $tab_exist = ( isset( $tab ) && !empty( $tab ) ? $tab : '' );
        if ( $tab_exist ) {
            if ( $tab_exist === "menu-manager-add" ) {
                // Upgrade to pro popup
                if ( !(ammp_fs()->is__premium_only() && ammp_fs()->can_use_premium_code()) ) {
                    require_once dirname( __FILE__ ) . '/includes/admin/dots-upgrade-popup.php';
                }
                ?>
                <div class="amm-main-table res-cl adv-menu-manager-main left-container">
                    <!-- Menu content start -->
                    <?php 
                require_once dirname( __FILE__ ) . '/includes/admin/admin.php';
                ?>
                    <!-- Menu content end -->
                </div>
                </div>
                </div>
                </div>
                </div>
                <?php 
            }
            if ( $tab_exist === 'menu_advance_manager_get_started_method' ) {
                require_once plugin_dir_path( __FILE__ ) . 'includes/admin/amm-pro-get-started-page.php';
            }
            if ( $tab_exist === "menu_advance_manager_premium_method" ) {
                require_once plugin_dir_path( __FILE__ ) . 'includes/admin/premium_method.php';
            }
        }
    }

}
/**
 * 
 * Ajax actions loads
 * 
 * @version     3.0.0
 * @author      theDotstore
 * 
 */
add_action( 'admin_init', array('DSAMM_Admin_Interface', 'dsamm_send_wizard_data_after_plugin_activation') );
add_filter( 'admin_footer_text', array('DSAMM_Admin_Interface', 'dsamm_admin_footer_review') );
add_action( 'wp_ajax_dsamm_plugin_setup_wizard_submit', array('DSAMM_Admin_Interface', 'dsamm_plugin_setup_wizard_submit') );
add_action( 'wp_ajax_my_action_delete_menu', array('DSAMM_Admin_Interface', 'dsamm_action_ajax_for_delete_menu') );
add_action( 'wp_ajax_my_action_create_menu_ajax', array('DSAMM_Admin_Interface', 'dsamm_action_ajax_for_create_menu') );
add_action( 'wp_ajax_amm_duplicate_menu', array('DSAMM_Admin_Interface', 'dsamm_amm_duplicate_menu') );
// menu edit ajax action
add_action( 'wp_ajax_my_action_for_popup_menu_item_edit', array('DSAMM_Revision_Ajax_Action', 'dsamm_menu_edit_action_method_own') );
// add new post/page
add_action( 'wp_ajax_my_action_for_popup_add_new_post', array('DSAMM_Revision_Ajax_Action', 'dsamm_add_new_post_action_method_own') );
// search texonomy terms
add_action( 'wp_ajax_my_action_for_amm_taxonomy_search', array('DSAMM_Revision_Ajax_Action', 'dsamm_my_action_for_amm_taxonomy_search') );
//edit menu item as client on menu item
add_action( 'wp_ajax_my_action_for_popup_menu_item_edit_front_end', array('DSAMM_Revision_Ajax_Action', 'dsamm_popup_menu_item_edit_frontend') );
add_action( 'wp_ajax_my_action_for_main_popup_fontend_menu_item_edit_submit', array('DSAMM_Revision_Ajax_Action', 'dsamm_main_popup_fontend_menu_item_edit_submit_action_own') );
// popup content
add_action( 'wp_ajax_my_action_for_add_new_menu_item_html', array('DSAMM_Revision_Ajax_Action', 'dsamm_add_new_menu_item_html_own') );
add_action( 'wp_ajax_my_action_for_add_new_menu_item_html_filter', array('DSAMM_Revision_Ajax_Action', 'dsamm_add_new_menu_item_html_filter_own') );
// Pagination post per page feature
add_action( 'wp_ajax_my_action_for_add_pagination_limit', array('DSAMM_Revision_Ajax_Action', 'dsamm_add_pagination_post_per_page_limit_method') );
/**
 * 
 * If tab not set then redirect to menu main page 
 * 
 * @version     3.0.0
 * @author      theDotstore
 * 
 */
if ( !function_exists( 'dsamm_admin_without_tab_redirect' ) ) {
    function dsamm_admin_without_tab_redirect() {
        $tab = filter_input( INPUT_GET, 'tab', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        $page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        if ( !empty( $page ) && empty( $tab ) && 'advance-menu-manager-pro' === $page ) {
            $url = site_url( 'wp-admin/admin.php?page=advance-menu-manager-pro&tab=menu-manager-add&section=menu-add' );
            wp_safe_redirect( $url, 301 );
            exit;
        }
    }

    add_action( 'wp_loaded', 'dsamm_admin_without_tab_redirect' );
}
/**
 * Filter data
 *
 * @param string $string
 *
 * @since 3.0.7
 *
 */
function dsamm_filter_sanitize_string(  $string  ) {
    $str = preg_replace( '/\\x00|<[^>]*>?/', '', $string );
    return str_replace( ["'", '"'], ['&#39;', '&#34;'], $str );
}

/**
 * Add custom css for dotstore icon in admin area
 *
 * @since  3.9.3
 *
 */
if ( !function_exists( 'dsamm_dot_store_icon_css' ) ) {
    function dsamm_dot_store_icon_css() {
        // Remove submenu
        remove_submenu_page( 'dots_store', 'dots_store' );
        // CSS for main menu icon
        echo '<style>
        .toplevel_page_dots_store .dashicons-marker::after{content:"";border:3px solid;position:absolute;top:14px;left:15px;border-radius:50%;opacity: 0.6;}
        li.toplevel_page_dots_store:hover .dashicons-marker::after,li.toplevel_page_dots_store.current .dashicons-marker::after{opacity: 1;}
        @media only screen and (max-width: 960px){
            .toplevel_page_dots_store .dashicons-marker::after{left:14px;}
        }
        </style>';
    }

    add_action( 'admin_head', 'dsamm_dot_store_icon_css' );
}
/**
 * Hide freemius account tab
 *
 * @since    3.9.3
 */
if ( !function_exists( 'dsamm_hide_account_tab' ) ) {
    function dsamm_hide_account_tab() {
        return true;
    }

    ammp_fs()->add_filter( 'hide_account_tabs', 'dsamm_hide_account_tab' );
}
/**
 * Include plugin header on freemius account page
 *
 * @since    1.0.0
 */
if ( !function_exists( 'dsamm_load_plugin_header_after_account' ) ) {
    function dsamm_load_plugin_header_after_account() {
        require_once plugin_dir_path( __FILE__ ) . 'includes/admin/header/plugin-header.php';
        ?>
        </div>
        </div>
        </div>
        </div>
        <?php 
    }

    ammp_fs()->add_action( 'after_account_details', 'dsamm_load_plugin_header_after_account' );
}
/**
 * Hide billing and payments details from freemius account page
 *
 * @since    3.9.3
 */
if ( !function_exists( 'dsamm_hide_billing_and_payments_info' ) ) {
    function dsamm_hide_billing_and_payments_info() {
        return true;
    }

    ammp_fs()->add_action( 'hide_billing_and_payments_info', 'dsamm_hide_billing_and_payments_info' );
}
/**
 * Hide powerd by popup from freemius account page
 *
 * @since    3.9.3
 */
if ( !function_exists( 'dsamm_hide_freemius_powered_by' ) ) {
    function dsamm_hide_freemius_powered_by() {
        return true;
    }

    ammp_fs()->add_action( 'hide_freemius_powered_by', 'dsamm_hide_freemius_powered_by' );
}
/**
 * Start plugin setup wizard before license activation screen
 *
 * @since 3.1.0
 */
if ( !function_exists( 'dsamm_load_plugin_setup_wizard_connect_before' ) ) {
    function dsamm_load_plugin_setup_wizard_connect_before() {
        require_once plugin_dir_path( __FILE__ ) . 'includes/admin/dots-plugin-setup-wizard.php';
        ?>
        <div class="tab-panel" id="step5">
            <div class="ds-wizard-wrap">
                <div class="ds-wizard-content">
                    <h2 class="cta-title"><?php 
        echo esc_html__( 'Activate Plugin', 'advance-menu-manager' );
        ?></h2>
                </div>
        <?php 
    }

    ammp_fs()->add_action( 'connect/before', 'dsamm_load_plugin_setup_wizard_connect_before' );
}
/**
 * End plugin setup wizard after license activation screen
 *
 * @since 3.1.0
 */
if ( !function_exists( 'dsamm_load_plugin_setup_wizard_connect_after' ) ) {
    function dsamm_load_plugin_setup_wizard_connect_after() {
        ?>
        </div>
        </div>
        </div>
        </div>
        <?php 
    }

    ammp_fs()->add_action( 'connect/after', 'dsamm_load_plugin_setup_wizard_connect_after' );
}