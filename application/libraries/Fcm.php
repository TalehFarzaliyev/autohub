<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Fcm{
	
	public $server_key;
	public $url;

	public function __construct()
	{
		$this->load->config('fcm', TRUE);
		$this->server_key = $this->config->item('fcm_server_key', 'fcm');
		$this->url = $this->config->item('fcm_api', 'fcm');
	}

	public function __get($var)
	{
		return get_instance()->$var;
	}

	public function send($target, $data)
	{
		$fields = array();
		$fields['data'] = $data;
		
		$fields['priority'] = "high";
		$fields['time_to_live']	= 30;

		if(is_array($target))
		{
			$fields['registration_ids'] = $target;
		}
		else
		{
			$fields['to'] = $target;
	   	}
	   	$headers = array(
	   		'Content-Type:application/json',
	        'Authorization:key='.$this->server_key
	    );


	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $this->url);
	    curl_setopt($ch, CURLOPT_POST, true);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
	    $result = curl_exec($ch);
	    curl_close($ch);
	}

	public function subscribe($token, $topic)
	{
		$headers = array(
	   		'Content-Type:application/json',
	        'Authorization:key='.$this->server_key
	    );


	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, 'https://iid.googleapis.com/iid/v1/'.$token.'/rel/topics/'.$topic);
	    curl_setopt($ch, CURLOPT_POST, true);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    $result = curl_exec($ch);
	    if ($result === FALSE)
	    {
	    	die('Oops! FCM Send Error: ' . curl_error($ch));
	    }
	    curl_close($ch);
	    return $result;
	}

}
?>