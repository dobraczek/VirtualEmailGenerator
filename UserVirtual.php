<?php

/**
 * User Virtual Generator
 * @author Dobr@CZek
 * @link http://webscript.cz
 * @version 1.0
 */

namespace VirtualUserGenerator;

class User {
    
	public $avatar;
	public $name;
	public $age;
	public $country;
	public $email;
	
	public function __construct() {
	    $fakeData = json_decode($this->file_get_contents_curl('http://webscript.cz/people.php?nocache='.rand(0, 99999)));
		$this->avatar = 'http://webscript.cz/photo.php?nocache='.rand(0, 99999);
	    $this->name = $fakeData->name.' '.$fakeData->surname;
		$this->age = rand(rand(7, 17), rand(59, 89));
		$this->country = $fakeData->region;
		$this->email = $this->getEmail($fakeData->name, $fakeData->surname);
	}
	
	private function file_get_contents_curl($url) {
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    $data = curl_exec($ch);
	    curl_close($ch);
	    return $data;
	}
	
	private function getEmail($firstName, $lastName) {
		$prefix = [
			$firstName.'.'.rand(0, 199),
			$lastName.'.'.rand(0, 99),
			$firstName.'.'.$lastName,
			mb_strtolower($firstName).$lastName,
		];
		$emailProviders = [
			'yahoo.com',
			'gmail.com',
			'email.com',
			'yandex.com',
		];
		return $prefix[array_rand($prefix)].'@'.$emailProviders[array_rand($emailProviders)];
	}
}
?>
