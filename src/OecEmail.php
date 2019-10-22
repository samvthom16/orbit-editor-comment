<?php

class OecEmail extends Singleton
{
	function __construct()
	{
		//action hook to be used by wp_schedule_single_event
		//add_action( 'oec_cron_mail', array($this, 'oec_cron_mail'), 10, 4 );
	}

	/**
	 * action hook callback function
	 *
	 **/
	function oec_cron_mail($to, $subject, $body, $header)
	{
		wp_mail($to, $subject, $body, $header);
	}
	
	/**
	 * 
	 * Use this function to schedule email. 
	 *
	 **/
	/*function scheduleEmail($to, $subject, $body, $header)
	{
		$args = array(
				'to'		=> $to,
				'subject'	=> $subject,
				'body'		=> $body,
				'header'	=> $header	
			);
			
		if(!wp_next_scheduled( 'oec_cron_mail' )){
			wp_schedule_single_event( time(), 'oec_cron_mail', $args );
		}
	}*/

	
	function emailNotification($userID, $postID, $comment) 
	{
		$postTitle   = get_the_title($postID); 
		$authorID 	 = get_post_field( 'post_author', $postID );
		$authorEmail = get_the_author_meta('user_email', $authorID);

		if($userID == $authorID) {
			$to = "jaydroid007@gmail.com";
			//$to = "editor@youthkiawaaz.com";
			$name = "Admin";
		} else {
			$to = $authorEmail;
			$name = get_the_author_meta('display_name', $authorID);
		}


		$subject = 'Editor\'s Comment: New Message';
		$body 	 = "Hi $name,<br/>Your Article: $title has recieved following feedback message:<br> $comment";
		$headers = array('Content-Type: text/html; charset=UTF-8');

		//$this->scheduleEmail( $to, $subject, $body, $headers );

		if(function_exists('yka_mail')) {
			yka_mail( $to, $subject, $body, $headers );
		} else {
			wp_mail( $to, $subject, $body, $headers );
		}
	}

}

//global instance variable for OecMain class
global $oecMail;

$oecMail = OecEmail::getInstance();

