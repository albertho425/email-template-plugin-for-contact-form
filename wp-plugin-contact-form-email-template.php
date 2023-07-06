<?php 
/**
* Plugin Name: Maple Syrup Web Email Template
* Plugin URI: https://maplesyrupweb.com
* Description: Email Template for Contact forms.  To be used together with Maple Syrup Web Contact Form
* Version: 0.0.1
* Author: Maple Syrup Web
* Author URI: https://maplesyrupweb.com
**/

/**
 *  Format text email to HTML email
 */

function maplesyrupweb_content_filter()
{
	return "text/html";
}

/**
 *   Replace the message placeholder with the actual message and template
 */

function maplesyrupweb_email_filter($args)
{

    // call the email template function
	$template = maplesyrupweb_email_template();

  
    $args['message'] = str_replace("[message]",$args['message'],$template);
    

	add_filter('wp_mail_content_type','maplesyrupweb_content_filter');

	return $args;
}
// wp_mail function, callback function, default priority is 10, 1 the number of arguments
add_filter('wp_mail','maplesyrupweb_email_filter',10,1);

/**
 *  Template that contains markup, styling and body of the email.  Returns the HTML content of the email.
 */

function maplesyrupweb_email_template()
{
	$html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml">
       <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Maple Syrup Web</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="css/style.css">
      </head>';

  $html .= '<body class="body"><table class="table">';  
  $html .= '<tr><td></td></tr>';
  $html .= '<tr><td>';
  //email message is here
  $html .= '[message]';
  $html .= '</td></tr>';
  $html .= '<tr><td>';
  $html .= '&copy; '.date("Y").' Maple Syrup Web';          
  $html .= '</td></tr></table></body></html>';
  
  return $html; 
}

$plugin_url  = plugin_dir_url( __FILE__ );
wp_enqueue_style('msw_contact_email_template_css', $plugin_url . 'css/style.css');    
wp_enqueue_script('msw_contact_email_template_js', $plugin_url . 'js/script.js');    



?>
