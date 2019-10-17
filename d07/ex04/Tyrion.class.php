<?php

class Tyrion {
	function sleepWith($nameObj) {
		$name = get_class($nameObj);
		switch($name) {
			case "Jaime": { echo "Not even if I'm drunk !\n";break; }
			case "Sansa": { echo "Let's do this.\n";break; }
			case "Cersei": { echo "Not even if I'm drunk !\n";break;}
			case "Tyrion": { echo "Em....what stops you, lord?\n";break; }
		}
	}
}

?>