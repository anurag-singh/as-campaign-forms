<?php

/**
* Send SMS
*/
class As_SMS
{
	
	function send_sms() 
	{
		# code...
	
	// Get the form ID
	$campaignId = $_POST['campaignId'];
	$referralPage = $_POST['signupRefererral'];
	$leadMobile = get_post_meta($campaignId,'as_campaign_to_lead_sms_mobile_no', true);
	$inquirerName = $_POST['postTitle'];
	$inquirerMobile = $_POST['signupMobile'];
	$inquirerEmail = $_POST['signupEmail'];
	$inquirerRemark = $_POST['postContent'];

	// SMS API Variables
	$apiurl = 'http://www.myvaluefirst.com/smpp/sendsms?';
	$user = 'username=raghunandanhttp ';
	$pass = '&password=ragan123ttp ';
	$mobilePrefix = '&to=91';
	$sender = '&from=Rmoney';


	//SMS API Template

	// http://www.myvaluefirst.com/smpp/sendsms?username=raghunandanhttp &password=ragan123ttp &to=9319223394 &from=Rmoney &text=Lead we received from referral page-(V) , Name- (V) , Mobile–(V) , Email- (V) , Remarks–(V)

?>
    <iframe id="msgToInquer" style="display:none;"></iframe>
    <iframe id="msgToLead" style="display:none;"></iframe>

    <script>
        function sendSMStoInquirer() {

            var inquirerSms = '<?php echo $apiurl; ?>' + '<?php echo $user; ?>' + '<?php echo $pass; ?>' + '<?php echo $mobilePrefix; ?>' + '<?php echo $_POST["signupMobile"];?>' + '&from=Rmoney &text=Thank+you+for+your+interest+in+our+products+%26+services.+We+will+contact+you+shortly.+Raghunandan+Money+%23+09568-654321%7bv%7d';

            //console.log(inquirerSms);

            var iframe = $('#msgToInquer');
            if (iframe == null)
                alert("Sender Not Found");
            iframe.attr('src', inquirerSms);

            return true;
        }
        sendSMStoInquirer();

        function sendSMStoLead() {
            var leadsms = '<?php echo $apiurl; ?>' + '<?php echo $user; ?>' + '<?php echo $pass; ?>' + '<?php echo $mobilePrefix; ?>' + '<?php echo $leadMobile; ?>' + '&from=Rmoney &text=Lead we received from referral page- ' + '<?php echo $referralPage;?>' + ', Name- ' + '<?php echo $inquirerName;?>' + ', Mobile- ' + '<?php echo $inquirerMobile;?>' + ', Email- ' + '<?php echo $inquirerEmail;?>' + ', Remarks- ' + '<?php echo $inquirerRemark; ?>';

            //console.log(leadsms);

            var iframe = $('#msgToLead');
            iframe.attr('src', leadsms);
            return true;
        }
        sendSMStoLead();
    </script>
 
    <?php
    }
}
