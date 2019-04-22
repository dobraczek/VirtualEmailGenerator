<?php

/**
 * User Virtual Generator
 * @author Dobr@CZek
 * @link http://webscript.cz
 * @version 1.0
 */

namespace VirtualUserGenerator;
include "UserVirtual.php";
class UserGenerator {
	public function getUser(): User {
		return new User();
	}
}
?>
