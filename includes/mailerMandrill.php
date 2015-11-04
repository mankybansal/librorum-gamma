<?php

require_once 'src/Mandrill.php';

$whitelist = array( '127.0.0.1', '::1' );
	
if(in_array( $_SERVER['REMOTE_ADDR'], $whitelist) )
{
	// DO NOT SEND MAIL FOR LOCALHOST
	function sendMail($body, $subject, $from, $to, $toName)
	{
		//DO NOTHING
	}
	
	function standardMailer($logo, $body)
	{
		//DO NOTHING
	}
}
else
{
	function sendMail($body, $subject, $from, $to, $toName)
	{	
		$mandrill = new Mandrill('BS0DesPYJDbaKVqri4Ot6A');
		$message = array(
			'html' => $body,
			'subject' => $subject,
			'from_email' => $from.'@librorum.in',
			'from_name' => 'Librorum '.ucfirst($from),
			'to' => array(
				array(
					'email' => $to,
					'name' => $toName,
					'type' => 'to'
				)
			),
			'headers' => array('Reply-To' => 'help@librorum.in'),
			'important' => true
		);
		$mandrill->messages->send($message);
	}
	
	function standardMailer($logo, $body)
	{

		$MAIL = "<html style='min-width: 300px; '>
		
					<div style='width: 100%; height: 85px; background: #DDD;'>
						<div style='height: 60px; width: 200px; float: left; margin-left: 30px; margin-top: 15px;'>
						<img src='http://librorum.in/images/logos/".$logo.".png' style='width: 190px; height: 40px;'>
						</div>
					</div>
					
					<div style='width: 100%; height: 10px; background: #333'></div>
					
					<div style='width: 100%; background: #759E2F;   min-height: 200px; padding: 20px 0px 20px 0px;'>
						<div style='width: 70%; padding: 30px; min-height: 160px; margin: 0 auto; border-radius: 20px;  background: #DDD;'>
						<text style='font-family: Calibri; color: black; font-size: 20px;'>
						".$body." 
						<br><br>
						Sincerely,<br>
						<strong>The Librorum Team</strong>
						</text><br>
						</div>
					</div>
					
					<div style='width: 100%; height: 10px; background: #333'></div>
					</text>
					
					<div style='width: 100%; display: block; background: #DDD;  text-align: center;  padding: 5px 5px 5px 5px;'>
						<br>
						<text style='color: #333; font-family: Calibri; font-size: 15px;'>
						Handmade with &hearts; in Namma Bengaluru<br>
						</text>
						<text style='color: #333; font-family: Calibri; font-size: 18px;'>
							MMXIV &copy; Copyright Librorum. All Rights Reserved.
							</text>
						<div style='display: block; width: 100%; height: 10px;'>
						</div>
					</div>	

				</html>";
		return $MAIL;
	}

}






?>