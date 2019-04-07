<?php

/**
 * User Virtual Generator
 * @author Martin Dobry
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
	    $fakeData = json_decode($this->file_get_contents_curl('http://webscipt.cz/people.php'));
		$this->avatar = 'http://webscipt.cz/avatar.php?nocache='.rand(0, 99999);
	    $this->name = $fakeData->name.' '.$fakeData->surname;
		$this->age = rand(rand(7, 17), rand(59, 89));
		$this->country = $fakeData->region;
		$this->email = $this->getEmail($this->cs_utf2ascii($fakeData->name), $this->cs_utf2ascii($fakeData->surname));
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
	
	private function cs_utf2ascii($s) {
    	static $tbl = array("\xc3\xa1"=>"a","\xc3\xa4"=>"a","\xc4\x8d"=>"c","\xc4\x8f"=>"d","\xc3\xa9"=>"e",
    			"\xc4\x9b"=>"e","\xc3\xad"=>"i","\xc4\xbe"=>"l","\xc4\xba"=>"l","\xc5\x88"=>"n","\xc3\xb3"=>"o",
    			"\xc3\xb6"=>"o","\xc5\x91"=>"o","\xc3\xb4"=>"o","\xc5\x99"=>"r","\xc5\x95"=>"r","\xc5\xa1"=>"s",
    			"\xc5\xa5"=>"t","\xc3\xba"=>"u","\xc5\xaf"=>"u","\xc3\xbc"=>"u","\xc5\xb1"=>"u","\xc3\xbd"=>"y",
    			"\xc5\xbe"=>"z","\xc3\x81"=>"A","\xc3\x84"=>"A","\xc4\x8c"=>"C","\xc4\x8e"=>"D","\xc3\x89"=>"E",
    			"\xc4\x9a"=>"E","\xc3\x8d"=>"I","\xc4\xbd"=>"L","\xc4\xb9"=>"L","\xc5\x87"=>"N","\xc3\x93"=>"O",
    			"\xc3\x96"=>"O","\xc5\x90"=>"O","\xc3\x94"=>"O","\xc5\x98"=>"R","\xc5\x94"=>"R","\xc5\xa0"=>"S",
    			"\xc5\xa4"=>"T","\xc3\x9a"=>"U","\xc5\xae"=>"U","\xc3\x9c"=>"U","\xc5\xb0"=>"U","\xc3\x9d"=>"Y",
    			"\xc5\xbd"=>"Z");
    	return strtr($s, $tbl);
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