<?php
// application/models/PackModel.class.php

class PackModel extends Model {
	function getAllIconPacks() {

		$url = 'https://flurly.com/api/store_details/22over7';
		$cURL = curl_init();
		curl_setopt($cURL, CURLOPT_URL, $url);
		curl_setopt($cURL, CURLOPT_HTTPGET, true);
		curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($cURL, CURLOPT_HTTPHEADER, [
		    'Content-Type: application/json',
		    'Accept: application/json'
		]);

		$result = curl_exec($cURL);
		curl_close($cURL);

		return json_decode($result, true);
	}
}