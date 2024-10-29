<?php

$plugin_name = DSAMM_PLUGIN_NAME;
$plugin_version = DSAMM_PLUGINPRO_VERSION;
$plugin_url = DSAMM_PRO_PLUGIN_URL;
$plugin_ver_type = DSAMM_PLUGIN_VERSION_TYPE;
$plugin_slug = 'basic_menu_manager';
$admin_interface = new DSAMM_Admin_Interface();
?>
<div id="dotsstoremain">
    <div class="all-pad">
        <?php 
$admin_interface->dsamm_get_promotional_bar( $plugin_slug );
?>
        <input type="hidden" name="dpb_api_url" id="dpb_api_url" value="<?php 
echo esc_url( DSAMM_STORE_URL );
?>">
        <header class="dots-header">

            <div class="dots-plugin-details">
                <div class="dots-header-left">
                    <div class="dots-logo-main">
                        <img  src="<?php 
echo esc_url( $plugin_url ) . 'images/amm-logo.png';
?>">
                    </div>
                    <div class="plugin-name">
                        <div class="title"><?php 
echo esc_html( $plugin_name );
?></div>
                    </div>
                    <span class="version-label <?php 
echo esc_attr( $plugin_slug );
?>"><?php 
esc_html_e( $plugin_ver_type, 'advance-menu-manager' );
?></span>
                    <span class="version-number"><?php 
echo esc_html( 'v' . $plugin_version, 'advance-menu-manager' );
?></span>
                </div>
                <div class="dots-header-right">
                    <div class="button-dots">                        
                            <a target="_blank" href="<?php 
echo esc_url( 'http://www.thedotstore.com/support/' );
?>"><?php 
esc_html_e( 'Support', 'advance-menu-manager' );
?></a>
                    </div>
                    <div class="button-dots">
                        <a target="_blank" href="<?php 
echo esc_url( 'https://www.thedotstore.com/feature-requests/' );
?>"><?php 
esc_html_e( 'Suggest', 'advance-menu-manager' );
?></a>
                    </div>
                    <div class="button-dots <?php 
echo ( ammp_fs()->is__premium_only() && ammp_fs()->can_use_premium_code() ? '' : esc_attr( 'last-link-button' ) );
?>">
                        <a target="_blank" href="<?php 
echo esc_url( 'https://docs.thedotstore.com/collection/626-advance-menu-manager-for-wordpress' );
?>"><?php 
esc_html_e( 'Help', 'advance-menu-manager' );
?></a>
                    </div>
                    <div class="button-dots">
                        <?php 
?>
                            <a class="dots-upgrade-btn" target="_blank" href="javascript:void(0);"><?php 
esc_html_e( 'Upgrade Now', 'advance-menu-manager' );
?></a>
                        <?php 
?>
                    </div>
                </div>
            </div>

            <?php 
$menu_advance_manager_get_started_method = '';
$wc_lite_extra_shipping_dotstore_contact_support_method = '';
$dotstore_setting_menu_enable = '';
$dotpremium_setting_menu_enable = '';
$add_new_menu_manager = '';
$ammp_account_page = '';
$select_tab = filter_input( INPUT_GET, 'tab', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
$section = filter_input( INPUT_GET, 'section', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
$current_page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
$menu_advance_manager_premium_method = '';
if ( !empty( $select_tab ) && 'menu_advance_manager_premium_method' === $select_tab ) {
    $menu_advance_manager_premium_method = "active";
}
if ( !empty( $select_tab ) && $select_tab !== '' && !empty( $section ) && 'menu-manager-add' === $select_tab ) {
    $add_new_menu_manager = "active";
}
if ( !empty( $select_tab ) && 'menu_advance_manager_get_started_method' === $select_tab ) {
    $menu_advance_manager_get_started_method = "active";
}
if ( !empty( $select_tab ) && 'menu_advance_manager_get_started_method' === $select_tab || !(ammp_fs()->is__premium_only() && ammp_fs()->can_use_premium_code()) && 'advance-menu-manager-account' === $current_page ) {
    $ammp_main_menu = "active";
}
if ( !empty( $select_tab ) && 'wc_lite_extra_shipping_dotstore_contact_support_method' === $select_tab ) {
    $wc_lite_extra_shipping_dotstore_contact_support_method = "active";
}
if ( !empty( $current_page ) && 'advance-menu-manager-account' === $current_page ) {
    $ammp_account_page = "active";
}
$whsm_display_submenu = ( !empty( $ammp_main_menu ) && 'active' === $ammp_main_menu ? 'display:inline-block' : 'display:none' );
$site_url = "admin.php?page=advance-menu-manager-pro&tab=";
?>
            <div class="dots-bottom-menu-main">
                <div class="dots-menu-main">
                    <nav>
                        <ul>
                            <li>
                                <a class="dotstore_plugin <?php 
echo esc_attr( $add_new_menu_manager );
?>"  href="<?php 
echo esc_url( $site_url ) . '&tab=menu-manager-add&section=menu-add';
?>"><?php 
esc_html_e( 'Menus', 'advance-menu-manager' );
?></a>
                            </li>
                            <?php 
?>
                                <li>
                                    <a class="dotstore_plugin dots_get_premium <?php 
echo esc_attr( $menu_advance_manager_premium_method );
?>" href="<?php 
echo esc_url( $site_url . '&tab=menu_advance_manager_premium_method' );
?>"><?php 
esc_html_e( 'Get Premium', 'advance-menu-manager' );
?></a>
                                </li>
                            <?php 
?>
                            <?php 
if ( ammp_fs()->is__premium_only() && ammp_fs()->can_use_premium_code() ) {
    ?>
                                <li>
                                    <a class="dotstore_plugin <?php 
    echo esc_attr( $ammp_account_page );
    ?>" href="<?php 
    echo esc_url( ammp_fs()->get_account_url() );
    ?>"><?php 
    esc_html_e( 'License', 'advance-menu-manager' );
    ?></a>
                                </li>
                                <?php 
}
?>
                        </ul>
                    </nav>
                </div>
                <div class="dots-getting-started">
                    <a href="<?php 
echo esc_url( $site_url ) . 'menu_advance_manager_get_started_method';
?>" class="<?php 
echo esc_attr( $menu_advance_manager_get_started_method );
?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false"><path d="M12 4.75a7.25 7.25 0 100 14.5 7.25 7.25 0 000-14.5zM3.25 12a8.75 8.75 0 1117.5 0 8.75 8.75 0 01-17.5 0zM12 8.75a1.5 1.5 0 01.167 2.99c-.465.052-.917.44-.917 1.01V14h1.5v-.845A3 3 0 109 10.25h1.5a1.5 1.5 0 011.5-1.5zM11.25 15v1.5h1.5V15h-1.5z" fill="#a0a0a0"></path></svg></a>
                </div>
            </div>
        </header>
        <div class="dots-settings-inner-main">
            <div class="dots-settings-left-side">