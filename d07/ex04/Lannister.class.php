<?php

class Lannister {
	function sleepWith($nameObj) {
		$name = get_class($nameObj);
		switch($name) {
			case "Tyrion": echo "Not even if I'm drunk !\n";break;
			case "Sansa": echo "Let's do this.\n";break;
			case "Cersei": echo "With pleasure, but only in a tower in Winterfell, then.\n";break;
			case "Lannister": echo "Em....what stops you, lord?\n";break;
		}
	}
}

?>