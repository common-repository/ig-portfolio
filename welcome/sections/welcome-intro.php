<?php
/**
 * Welcome Intro
 */
?>
    <ul class="ig-intro">
        <li class="evidence">
            <h2><?php esc_html_e('Settings', 'ig-portfolio') ?></h3>
            <p><?php esc_html_e( 'Ready to get started? Start to customize and setup your plugin in the settings page.', 'ig-portfolio' ); ?></p>
            <a href="<?php echo admin_url('edit.php?post_type=project&page=ig-portfolio-settings-page'); ?>" target="_self" class="button-upgrade">
                <?php esc_html_e( 'Go to settings page', 'ig-portfolio' ); ?>
            </a>
        </li>
        <li>
            <h2><?php esc_html_e('Documentation', 'ig-portfolio') ?></h3>
            <p><?php esc_html_e('Learn more about your new plugin, visit our website to read the plugin documentation.', 'ig-portfolio') ?></p>
            <a href="http://www.iograficathemes.com/documentation/ig-portfolio/" target="_blank" class="button">
                <?php esc_html_e( 'Read the documentation', 'ig-portfolio' ); ?>
            </a>
        </li>
    </ul>