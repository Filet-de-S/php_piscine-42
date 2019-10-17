<?php

abstract class Targaryen {
	function resistsFire() {}
	function getBurned() {
		return ($this->resistsFire() == NULL ? "burns alive" : "emerges naked but unharmed");
	}
}

?>