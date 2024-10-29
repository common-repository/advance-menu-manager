<?php
/**
 * Handles free plugin get premium page
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get product details from Freemius via API
$annual_plugin_price = '';
$monthly_plugin_price = '';
$plugin_details = array(
    'product_id' => 45099,
);

$api_url = add_query_arg(wp_rand(), '', DSAMM_STORE_URL . 'wp-json/dotstore-product-fs-data/v2/dotstore-product-fs-data');
$final_api_url = add_query_arg($plugin_details, $api_url);

if ( function_exists( 'vip_safe_wp_remote_get' ) ) {
    $api_response = vip_safe_wp_remote_get( $final_api_url, 3, 1, 20 );
} else {
    $api_response = wp_remote_get( $final_api_url ); // phpcs:ignore
}

if ( ( !is_wp_error($api_response)) && (200 === wp_remote_retrieve_response_code( $api_response ) ) ) {
    $api_response_body = wp_remote_retrieve_body($api_response);
    $plugin_pricing = json_decode( $api_response_body, true );

    if ( isset( $plugin_pricing ) && ! empty( $plugin_pricing ) ) {
        $first_element = reset( $plugin_pricing );
        if ( ! empty( $first_element['price_data'] ) ) {
            $first_price = reset( $first_element['price_data'] )['annual_price'];
        } else {
            $first_price = "0";
        }

        if( "0" !== $first_price ){
            $annual_plugin_price = $first_price;
            $monthly_plugin_price = round( intval( $first_price  ) / 12 );
        }
    }
}

// Set plugin key features content
$plugin_key_features = array(
    array(
        'title' => esc_html__( 'Track, Compare, and Restore Menu Changes', 'advance-menu-manager' ),
        'description' => esc_html__( 'You can keep a detailed history of all your menu changes, easily compare versions, and restore previous revisions as needed.', 'advance-menu-manager' ),
        'popup_image' => esc_url( DSAMM_PRO_PLUGIN_URL . 'includes/admin/images/pro-features-img/feature-box-one-img.jpeg' ),
        'popup_content' => array(
            esc_html__( 'Maintain a comprehensive log of every menu modification, allowing you to compare different versions side-by-side. Effortlessly restore previous versions.', 'advance-menu-manager' )
        ),
        'popup_examples' => array(
            esc_html__( 'Side-by-side menu comparison and quick options.', 'advance-menu-manager' ),
            esc_html__( 'Secure your menu structure to prevent accidental changes.', 'advance-menu-manager' ),
        )
    ),
    array(
        'title' => esc_html__( 'Enhanced Interface for Adding Menu Items', 'advance-menu-manager' ),
        'description' => esc_html__( 'Utilize an advanced and user-friendly interface to add and organize menu items with precision and effortlessly.', 'advance-menu-manager' ),
        'popup_image' => esc_url( DSAMM_PRO_PLUGIN_URL . 'includes/admin/images/pro-features-img/feature-box-two-img.jpeg' ),
        'popup_content' => array(
            esc_html__( 'Efficiently manage your menu structure with a modern, intuitive interface designed to streamline the process of adding and arranging menu items.', 'advance-menu-manager' ),
        ),
        'popup_examples' => array(
            esc_html__( 'Organize and customize your menu layout effortlessly.', 'advance-menu-manager' ),
            esc_html__( 'Fine-tune your menu behavior and appearance to suit your needs.', 'advance-menu-manager' )
        )
    ),
    array(
        'title' => esc_html__( 'Flexible Menu Placement with Shortcodes', 'advance-menu-manager' ),
        'description' => esc_html__( 'Easily integrate your customized menus into any page or post on your site or blog using simple and versatile shortcodes.', 'advance-menu-manager' ),
        'popup_image' => esc_url( DSAMM_PRO_PLUGIN_URL . 'includes/admin/images/pro-features-img/feature-box-three-img.jpeg' ),
        'popup_content' => array(
            esc_html__( 'Empower your site\'s navigation by seamlessly embedding your custom menus into various sections of your website with intuitive shortcodes.', 'advance-menu-manager' ),
        ),
        'popup_examples' => array(
            esc_html__( 'Specify the desired menu by ID, slug, or name.', 'advance-menu-manager' ),
            esc_html__( 'Define the CSS class for the UL element that forms the menu.', 'advance-menu-manager' ),
            esc_html__( 'Set an ID for the container.', 'advance-menu-manager' )
        )
    ),
    array(
        'title' => esc_html__( 'Menu Lock Feature', 'advance-menu-manager' ),
        'description' => esc_html__( 'Ensure menu integrity by locking specific menus, safeguarding them from unintended changes by other users, and maintaining consistent navigation across your site.', 'advance-menu-manager' ),
        'popup_image' => esc_url( DSAMM_PRO_PLUGIN_URL . 'includes/admin/images/pro-features-img/feature-box-four-img.jpeg' ),
        'popup_content' => array(
            esc_html__( 'Ensure menu integrity by locking specific menus, safeguarding them from unintended changes by other users, and maintaining consistent navigation across your site.', 'advance-menu-manager' ),
        ),
        'popup_examples' => array(
            esc_html__( 'Easily toggle the lock status of menus for swift and secure access control.', 'advance-menu-manager' ),
            esc_html__( 'Choose specific users who are permitted to edit the menu.', 'advance-menu-manager' ),
        )
    ),
    array(
        'title' => esc_html__( 'Add New Pages to Menu From Item Screen', 'advance-menu-manager' ),
        'description' => esc_html__( 'Streamline menu customization by creating new pages directly from the menu item screen for seamless navigation management.', 'advance-menu-manager' ),
        'popup_image' => esc_url( DSAMM_PRO_PLUGIN_URL . 'includes/admin/images/pro-features-img/feature-box-five-img.jpeg' ),
        'popup_content' => array(
            esc_html__( 'Effortlessly integrate new pages into your website\'s navigation menus directly from the menu editing interface.', 'advance-menu-manager' ),
        ),
        'popup_examples' => array(
            esc_html__( 'Go to add new menu popup and create page directly.', 'advance-menu-manager' ),
            esc_html__( 'Easily add new posts directly in the menu.', 'advance-menu-manager' )
        )
    ),
);
?>
    <div class="dotstore-upgrade-dashboard">
        <div class="premium-benefits-section">
            <h2><?php esc_html_e( 'Upgrade to Unlock Premium Features', 'advance-menu-manager' ); ?></h2>
            <p><?php esc_html_e( 'Upgrade to the premium version for advanced features and effortless management of large, complex menus!', 'advance-menu-manager' ); ?></p>
        </div>
        <div class="premium-plugin-details">
            <div class="premium-key-fetures">
                <h3><?php esc_html_e( 'Discover Our Top Key Features', 'advance-menu-manager' ); ?></h3>
                <ul>
                    <?php 
                    if ( isset( $plugin_key_features ) && ! empty( $plugin_key_features ) ) {
                        foreach( $plugin_key_features as $key_feature ) {
                            ?>
                            <li>
                                <h4><?php echo esc_html( $key_feature['title'] ); ?><span class="premium-feature-popup"></span></h4>
                                <p><?php echo esc_html( $key_feature['description'] ); ?></p>
                                <div class="feature-explanation-popup-main">
                                    <div class="feature-explanation-popup-outer">
                                        <div class="feature-explanation-popup-inner">
                                            <div class="feature-explanation-popup">
                                                <span class="dashicons dashicons-no-alt popup-close-btn" title="<?php esc_attr_e('Close', 'advance-menu-manager'); ?>"></span>
                                                <div class="popup-body-content">
                                                    <div class="feature-content">
                                                        <h4><?php echo esc_html( $key_feature['title'] ); ?></h4>
                                                        <?php 
                                                        if ( isset( $key_feature['popup_content'] ) && ! empty( $key_feature['popup_content'] ) ) {
                                                            foreach( $key_feature['popup_content'] as $feature_content ) {
                                                                ?>
                                                                <p><?php echo esc_html( $feature_content ); ?></p>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        <ul>
                                                            <?php 
                                                            if ( isset( $key_feature['popup_examples'] ) && ! empty( $key_feature['popup_examples'] ) ) {
                                                                foreach( $key_feature['popup_examples'] as $feature_example ) {
                                                                    ?>
                                                                    <li><?php echo esc_html( $feature_example ); ?></li>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                    <div class="feature-image">
                                                        <img src="<?php echo esc_url( $key_feature['popup_image'] ); ?>" alt="<?php echo esc_attr( $key_feature['title'] ); ?>">
                                                    </div>
                                                </div>
                                            </div>      
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="premium-plugin-buy">
                <div class="premium-buy-price-box">
                    <div class="price-box-top">
                        <div class="pricing-icon">
                            <img src="<?php echo esc_url( DSAMM_PRO_PLUGIN_URL . 'includes/admin/images/premium-upgrade-img/pricing-1.svg' ); ?>" alt="<?php esc_attr_e( 'Personal Plan', 'advance-menu-manager' ); ?>">
                        </div>
                        <h4><?php esc_html_e( 'Personal', 'advance-menu-manager' ); ?></h4>
                    </div>
                    <div class="price-box-middle">
                        <?php
                        if ( ! empty( $annual_plugin_price ) ) {
                            ?>
                            <div class="monthly-price-wrap"><?php echo esc_html( '$' . $monthly_plugin_price ); ?><span class="seprater">/</span><span><?php esc_html_e( 'month', 'advance-menu-manager' ); ?></span></div>
                            <div class="yearly-price-wrap"><?php echo sprintf( esc_html__( 'Pay $%s today. Renews in 12 months.', 'advance-menu-manager' ), esc_html( $annual_plugin_price ) ); ?></div>
                            <?php   
                        }
                        ?>
                        <span class="for-site"><?php esc_html_e( '1 site', 'advance-menu-manager' ); ?></span>
                        <p class="price-desc"><?php esc_html_e( 'Great for website owners with a single WooCommerce Store', 'advance-menu-manager' ); ?></p>
                    </div>
                    <div class="price-box-bottom">
                        <a href="javascript:void(0);" class="upgrade-now"><?php esc_html_e( 'Get The Premium Version', 'advance-menu-manager' ); ?></a>
                        <p class="trusted-by"><?php esc_html_e( 'Trusted by 100,000+ store owners and WP experts!', 'advance-menu-manager' ); ?></p>
                    </div>
                </div>
                <div class="premium-satisfaction-guarantee premium-satisfaction-guarantee-2">
                    <div class="money-back-img">
                        <img src="<?php echo esc_url(DSAMM_PRO_PLUGIN_URL . 'includes/admin/images/premium-upgrade-img/14-Days-Money-Back-Guarantee.png'); ?>" alt="<?php esc_attr_e('14-Day money-back guarantee', 'advance-menu-manager'); ?>">
                    </div>
                    <div class="money-back-content">
                        <h2><?php esc_html_e( '14-Day Satisfaction Guarantee', 'advance-menu-manager' ); ?></h2>
                        <p><?php esc_html_e( 'You are fully protected by our 100% Satisfaction Guarantee. If over the next 14 days you are unhappy with our plugin or have an issue that we are unable to resolve, we\'ll happily consider offering a 100% refund of your money.', 'advance-menu-manager' ); ?></p>
                    </div>
                </div>
                <div class="plugin-customer-review">
                    <h3><?php esc_html_e( 'Great Productivity Saving!', 'advance-menu-manager' ); ?></h3>
                    <p>
                        <?php echo wp_kses( __( 'This plugin <strong>saved me hours of work and is very easy to use</strong>! The search function is great for my hundreds of pages, and <strong>hiding existing menu items is especially useful</strong>. Exactly what I needed.', 'advance-menu-manager' ), array(
                                'strong' => array(),
                            ) ); 
                        ?>
                    </p>
                    <div class="review-customer">
                        <div class="customer-img">
                            <img src="<?php echo esc_url(DSAMM_PRO_PLUGIN_URL . 'includes/admin/images/premium-upgrade-img/customer-profile-img.png'); ?>" alt="<?php esc_attr_e('Customer Profile Image', 'advance-menu-manager'); ?>">
                        </div>
                        <div class="customer-name">
                            <span><?php esc_html_e( 'Simon Harris', 'advance-menu-manager' ); ?></span>
                            <div class="customer-rating-bottom">
                                <div class="customer-ratings">
                                    <span class="dashicons dashicons-star-filled"></span>
                                    <span class="dashicons dashicons-star-filled"></span>
                                    <span class="dashicons dashicons-star-filled"></span>
                                    <span class="dashicons dashicons-star-filled"></span>
                                    <span class="dashicons dashicons-star-filled"></span>
                                </div>
                                <div class="verified-customer">
                                    <span class="dashicons dashicons-yes-alt"></span>
                                    <?php esc_html_e( 'Verified Customer', 'advance-menu-manager' ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="upgrade-to-pro-faqs">
            <h2><?php esc_html_e( 'FAQs', 'advance-menu-manager' ); ?></h2>
            <div class="upgrade-faqs-main">
                <div class="upgrade-faqs-list">
                    <div class="upgrade-faqs-header">
                        <h3><?php esc_html_e( 'Do you offer support for the plugin? What’s it like?', 'advance-menu-manager' ); ?></h3>
                    </div>
                    <div class="upgrade-faqs-body">
                        <p>
                        <?php 
                            echo sprintf(
                                esc_html__('Yes! You can read our %s or submit a %s. We are very responsive and strive to do our best to help you.', 'advance-menu-manager'),
                                '<a href="' . esc_url('https://docs.thedotstore.com/collection/626-advanced-menu-manager') . '" target="_blank">' . esc_html__('knowledge base', 'advance-menu-manager') . '</a>',
                                '<a href="' . esc_url('https://www.thedotstore.com/support-ticket/') . '" target="_blank">' . esc_html__('support ticket', 'advance-menu-manager') . '</a>',
                            );

                        ?>
                        </p>
                    </div>
                </div>
                <div class="upgrade-faqs-list">
                    <div class="upgrade-faqs-header">
                        <h3><?php esc_html_e( 'What payment methods do you accept?', 'advance-menu-manager' ); ?></h3>
                    </div>
                    <div class="upgrade-faqs-body">
                        <p><?php esc_html_e( 'You can pay with your credit card using Stripe checkout. Or your PayPal account.', 'advance-menu-manager' ); ?></p>
                    </div>
                </div>
                <div class="upgrade-faqs-list">
                    <div class="upgrade-faqs-header">
                        <h3><?php esc_html_e( 'What’s your refund policy?', 'advance-menu-manager' ); ?></h3>
                    </div>
                    <div class="upgrade-faqs-body">
                        <p><?php esc_html_e( 'We have a 14-day money-back guarantee.', 'advance-menu-manager' ); ?></p>
                    </div>
                </div>
                <div class="upgrade-faqs-list">
                    <div class="upgrade-faqs-header">
                        <h3><?php esc_html_e( 'I have more questions…', 'advance-menu-manager' ); ?></h3>
                    </div>
                    <div class="upgrade-faqs-body">
                        <p>
                        <?php 
                            echo sprintf(
                                esc_html__('No problem, we’re happy to help! Please reach out at %s.', 'advance-menu-manager'),
                                '<a href="' . esc_url('mailto:hello@thedotstore.com') . '" target="_blank">' . esc_html('hello@thedotstore.com') . '</a>',
                            );

                        ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="upgrade-to-premium-btn">
            <a href="javascript:void(0);" target="_blank" class="upgrade-now"><?php esc_html_e( 'Get The Premium Version', 'advance-menu-manager' ); ?><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="crown" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="svg-inline--fa fa-crown fa-w-20 fa-3x" width="22" height="20"><path fill="#000" d="M528 448H112c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h416c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm64-320c-26.5 0-48 21.5-48 48 0 7.1 1.6 13.7 4.4 19.8L476 239.2c-15.4 9.2-35.3 4-44.2-11.6L350.3 85C361 76.2 368 63 368 48c0-26.5-21.5-48-48-48s-48 21.5-48 48c0 15 7 28.2 17.7 37l-81.5 142.6c-8.9 15.6-28.9 20.8-44.2 11.6l-72.3-43.4c2.7-6 4.4-12.7 4.4-19.8 0-26.5-21.5-48-48-48S0 149.5 0 176s21.5 48 48 48c2.6 0 5.2-.4 7.7-.8L128 416h384l72.3-192.8c2.5.4 5.1.8 7.7.8 26.5 0 48-21.5 48-48s-21.5-48-48-48z" class=""></path></svg></a>
        </div>
    </div>
</div>
</div>
</div>
</div>
<?php 
