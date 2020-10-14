<?php

namespace App;


class Form_login{
    public function __construct(){
        add_shortcode( 'uilogin', array($this,'uilogin_func' ));
        add_action( 'loop_start', array($this,'wpdocs_personal_message_when_logged_in' ));
        
    }


    function wpdocs_personal_message_when_logged_in() {
        if ( is_user_logged_in() ) {
            $current_user = \wp_get_current_user();
            //dd($current_user);
            printf( '<h3>  %s, Vous êtes deja connecté ;)!</h3>', esc_html( $current_user->user_nicename ) );
        } else {
            echo( 'Non-Personalized Message!' );
        }
    }
    
 

    
    public function uilogin_func( $args ) {
       
        if( is_user_logged_in()){
            return false;
        }else{
            $a = shortcode_atts( array(
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
              
              \wp_login_form( $a );


        }
            
        }
       
        
       
      


      
        
   //[uilogin redirect=“http://site.com/logged-in-page”] 

}

