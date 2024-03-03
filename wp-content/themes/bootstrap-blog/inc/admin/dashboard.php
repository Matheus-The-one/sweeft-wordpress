<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Bootstrap_Blog_Admin_Dashboard' ) ) {

  /**
   * Admin Panel 
   */
  class Bootstrap_Blog_Admin_Dashboard {

    private static $_instance = null;
    // Theme name without Pro
    private $theme_name = 'Bootstrap Blog';
    // Theme domain without -pro
    private $theme_domain = 'bootstrap-blog';
    private $theme_desc = 'With its modern and minimalistic design, the Bootstrap Blog theme is the perfect tool for creating captivating blogging websites. It is an ideal choice for individuals who blog about personal experiences, lifestyle, fashion, health and fitness, travel, beauty, and other fascinating topics.';
    private $theme_page = 'https://thebootstrapthemes.com/bootstrap-blog/#free-vs-pro';
    private $theme_doc = 'https://thebootstrapthemes.freshdesk.com/support/solutions/folders/44001184336';

    static function get_instance() {
      if (is_null(self::$_instance)) {
        self::$_instance = new self();
      }
      return self::$_instance;
    }

    function init() {
      if (is_admin()) {
        add_action('admin_menu', array($this, 'add_theme_page'));
        add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));
        add_filter( 'admin_footer_text', array( $this, 'get_footer_text' ), 99 );
        add_action('admin_init', array($this, 'admin_dismiss_actions'));
        // Add option for Demo Import if not exists
        if (!get_option($this->theme_domain.'-demo_content_imported')) {
          add_option($this->theme_domain.'-demo_content_imported', false);
        }
      }
    }

    /**
     * Registers dashboard page to WordPress admin
     */
    function add_theme_page() {
      $actions = $this->get_recommended_actions(true, false);
      $count = $actions['no_alerts'];
      if ($count > 0) {
        $update_label = sprintf(_n('%1$s action required', '%1$s actions required', $count, 'bootstrap-blog'), $count);
        $count = " <span class='update-plugins count-" . esc_attr($count) . "' title='" . esc_attr($update_label) . "'><span class='update-count'>" . number_format_i18n($count) . "</span></span>";
        $menu_title = sprintf(esc_html__('Bootstrap Blog %s', 'bootstrap-blog'), $count);
      } else {
        $menu_title = esc_html__('Bootstrap Blog', 'bootstrap-blog');
      }
      add_theme_page(
        esc_html__('Bootstrap Blog', 'bootstrap-blog'),
        $menu_title,
        'edit_theme_options',
        $this->theme_domain,
        array($this, 'theme_page_content')
      );
    }

    /**
     * Enqueue scripts for admin dashboard only
     */
    function admin_scripts($hook) {
      if ($hook === 'appearance_page_'.$this->theme_domain) {
        $theme_directory_url = get_template_directory_uri();
        // Dashboard styles
        wp_enqueue_style(
          'bootstrapthemes-dashboard-css',
          $theme_directory_url . '/inc/admin/dashboard.css'
        );
        // Recommended scripts for plugin install
        wp_enqueue_style('plugin-install');
        wp_enqueue_script('plugin-install');
        wp_enqueue_script('updates');
        add_thickbox();
      }
    }

    /**
     * Admin Dashboard content
     */
    function theme_page_content() {
      $theme_data = wp_get_theme();

      // Check for current viewing tab
      $tab = null;
      if (isset($_GET['tab'])) {
        $tab = sanitize_text_field($_GET['tab']);
      } else {
        $tab = null;
      }

      // Get recommended actions
      $actions = $this->get_recommended_actions(true, false);
      ?>
      <div class="wrap about-wrap theme_info_wrapper">
        <h1><?php printf(esc_html__('Welcome to %1$s - Version %2$s', 'bootstrap-blog'), $this->theme_name, $theme_data->Version); ?></h1>
        <div class="about-text"><?php echo printf(esc_html__('%s', 'bootstrap-blog'), $this->theme_desc); ?></div>
        <a target="_blank" href="<?php echo esc_url('https://thebootstrapthemes.com/'); ?>" class="thebootstrapthemes-badge wp-badge"><span>TheBootStrap<br>Themes</span></a>

        <hr class="wp-header-end">

        <h2 class="nav-tab-wrapper">
          <a href="?page=<?php echo $this->theme_domain;?>" class="nav-tab<?php echo is_null($tab) ? ' nav-tab-active' : null; ?>"><?php esc_html_e('Getting Started', 'bootstrap-blog'); echo ($actions['no_alerts'] > 0) ? "<span class='theme-action-count'>{$actions['no_alerts']}</span>" : ''; ?></a>
          <a href="?page=<?php echo $this->theme_domain;?>&tab=demo_import" class="nav-tab<?php echo $tab == 'demo_import' ? ' nav-tab-active' : null; ?>"><?php esc_html_e('Demo Import', 'bootstrap-blog');?></a>
          <?php if ( fs_bootstrap_blog()->is_free_plan() ) { ?>
          <a href="?page=<?php echo $this->theme_domain;?>&tab=free_pro" class="nav-tab<?php echo $tab == 'free_pro' ? ' nav-tab-active' : null; ?>"><?php esc_html_e('Get Premium', 'bootstrap-blog'); ?></span></a>
          <?php } ?>
        </h2>

        <?php
        if (is_null($tab)) {
          $this->render_tab_content_get_started();
        } else if ($tab == 'demo_import') {
          $this->render_tab_content_demo_import();
        } else if ($tab == 'free_pro') {
          $this->render_tab_content_free_pro();
        }
        ?>
      </div>
      <?php 
    }

    /**
     * Render required plugins for tab "Get started"
     */
    function render_required_plugins_get_started() {
      $generator = $this->required_plugins_generator();
      foreach ($generator as $plugin) {
        // Ignore Demo Import plugin on the "Get started" tab
        if ($plugin['slug'] !== 'tbthemes-demo-import') {
          echo '<div class="rcp">';
          echo '<h4 class="rcp-name">';
          echo esc_html($plugin['name']);
          echo '</h4>';
          echo '<p class="action-btn plugin-card-' . esc_attr($plugin['slug']) . '"><a href="' . esc_url($plugin['install_url']) . '" data-slug="' . esc_attr($plugin['slug']) . '" class="' . esc_attr($plugin['button_class']) . '">' . $plugin['button_txt'] . '</a></p>';
          echo '<a class="plugin-detail thickbox open-plugin-details-modal" href="' . esc_url($plugin['detail_link']) . '">' . esc_html__('Details', 'bootstrap-blog') . '</a>';
          echo '</div>';
        }
      }
    }

    /**
     * Content of the tab "Get started"
     */
    function render_tab_content_get_started() {
      $actions = $this->get_recommended_actions(true, false);
      $current_action_link = admin_url('themes.php?page='.$this->theme_domain);
      ?>
      <div class="theme_info info-tab-content">
        
        <?php if ($actions['required_plugins']) { ?>
        <div id="plugin-filter" class="required-plugins action-required">
          <h3><?php esc_html_e('Required Plugins', 'bootstrap-blog'); ?></h3>
          <div class="about">
            <p><?php printf(esc_html__("To take full advantage of the %s functionality, please install the following plugins.", 'bootstrap-blog'), $this->theme_name); ?></p>
          </div>
          <?php $this->render_required_plugins_get_started(); ?>
        </div>
        <?php } ?>

        <?php if ($actions['demo_import']) { ?>
          <div class="theme_link action-required">
            <a title="" class="dismiss" href="<?php echo add_query_arg(array('dismiss_action' => 'demo_import'), $current_action_link); ?>">
              <span class="dashicons dashicons-no"></span>
            </a>
            <h3><?php esc_html_e('Import Demo content', 'bootstrap-blog'); ?></h3>
            <div class="about">
              <p><?php _e('Save time by importing the Demo Content with just a couple of clicks. Your website will be set up and ready to customize in minutes!', 'bootstrap-blog'); ?></p>
              <p><?php _e('Have you already imported the Demo Content? Feel free to close this message.', 'bootstrap-blog'); ?></p>
            </div>
            <p>
              <a href="?page=<?php echo $this->theme_domain;?>&tab=demo_import" class="button"><?php esc_html_e('Import Demo content', 'bootstrap-blog'); ?></a>
            </p>
          </div>
        <?php } ?>

        <div class="theme_link">
          <h3><?php esc_html_e('Theme Customizer', 'bootstrap-blog'); ?></h3>
          <p class="about"><?php printf(esc_html__('With %s, you can easily customize all theme settings using the Theme Customizer. Begin customizing your site by clicking on "Customize".', 'bootstrap-blog'), $this->theme_name); ?></p>
          <p>
            <a href="<?php echo admin_url('customize.php'); ?>" class="button button-primary"><?php esc_html_e('Customize your site', 'bootstrap-blog'); ?></a>
          </p>
        </div>
        <div class="theme_link">
          <h3><?php esc_html_e('Theme Documentation', 'bootstrap-blog'); ?></h3>
          <p class="about"><?php printf(esc_html__('Need help with setting up and configuring the %s theme? Please, take a look at our documentation pages.', 'bootstrap-blog'), $this->theme_name); ?></p>
          <p>
            <a href="<?php echo esc_url($this->theme_doc); ?>" target="_blank" class="button button-secondary"><?php printf(esc_html__('Check Documentation', 'bootstrap-blog')); ?></a>
          </p>
        </div>
        <div class="theme_link">
          <h3><?php esc_html_e('Theme Support', 'bootstrap-blog'); ?></h3>
          <p class="about"><?php printf(esc_html__('Require further assistance with your %s theme? Please describe your issue in the contact form. We love helping our customers with their WordPress sites!', 'bootstrap-blog'), $this->theme_name); ?></p>
          <p>
            <a href="?page=<?php echo $this->theme_domain;?>-contact" class="button button-secondary"><?php echo esc_html__('Contact Us', 'bootstrap-blog'); ?></a>
          </p>
        </div>
      </div>
    <?php
    }

    /**
     * Render required plugins for tab "Demo Import"
     */
    function render_required_plugins_demo_import() {
      $generator = $this->required_plugins_generator();
      foreach ($generator as $plugin) {
        echo '<div id="plugin-filter" class="demo-import-boxed">';
        echo '<p>';
        printf(
          esc_html__(
            'To import a Demo site, you must first install and activate the %1$s plugin.',
            'bootstrap-blog'
          ),
          '<a class="thickbox open-plugin-details-modal" href="' . esc_url($plugin['detail_link']) . '">' . $plugin['name'] . '</a>'
        );
        echo '</p>';
        echo '<p class="plugin-card-' . esc_attr($plugin['slug']) . '"><a href="' . esc_url($plugin['install_url']) . '" data-slug="' . esc_attr($plugin['slug']) . '" class="' . esc_attr($plugin['button_class']) . '">' . $plugin['button_txt'] . '</a></p>';
        echo '</div>';
      }
    }

    /**
     * Content of the tab "Demo Import"
     */
    function render_tab_content_demo_import() {
      $actions = $this->get_recommended_actions(false, true);
      ?>
      <div class="info-tab-content demo-import-tab-content">
      <?php if ($actions['required_plugins']) {
          $this->render_required_plugins_demo_import();
        } else {
          do_action('bootstrapthemes_demo_import_tab');
        } ?>
      </div>
    <?php }

    /**
     * Content of the tab "Get Premium"
     */
    function render_tab_content_free_pro() { ?>
      <div id="free_pro" class="info-tab-content">
        <table class="free-pro-table">
          <thead>
            <tr>
              <th></th>
              <th><?php echo $this->theme_name;?></th>
              <th><?php echo $this->theme_name;?> Pro</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <h3>Unlimited Colors</h3>
              </td>
              <td class="icon-red"><span class="dashicons-before dashicons-no-alt"></span></td>
              <td class="icon-green"><span class="dashicons-before dashicons-yes"></span></td>
            </tr>
            <tr>
              <td>
                <h3>Google Fonts</h3>
              </td>
              <td class="icon-red"><span class="dashicons-before dashicons-no-alt"></span></td>
              <td class="icon-green"><span class="dashicons-before dashicons-yes"></span></td>
            </tr>
            <tr>
              <td>
                <h3>Footer Copyright</h3>
              </td>
              <td class="icon-red"><span class="dashicons-before dashicons-no-alt"></span></td>
              <td class="icon-green"><span class="dashicons-before dashicons-yes"></span></td>
            </tr>
            <tr>
              <td>
                <h3>Drag & Drop</h3>
              </td>
              <td class="icon-red"><span class="dashicons-before dashicons-no-alt"></span></td>
              <td class="icon-green"><span class="dashicons-before dashicons-yes"></span></td>
            </tr>
            <tr>
              <td>
                <h3>Customer Support</h3>
              </td>
              <td class="icon-red"><span class="dashicons-before dashicons-no-alt"></span></td>
              <td class="icon-green"><span class="dashicons-before dashicons-yes"></span></td>
            </tr>
            <tr class="ti-about-page-text-center">
              <td></td>
              <td colspan="2"><a href="<?php echo $this->theme_page;?>" target="_blank" class="button button-primary button-hero"><?php printf(esc_html__('Get %s Pro now!', 'bootstrap-blog'), $this->theme_name); ?></a></td>
            </tr>
          </tbody>
        </table>
      </div>
    <?php
    }

    /**
     *  Dashboard footer text
     */
    function get_footer_text() {
      $footer_text = sprintf(
        __( 'Enjoyed %1$s? Please leave us a %2$s review. Your support means a lot to us!', 'bootstrap-blog' ),
        '<strong>' . $this->theme_name . '</strong>',
        '<a href="https://wordpress.org/support/theme/'.$this->theme_domain.'/reviews/?rate=5#new-post" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a>'
      );
      return $footer_text;
    }

    /**
     * Get array of plugins required by the theme
     */
    function get_required_plugins() {
      $required_plugins = get_theme_support('required-plugins');

      if (is_array($required_plugins) && isset($required_plugins[0])) {
        $required_plugins = $required_plugins[0];
      } else {
        $required_plugins[] = array();
      }

      foreach ($required_plugins as $plugin) {
        $plugin = wp_parse_args($plugin, array(
          'slug' => '',
          'name' => '',
          'active_filename' => '',
        ));
        if (!$plugin['active_filename']) {
          $plugin['active_filename'] = $plugin['slug'] . '/' . $plugin['slug'] . '.php';
        }
      }

      return $required_plugins;
    }

    /**
     * Get actions recommended by the theme
     *
     * @param $ignore_demo_plugin - whether the Demo Import plugin should
     * be ignored in the actions
     * @param $ignore_demo_message - whether the Demo Import message should
     * be ignored in the actions
     * @return array
     */
    function get_recommended_actions( $ignore_demo_plugin = false, $ignore_demo_message = false ) {

      $actions = array();
      $actions['no_alerts'] = 0;

      // Required plugins
      $actions['required_plugins'] = false;
      $required_plugins = $this->get_required_plugins();
      if (!empty($required_plugins)) {
        foreach ($required_plugins as $plugin) {
          // Ignore Demo Import plugin if desired
          if (!($plugin['slug'] === 'tbthemes-demo-import' && $ignore_demo_plugin)) {
            if (!is_plugin_active($plugin['active_filename'])) {
              $actions['required_plugins'] = true;
              $actions['no_alerts']++;
            }
          }
        }
      }

      // Demo import message
      $actions['demo_import'] = false;
      if (!$ignore_demo_message) {
        if (empty(get_option($this->theme_domain.'-demo_content_imported'))) {
          $actions['demo_import'] = true;
          $actions['no_alerts']++;
        }
      }

      return $actions;
    }

    /**
     * Generator yielding necessary information for rendering required plugins
     */
    function required_plugins_generator() {
      $required_plugins = $this->get_required_plugins();

      foreach ($required_plugins as $plugin) {
        $install_status = is_dir(WP_PLUGIN_DIR . '/' . $plugin['slug']);

        if (!is_plugin_active($plugin['active_filename'])) {
          if (!$install_status) {
            $install_url = wp_nonce_url(
              add_query_arg(
                array(
                  'action' => 'install-plugin',
                  'plugin' => $plugin['slug']
                ),
                network_admin_url('update.php')
              ),
              'install-plugin_' . $plugin['slug']
            );
            $button_class = 'install-now button';
            $button_txt = esc_html__('Install Now', 'bootstrap-blog');
          } else {
            $install_url = add_query_arg(array(
              'action' => 'activate',
              'plugin' => rawurlencode($plugin['active_filename']),
              'plugin_status' => 'all',
              'paged' => '1',
              '_wpnonce' => wp_create_nonce('activate-plugin_' . $plugin['active_filename']),
            ), network_admin_url('plugins.php'));
            $button_class = 'activate-now button-primary';
            $button_txt = esc_html__('Activate Now', 'bootstrap-blog');
          }

          $detail_link = add_query_arg(
            array(
              'tab' => 'plugin-information',
              'plugin' => $plugin['slug'],
              'TB_iframe' => 'true',
              'width' => '772',
              'height' => '349',

            ),
            network_admin_url('plugin-install.php')
          );

          yield array(
            'slug'  => $plugin['slug'],
            'name'  => $plugin['name'],
            'active_filename'  => $plugin['active_filename'],
            'install_url' => $install_url,
            'detail_link' => $detail_link,
            'button_class'  => $button_class,
            'button_txt'  => $button_txt
          );
        }
      }
    }

    /**
     * Dismiss recommended actions
     */
    function admin_dismiss_actions() {
      if (isset($_GET['dismiss_action'])) {
        $action = sanitize_text_field($_GET['dismiss_action']);
        if ($action === 'demo_import') {
          update_option($this->theme_domain.'-demo_content_imported', true);
          $url = wp_unslash($_SERVER['REQUEST_URI']);
          $url = remove_query_arg('dismiss_action', $url);
          wp_redirect($url);
          die();
        }
      }
    }
  }
}

Bootstrap_Blog_Admin_Dashboard::get_instance()->init();