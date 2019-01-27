<?php

class Openplatform {

	public $user = null;

	public function authorization($op_url) {

		$op = new Openplatform();
		$op->user = $this->curl($op_url);

		if($op->user->id) {

			$op->get_users();
			$op->get_apps();

			return $op->user->profile;

		} else {
			return false;
		}
	}

	public function get_users() {
		if($this->user) {
			$this->user->profile->users = $this->curl($this->user->users);
		}
	}

	public function get_apps() {
		if($this->user) {
			$this->user->profile->apps = $this->curl($this->user->apps);
		}
	}

	private function curl($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);

		$response = curl_exec($ch);

		$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$header = substr($response, 0, $header_size);
		$body = substr($response, $header_size);
        curl_close($ch);

        return json_decode($body);
	}
}