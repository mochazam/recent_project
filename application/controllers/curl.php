<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Curl extends CI_controller 
{

	public function __construct() {
        parent::__construct();       
		$this->load->library('Curl'); 
    }
 
    function index() {
       
    }

    function req_post() {
    	//Request using POST Method
   		$url = 'http://postexample.com/json.php';       
   		echo $this->curl->simple_post($url, false, array(CURLOPT_USERAGENT => true));
    }

    function req_get() {
    	//Request using GET Method
   		$get_url = 'http://getexample.com/json.php';  
   		echo $this->curl->simple_get($get_url, false, array(CURLOPT_USERAGENT => true)); 
    }

    function fetch_json_url(){

	 	$url = 'https:/example.com/testjson';

	   	$username = 'your username';

	   	$password = 'your password';

		// Initialize session and set URL.

		$ch = curl_init();

		// Set URL to download

		curl_setopt($ch, CURLOPT_URL, $url);

		// Include header in result? (0 = yes, 1 = no)

		curl_setopt($ch, CURLOPT_HEADER, 0);

		//Set content Type

		curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-type: application/json'));

		// Should cURL return or print out the data? (true = return, false = print)

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");

		//to blindly accept any server certificate, without doing any verification //optional

	   	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	   	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

		//The most important is

		curl_setopt($ch, CURLOPT_SSLVERSION, 3);

		// Download the given URL, and return output

		$result = curl_exec($ch);

		// Close the cURL resource, and free system resources

		curl_close($ch);

		$data = json_decode($result, true);

		print_r($data);

	}

}	