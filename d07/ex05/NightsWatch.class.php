<?php

class NightsWatch {
	protected $_arr;

	function recruit ($obj) {
		$this->_arr[] = $obj;
	}
	function fight() {
		foreach ($this->_arr as $v) {
			if ($v instanceof IFighter)
				$v->fight();
		}
	}
}

?>