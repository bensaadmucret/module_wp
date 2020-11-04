<?php

namespace App;


class Form_login
{
    public function __construct()
    {
        add_shortcode('uilogin', array($this,'uilogin_func' ));
        //add_action( 'loop_start', array($this,'mzb_personal_message_when_logged_in' ));
    }


    
    public function uilogin_func($args)
    {
        /*
          if( is_user_logged_in()){
              $current_user = \wp_get_current_user();
              //dd($current_user);
              printf( '<h3>  %s, Vous êtes deja connecté !</h3>', esc_html( 'Hello '.  $current_user->user_nicename ) );
          }else{
              $form = shortcode_atts( array(
                  'echo' => true,
                  'remember' => true,
                  'redirect' => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
                  'form_id' => 'loginform',
                  'id_username' => 'user_login',
                  'id_password' => 'user_pass',
                  'id_remember' => 'rememberme',
                  'id_submit' => 'wp-submit',
                  'label_username' => __( 'Username or Email Address' ),
                  'label_password' => __( 'Password' ),
                  'label_remember' => __( 'Remember Me' ),
                  'label_log_in' => __( 'Log In' ),
                  'value_username' => '',
                  'value_remember' => false
                ), $args );

                \wp_login_form( $form );


          }

    }

   //[uilogin redirect=“http://site.com/logged-in-page”]
*/
        $defaults = array(
    'echo'           => true,
    // Default 'redirect' value takes the user back to the request URI.
    'redirect'       => (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
    'form_id'        => 'loginform',
    'label_username' => __('Username or Email Address'),
    'label_password' => __('Password'),
    'label_remember' => __('Remember Me'),
    'label_log_in'   => __('Log In'),
    'id_username'    => 'user_login',
    'id_password'    => 'user_pass',
    'id_remember'    => 'rememberme',
    'id_submit'      => 'wp-submit',
    'remember'       => true,
    'value_username' => '',
    // Set 'value_remember' to true to default the "Remember me" checkbox to checked.
    'value_remember' => false,
);

        /**
         * Filters the default login form output arguments.
         *
         * @since 3.0.0
         *
         * @see wp_login_form()
         *
         * @param array $defaults An array of default login form arguments.
         */
        $args = wp_parse_args($args, apply_filters('login_form_defaults', $defaults));

        /**
         * Filters content to display at the top of the login form.
         *
         * The filter evaluates just following the opening form tag element.
         *
         * @since 3.0.0
         *
         * @param string $content Content to display. Default empty.
         * @param array  $args    Array of login form arguments.
         */
        $login_form_top = apply_filters('login_form_top', '', $args);

        /**
         * Filters content to display in the middle of the login form.
         *
         * The filter evaluates just following the location where the 'login-password'
         * field is displayed.
         *
         * @since 3.0.0
         *
         * @param string $content Content to display. Default empty.
         * @param array  $args    Array of login form arguments.
         */
        $login_form_middle = apply_filters('login_form_middle', '', $args);

        /**
         * Filters content to display at the bottom of the login form.
         *
         * The filter evaluates just preceding the closing form tag element.
         *
         * @since 3.0.0
         *
         * @param string $content Content to display. Default empty.
         * @param array  $args    Array of login form arguments.
         */
        $login_form_bottom = apply_filters('login_form_bottom', '', $args);

        $form = '
    <form name="' . $args['form_id'] . '" id="' . $args['form_id'] . '" action="' . esc_url(site_url('', 'login_post')) . '" method="post">
        ' . $login_form_top . '
        <p class="login-username">
            <label for="' . esc_attr($args['id_username']) . '">' . esc_html($args['label_username']) . '</label>
            <input type="text" name="log" id="' . esc_attr($args['id_username']) . '" class="input" value="' . esc_attr($args['value_username']) . '" size="20" />
        </p>
        <p class="login-password">
            <label for="' . esc_attr($args['id_password']) . '">' . esc_html($args['label_password']) . '</label>
            <input type="password" name="pwd" id="' . esc_attr($args['id_password']) . '" class="input" value="" size="20" />
        </p>
        ' . $login_form_middle . '
        ' . ($args['remember'] ? '<p class="login-remember"><label><input name="rememberme" type="checkbox" id="' . esc_attr($args['id_remember']) . '" value="forever"' . ($args['value_remember'] ? ' checked="checked"' : '') . ' /> ' . esc_html($args['label_remember']) . '</label></p>' : '') . '
        <p class="login-submit">
            <input type="submit" name="wp-submit" id="' . esc_attr($args['id_submit']) . '" class="button button-primary" value="' . esc_attr($args['label_log_in']) . '" />
            <input type="hidden" name="redirect_to" value="' . esc_url($args['redirect']) . '" />
        </p>
        ' . $login_form_bottom . '
    </form>';

        if ($args['echo']) {
            echo $form;
        } else {
            return $form;
        }
    }
}