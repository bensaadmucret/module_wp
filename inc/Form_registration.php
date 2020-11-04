<?php

namespace App;

use CMB2;

class Form_registration
{
    public function __construct()
    {
        add_shortcode('user-registration', array($this,'user_registration' ));
    }
        

    public function user_registration() { ?>

<?php
 
  $key = get_option("pr_services");

      if($key['id_gravityform_inscription']){
          echo  do_shortcode('[gravityform id="'.$key['id_gravityform_inscription'].'" title="false" description="false" ajax="true"]');
      }  


 }
}
