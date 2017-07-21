<?php

class FirebaseCloudMessaging {

	var $url = 'https://fcm.googleapis.com/fcm/send';
	var $serverApiKey = "";
	var $topic = "";
	
	function FirebaseCloudMessaging($apiKeyIn){
		$this->serverApiKey = $apiKeyIn;
	}
	
	function setTopic($topic_name) {
		$this->topic ="/topics/" . $topic_name;
	}
	
	function getTopic() {
		return $this->topic;
	}

	function send($data = array()){
		if (empty($this->topic)) {
			$this->error("No topic set");
		}
		
		if(strlen($this->serverApiKey) < 8){
			$this->error("Server API Key not set");
		}
		
		$fields = array(
			'to'   => $this->topic,
			'data' => $data,
		);
		
		$headers = array( 
			'Authorization: key=' . $this->serverApiKey,
			'Content-Type: application/json'
		);

		// Open connection
		$ch = curl_init();
		
		// Set the url, number of POST vars, POST data
		curl_setopt( $ch, CURLOPT_URL, $this->url );
		
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		
		// Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		
		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
		
		// Execute post
		$result = curl_exec($ch);
		
		// Close connection
		curl_close($ch);
		
		return $result;
	}
	
	function error($msg){
		echo "Android notification failed with error:";
		echo "\t" . $msg;
		exit(1);
	}
}
