<?php
namespace App\Helpers;

use App\Models\SmsRecord;
use Auth;
use DB;
use SoapClient;
 
class SMSHelper {
    public static function sendSMS($mobile, $text, $messageLength) {
        $smsCount = (int) SmsRecord::where('is_send', 1)->sum('sms_count');
        $totalSms = (int) env('SMS_LIMIT');
		$smsBalance = $totalSms - $smsCount;
		
		$mobile = str_replace('-', '', trim($mobile));
		$mobile = str_replace('_', '', $mobile);

		$apiUrl = 'https://portal.adnsms.com/api/v1/secure/send-sms';

		if ($smsBalance > 0 && strlen($mobile) == 11 && strlen(trim($text)) > 2) {
			
			$data = [
				'api_key'      => 'KEY-s8fsan58aqsndxaxn00rv382nyl5gdu2',
				'api_secret'   => '9ll4BN95LB8GbXBO',
				'request_type' => 'single_sms',
				'message_type' => 'unicode',
				'mobile'       => $mobile,
				'message_body' => $text
			];
        
			$curl = curl_init();

			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt($curl, CURLOPT_URL, $apiUrl);
			curl_setopt($curl, CURLOPT_HEADER, 0);
			curl_setopt($curl, CURLOPT_TIMEOUT, 30);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

			$response = curl_exec($curl);
			
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
				//return "cURL Error #:" . $err;
				return 0;
			} else {
				//return $response;
				return 1;
			}
        }
    }
}