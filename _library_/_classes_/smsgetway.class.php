<?php

namespace _classes_;
class smsgetway{
	private $config;
	private $url;
	
	function __construct(){
		/*global $config;
		$this->config=$config;
		$this->url =$this->config->smsurl."?username=".$this->config->smsusername."&password=".$this->config->smspassword;*/
	}
	
	/**
	 * 
	 * @param string $phone
	 * @param string $msg
	 */
	public function sendSms($phone,$msg){
		$url = $this->url."&msg=". urlencode($msg)."&to=". $phone ;
		
		// create curl resource
		$ch = curl_init();
		// set url
		curl_setopt($ch, CURLOPT_URL, $url);
		//return the transfer as a string
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// $output contains the output string
		$output = curl_exec($ch);
		// close curl resource to free up system resources
		curl_close($ch);
		$output = substr($output, 3);
		return $output;
	}
	
	/**
	 * sends same message in bulk
	 * @param array $arrayphone
	 * @param string $msg
	 */
	public function sendBulkSms($arrayphone,$msg){
		$returns =array();
		if(is_array($arrayphone)){
			foreach ($arrayphone as $phone){
				$returns[] =$this->sendSms($phone, $msg);
			}
		}else{
			$returns[] =$this->sendSms($phone, $msg);	
		}
		
		return $returns;
		
	}//end
        
        // tpoly sms
        public function sendSMS1($phone,$message){
            $phone="+233".\substr($phone,1,9);
            $url = 'http://txtconnect.co/api/send/'; 
            $fields = array( 
            'token' => \urlencode('a166902c2f552bfd59de3914bd9864088cd7ac77'), 
            'msg' => \urlencode($message), 
            'from' => \urlencode("TPOLY"), 
            'to' => \urlencode($phone), 
            );
            $fields_string = ""; 
                    foreach ($fields as $key => $value) { 
                    $fields_string .= $key . '=' . $value . '&'; 
                    } 
                    \rtrim($fields_string, '&'); 
                    $ch = \curl_init(); 
                    \curl_setopt($ch, \CURLOPT_URL, $url); 
                    \curl_setopt($ch, \CURLOPT_RETURNTRANSFER, true); 
                    \curl_setopt($ch, \CURLOPT_FOLLOWLOCATION, true); 
                    \curl_setopt($ch, \CURLOPT_POST, count($fields)); 
                    \curl_setopt($ch, \CURLOPT_POSTFIELDS, $fields_string); 
                    \curl_setopt($ch, \CURLOPT_SSL_VERIFYPEER, 0); 
                    $result = \curl_exec($ch); 
                    \curl_close($ch); 
                    $data = \json_decode($result); 
                    if($data->error == "0"){ 
                   $info="Message was successfully sent"; 
                  return $info;
                    }else{ 
                    $info="Message failed to send. Error: " . $data->error; 
                    return $info;
                    } 
                            
                  
                 }
                 
                 // bulk sms form tpoly
                 public function sendBulkSMS1($arrayphone,$msg){
		$returns =array();
		if(is_array($arrayphone)){
			foreach ($arrayphone as $phone){
				$returns[] =$this->sendSMS1($phone, $msg);
			}
		}else{
			$returns[] =$this->sendSMS1($phone, $msg);	
		}
		
		return $returns;
		
	}
}
?>