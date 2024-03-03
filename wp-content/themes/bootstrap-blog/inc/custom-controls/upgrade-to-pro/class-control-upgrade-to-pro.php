<?php
/**
 * Customizer Control: Upgrade to Pro
 *
 * @package Bootstrap Blog
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! class_exists( 'Bootstrap_Blog_Control_Upgrade_To_Pro' ) ) {
    /**
     * Upgrade to Pro control
     */
    class Bootstrap_Blog_Control_Upgrade_To_Pro extends WP_Customize_Control {
        /**
         * The control type.
         *
         * @access public
         * @var string
         */
        public $type = 'upgrade-to-pro-control';

        /**
         * Set title.
         *
         * @access public
         * @var string
         */
        public $title = '';

        /**
         * Set items.
         *
         * @access public
         * @var array
         */
        public $items = array();

        /**
         * Set button URL.
         *
         * @access public
         * @var string
         */
        public $button_url = '';

        /**
         * Set button text.
         *
         * @access public
         * @var string
         */
        public $button_text = '';

        /**
         * Refresh the parameters passed to the JavaScript via JSON.
         *
         * @access public
         * @return void
         */
        public function json() {
            $json = parent::json();

            $json['title'] = $this->title;
            $json['items'] = $this->items;
            $json['button_url'] = $this->button_url;
            $json['button_text'] = $this->button_text;

            return $json;
        }

        /**
         * Enqueue control related scripts/styles.
         *
         * @access public
         */
        public function enqueue() {
            wp_enqueue_script(
                'bootstrap-blog-control-upgrade-to-pro-js',
                get_template_directory_uri() . '/inc/custom-controls/upgrade-to-pro/upgrade-to-pro.js',
                array( 'jquery' ),
                BOOTSTRAP_BLOG_VERSION,
                true
            );
            wp_enqueue_style(
                'bootstrap-blog-control-upgrade-to-pro-css',
                get_template_directory_uri() . '/inc/custom-controls/upgrade-to-pro/upgrade-to-pro.css',
                array(),
                BOOTSTRAP_BLOG_VERSION
            );
        }

        /**
         * Render content.
         */
        public function content_template() {
            ?>
            <div class="upgrade-to-pro-container">
                <div class="upgrade-to-pro-logo">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" xml:space="preserve" version="1.1" viewBox="0 0 32 32"><image width="32" height="32" xlink:href="data:image/png;base64,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"/>
                    </svg>
                </div>
                <div class="upgrade-to-pro-title">{{ data.title }}</div>
                <ul class="upgrade-to-pro-items">
                    <# _.each( data.items, function( item, i ) { #>
                    <li class="upgrade-to-pro-item"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M12.2399 4.23999L6.79994 9.67999L4.55994 7.43999L3.43994 8.55999L6.79994 11.92L13.3599 5.35999L12.2399 4.23999Z" fill="#0284C7"></path></svg><span class="upgrade-to-pro-item-title">{{ item.title }}</span></li>
                    <# }); #>
                </ul>
                <a href="{{{ data.button_url }}}" target="_blank" class="upgrade-to-pro-button">{{data.button_text}}</a>
            </div>
            <?php
        }
    }
}