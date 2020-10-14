<?php

namespace App;

use App\HTTPRequest;



class Register {

    private $user_login, $user_email, $user_pass;

    
    public function __construct(){

        add_action('user_register', array($this,'send_welcome_email_to_new_user'));
        
        add_filter('user_contactmethods',  array($this,'butter_modified_fields'));
        $request = new HTTPRequest();
        if( $request->method()=== "POST"){
            
            $this->user_login = $user_login = $request->postData('user_login'); 
            $this->user_email = $user_email = $request->postData('user_email'); 
            $this->user_email = $user_pass = $request->postData('user_pass'); 

            
            \wp_create_user( $user_login, $user_pass, $user_email);
            $to = get_option('admin_email');
            $subject = 'The subject';
            $body = 'The email body content';
            $headers = array('Content-Type: text/html; charset=UTF-8');
            \wp_mail( $to, $subject, $message, '', array( '' ) );           
            

        }
        
       
    }

    /**
     * userage <?php echo the_author_meta('twitter'); ?>
     * @var mixed
     */

    public function butter_modified_fields( $contact_methods ){

        $contact_methods['skype'] = __('Skype Username', 'butter'); 
        $contact_methods['twitter'] = __('Twitter Username', 'butter'); 
        $contact_methods['dribbble'] = __('Dribbble Username', 'butter'); 
        $contact_methods['facebook'] = __('Full FB URL', 'butter'); 
    
        return $contact_methods;
    }
    
    
    
    
        

    
    function send_welcome_email_to_new_user($user_id) {
        $user = get_userdata($user_id);
        $user_email = $user->user_email;
        // for simplicity, lets assume that user has typed their first and last name when they sign up
        $user_full_name = $user->user_firstname . $user->user_lastname;
    
        // Now we are ready to build our welcome email
        $to = $user_email;
        $subject = "Hi " . $user_full_name . ", welcome to our site!";
        $body = '
                  <h1>Dear ' . $user_full_name . ',</h1></br>
                  <p>Thank you for joining our site. Your account is now active.</p>
                  <p>Please go ahead and navigate around your account.</p>
                  <p>Let me know if you have further questions, I am here to help.</p>
                  <p>Enjoy the rest of your day!</p>
                  <p>Kind Regards,</p>
                  <p>poanchen</p>
        ';
        $headers = array('Content-Type: text/html; charset=UTF-8');
        if (wp_mail($to, $subject, $body, $headers)) {
          error_log("email has been successfully sent to user whose email is " . $user_email);
        }else{
          error_log("email failed to sent to user whose email is " . $user_email);
        }
      }
    
      
}