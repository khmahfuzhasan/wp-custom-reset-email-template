<?php 

/*
Plugin Name: WP custom Reset Email Template
Plugin URI: https://github.com/khmahfuzhasan/wp-custom-reset-email-template
Version: 1.0.0
Author: Khandaker Mahfuz Hasan
Author URI: https://showrav.com/
License: GPLv2 or Later
Text Domain: wp-custom-reset-email-template
Domain Path: /languages/
*/

function email_set_content_type(){
return "text/html";
}
add_filter( 'wp_mail_content_type','email_set_content_type' );

//* Password reset activation E-mail -> Body
add_filter( 'retrieve_password_message', 'wpse_retrieve_password_message', 10, 3 );
function wpse_retrieve_password_message( $message, $key, $user_login ){
    $site_name  = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
	$reset_link = network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' );
	$domainName = $_SERVER['SERVER_NAME'];
	$link_color = '#000';
    
    return'<table style="margin: auto;width: 100%;padding: 20px;" bgcolor="#eeeeee">
    <tr><td width="100%" valign="top" height="20" bgcolor="#eeeeee" align="center"></td></tr>
    <tr>
        <td style="padding:0px 15px 0px 15px" bgcolor="#eeeeee" align="center">
            <table style="max-width:600px;margin: auto;padding: 15px;" width="100%;background-color: #fff;" cellspacing="0" cellpadding="0" border="0" bgcolor="#fff">
                <tbody>
                    <tr>
                        <td style="padding:40px 40px 0 40px; text-align: center;" align="center"><a style="text-decoration: none;font-weight: bold;text-transform: uppercase;font-size: 36px;color: '. $link_color .';" href="'.network_home_url("/") .'">'. $domainName .'</a></td>
                    </tr>
                    <tr>
                        <td style="font-size:18px;color:#0e0e0f;font-weight:700;line-height:28px;vertical-align:top;text-align:center;padding:35px 40px 0px 40px" align="center">
                            <strong>Reset Your Password</strong></td>
                    </tr>
                    <tr>
                        <td style="padding:40px 40px 5px;" width="100%;" valign="top" height="1" bgcolor="#ffffff" align="center"><div style="border-top:1px solid #e4e4e4;" ></div></td>
                    </tr>
                    <tr>
                        <td style="font:16px/22px">
                            <p>Hi '. $user_login .',<br>To set up a new password to your <span><a style="text-decoration: none;font-weight: bold;color:#000;" href="'.network_home_url("/") .'">'. $domainName .'</a></span> account, click "<span>Reset</span> Your Password" below, or use this link:<br></p><span><a style="text-decoration: none;font-weight: normal;text-transform: lowercase;color: '. $link_color .';" href="'.  $reset_link .'">'. $reset_link .'</a></span>
                            <span class="im"><p>If nothing happens after clicking, copy, and paste the link in your browser.</p></span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:40px 40px 5px;" width="100%;" valign="top" height="1" bgcolor="#ffffff" align="center"></td>
                    </tr>
                    <tr>
                        <td align="center"><a style="color:#ffffff;background-color: '. $link_color .';display:inline-block;font-family:Helvetica Neue;font-size:16px;line-height:30px;text-align:center;font-weight:bold;text-decoration:none;padding:5px 20px;border-radius:3px;text-transform:none" href="'. $reset_link .'" target="_blank"><span>Reset</span> Your Password</a></td>
                    </tr>
                    <tr>
                        <td style="font:16px/22px">
                            <p> Thanks, <br> <span><a style="text-decoration: none;font-weight: bold;color:#000;" href="'.network_home_url("/") .'">'. $domainName .'</a></span></p>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </td>
    </tr>
    <tr><td width="100%" valign="top" height="20" bgcolor="#eeeeee" align="center"></td></tr>
</table>';
}