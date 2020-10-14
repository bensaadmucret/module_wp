<?php

namespace App;

class Form_registration{


    public function __construct()
    {        
        add_shortcode( 'user-registration', array($this,'user_registration' ));   
    }
        

function user_registration() { ?>
<div class="user-registration ur-frontend-form  " id="user-registration-form-274">
    <form method="post" class="register" data-form-id="274" data-enable-strength-password=""
        data-minimum-password-strength="3" novalidate="novalidate">

        <div class="ur-form-row">
            <div class="ur-form-grid ur-grid-1" style="width:99%">
                <div data-field-id="user_login" class="ur-field-item field-user_login ">
                    <div class="form-row validate-required" id="user_login_field" data-priority=""><label
                            for="user_login" class="ur-label">Username <abbr class="required"
                                title="required">*</abbr></label><input data-rules="" data-id="user_login" type="text"
                            class="input-text input-text ur-frontend-field  " name="user_login" id="user_login"
                            placeholder="" value="" required="required" data-label="Username"></div>
                </div>
                <div data-field-id="user_email" class="ur-field-item field-user_email ">
                    <div class="form-row validate-required" id="user_email_field" data-priority=""><label
                            for="user_email" class="ur-label">User Email <abbr class="required"
                                title="required">*</abbr></label><input data-rules="" data-id="user_email" type="email"
                            class="input-text input-email ur-frontend-field  " name="user_email" id="user_email"
                            placeholder="" value="" required="required" data-label="User Email"></div>
                </div>
                <div data-field-id="user_pass" class="ur-field-item field-user_pass ">
                    <div class="form-row validate-required hide_show_password" id="user_pass_field" data-priority="">
                        <label for="user_pass" class="ur-label">User Password <abbr class="required"
                                title="required">*</abbr></label><span class="password-input-group"><input data-rules=""
                                data-id="user_pass" type="password"
                                class="input-text input-password ur-frontend-field  " name="user_pass" id="user_pass"
                                placeholder="" value="" required="required" data-label="User Password"></span></div>
                </div>
                <div data-field-id="user_confirm_password" class="ur-field-item field-user_confirm_password ">
                    <div class="form-row validate-required hide_show_password" id="user_confirm_password_field"
                        data-priority=""><label for="user_confirm_password" class="ur-label">Confirm Password <abbr
                                class="required" title="required">*</abbr></label><span
                            class="password-input-group"><input data-rules="" data-id="user_confirm_password"
                                type="password" class="input-text input-password ur-frontend-field  "
                                name="user_confirm_password" id="user_confirm_password" placeholder="" value=""
                                required="required" data-label="Confirm Password"></span></div>
                </div>
            </div>
        </div>
        <div class="ur-button-container ">

            <button type="submit" class="btn button ur-submit-button ">
                <span></span>Submit </button>
        </div>
        <div style="clear:both"></div>
        <input type="hidden" name="ur-user-form-id" value="274">
        <input type="hidden" name="ur-redirect-url" value="">
        <input type="hidden" id="ur_frontend_form_nonce" name="ur_frontend_form_nonce" value="d66c8e3c63">
    </form>
    <div style="clear:both"></div>
</div>

<?php }
}