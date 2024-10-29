<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

?>
    <div class="amm-main-table res-cl">
        <div class="dots-getting-started-main">
            <div class="getting-started-content">
                <span><?php esc_html_e( 'How to Get Started', 'advance-menu-manager' ); ?></span>
                <h3><?php esc_html_e( 'Welcome to Advance Manu Manager Plugin', 'advance-menu-manager' ); ?></h3>
                <p><?php esc_html_e( 'Thank you for choosing our top-rated Advance Manu Manager plugin. Our user-friendly interface makes it easy to manage large and complex menus!', 'advance-menu-manager' ); ?></p>
                <p>
                    <?php 
                    echo sprintf(
                        esc_html__('To help you get started, watch the quick tour video on the right. For more help, explore our help documents or visit our %s for detailed video tutorials.', 'advance-menu-manager'),
                        '<a href="' . esc_url('https://www.youtube.com/@Dotstore16') . '" target="_blank">' . esc_html__('YouTube channel', 'advance-menu-manager') . '</a>',
                    );
                    ?>
                </p>
                <div class="getting-started-actions">
                    <a href="<?php echo esc_url(add_query_arg(array('page' => 'advance-menu-manager-pro', 'tab' => 'menu-manager-add', 'section' => 'menu-add'), admin_url('admin.php'))); ?>" class="quick-start"><?php esc_html_e( 'Manage Your Menus', 'advance-menu-manager' ); ?><span class="dashicons dashicons-arrow-right-alt"></span></a>
                    <a href="https://docs.thedotstore.com/article/958-beginners-guide-for-menu-manager" target="_blank" class="setup-guide"><span class="dashicons dashicons-book-alt"></span><?php esc_html_e( 'Read the Setup Guide', 'advance-menu-manager' ); ?></a>
                </div>
            </div>
            <div class="getting-started-video">
                <iframe width="960" height="600" src="<?php echo esc_url('https://www.youtube.com/embed/dF_m4NbSNyY'); ?>" title="<?php esc_attr_e( 'Plugin Tour', 'advance-menu-manager' ); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div> 
</div>
</div>
</div>
</div>
