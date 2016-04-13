<?php

//require 'PHPMailer/PHPMailerAutoload.php';

/**
* Send email
*/
class As_Email
{
	
	

	public function send_email() {

		// Get the form ID
		$campaignId = $_POST['campaignId'];

	    // Lead notifications variables
	    $toLeadEmailId          = get_post_meta($campaignId, 'as_campaign_to_lead_email', true);
	    $toLeadEmailSubject     = get_post_meta($campaignId, 'as_campaign_to_lead_email_subject', true);
	    $toLeadEmailContent     = get_post_meta($campaignId, 'as_campaign_to_lead_email_content', true);
	    $toLeadSMSMobileNo      = '91'.get_post_meta($campaignId, 'as_campaign_to_lead_sms_mobile_no', true);

	    $toLeadSMSMobileContent = get_post_meta($campaignId, 'as_campaign_to_lead_sms_mobile_content', true);
	    $toLeadSMSMobileContent = str_replace(" ", "+", $toLeadSMSMobileContent);

	    // Inquirer variables
	    $inquirername           = $_POST['postTitle'];
	    $inquirerEmailId        = $_POST['signupEmail'];
	    if(isset($_POST['postContent'])) {
	    	$inquiryContent         = $_POST['postContent'];
	    }
	    else {
	    	$inquiryContent = NULL;
	    }

	    $referralPage           = $_POST['signupRefererral'];

	    $toInquirerEmailSubject        = get_post_meta($campaignId, 'as_campaign_to_inquirer_email_subject', true);
	    $toInquirerEmailContent        = get_post_meta($campaignId, 'as_campaign_to_inquirer_email_content', true);
	    $inquirerSMSMobileNo         = $_POST['signupMobile'];
	    $toInquirerSMSMobileContent = get_post_meta($campaignId, 'as_campaign_to_inquirer_sms_mobile_content', true);
	    //$toInquirerSMSMobileContent = str_replace(' ', '+', $toInquirerSMSMobileContent);
    
    

    $mailtoInquirer = new PHPMailer;

    $mailtoInquirer->isSMTP();                                      // Set mailer to use SMTP
    $mailtoInquirer->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mailtoInquirer->SMTPAuth = true;                               // Enable SMTP authentication
    $mailtoInquirer->Username = 'website@rmoneyindia.com';                 // SMTP username
    $mailtoInquirer->Password = 'L<CYMa8m';                           // SMTP password
    $mailtoInquirer->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mailtoInquirer->Port = 587;                                    // TCP port to connect to

    $mailtoInquirer->setFrom('website@rmoneyindia.com', 'Rmoney');
    $mailtoInquirer->addAddress($inquirerEmailId, 'Rmoney');        // Add a recipient
    $mailtoInquirer->addReplyTo('website@rmoneyindia.com', 'Rmoney');
    $mailtoInquirer->isHTML(true);                                  // Set email format to HTML

    $mailtoInquirer->Subject = $toInquirerEmailSubject;
    $mailtoInquirer->Body    = $toInquirerEmailContent;
    $mailtoInquirer->send();    // Send the email
    // if(!$mailtoInquirer->send()) {
    //     echo 'Message could not be sent.';
    //     echo 'Mailer Error: ' . $mailtoInquirer->ErrorInfo;
    // } else {
    //     echo 'Message has been sent';
    // }

    $mailtoLead = new PHPMailer;

    $mailtoLead->isSMTP();                                      // Set mailer to use SMTP
    $mailtoLead->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mailtoLead->SMTPAuth = true;                               // Enable SMTP authentication
    $mailtoLead->Username = 'website@rmoneyindia.com';                 // SMTP username
    $mailtoLead->Password = 'L<CYMa8m';                           // SMTP password
    $mailtoLead->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mailtoLead->Port = 587;                                    // TCP port to connect to

    $mailtoLead->setFrom('website@rmoneyindia.com', 'Rmoney');
    $mailtoLead->addAddress($toLeadEmailId, 'Rmoney');     // Add a recipient

    $mailtoLead->isHTML(true);                                  // Set email format to HTML

    $mailtoLead->Subject = $toLeadEmailSubject;
    $mailtoLead->Body    = $toLeadEmailContent.'<br><table class="rmoney-inquery">
                        <tr>
                          <td>Inquirer Name</td><td> : <td><td>'.$inquirername.'</td>
                        </tr>
                        <tr>
                          <td>Inquirer Mobile No</td><td> : <td><td>'.$inquirerSMSMobileNo.'</td>
                        </tr>
                        <tr>
                          <td>Inquirer Email Id</td><td> : <td><td>'.$inquirerEmailId.'</td>
                        </tr>
                        <tr>
                          <td>Inquiry</td><td> : <td><td>'.$inquiryContent.'</td>
                        </tr>
                        <tr>
                          <td>Referral Page</td><td> : <td><td>'.$referralPage.'</td>
                        </tr>
                      </table>';
    //$mailtoLead->AltBody = 'This is the body in plain text for non-HTML mail clients';

    //$mailtoLead->send();            // Send the email
    if(!$mailtoLead->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mailtoLead->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }

    }
}
