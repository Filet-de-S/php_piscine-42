<?php

class NightsWatch {
	protected $_arr;

	function recruit ($obj) {
		if ($obj instanceof IFighter)
			$this->_arr[] = $obj;
	}
	function fight() {
		foreach ($this->_arr as $v) {
			$v->fight();
		}
	}
}

?>