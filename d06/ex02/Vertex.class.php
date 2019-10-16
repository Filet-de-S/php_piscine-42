<?php
require_once('Color.class.php');

class Vertex {

	private $_x = 0.0;
	private $_y = 0.0;
	private $_z = 0.0;
	private $_w = 1.00;
	private $_color;
	public static $verbose = FALSE;

	public function array_keys_exists($keys, $array){
		foreach($keys as $key){
			if(array_key_exists($key, $array) == FALSE)
				return FALSE;
		}
		return TRUE;
	}

	public function __construct (array $kwargs) {
		if ($this->array_keys_exists(['x', 'y', 'z'], $kwargs) == TRUE) {
			$this->_x = $kwargs['x'];
			$this->_y = $kwargs['y'];
			$this->_z = $kwargs['z'];
			if (array_key_exists('w', $kwargs) == TRUE)
				$this->_w = $kwargs[w];
			else $this->_w = 1.00;
			if (array_key_exists('color', $kwargs) == TRUE)
				$this->_color = $kwargs['color'];
			else $this->_color =  new Color(array('rgb' => 0xffffff));
		}
		else
			return ("x, y, z –– must present in array");
		if (self::$verbose == TRUE) {
			printf("Vertex( x:%5.2f, y:%5.2f, z:%4.2f, w:%4.2f, %s ) constructed\n", $this->_x, 
			$this->_y, $this->_z, $this->_w, $this->_color);
		}
	}
	
	public function __toString() {
		if (self::$verbose == TRUE)
			return sprintf("Vertex( x:%5.2f, y:%5.2f, z:%4.2f, w:%4.2f, %s )", $this->_x, 
			$this->_y, $this->_z, $this->_w, $this->_color);
		return sprintf("Vertex( x:%5.2f, y:%5.2f, z:%4.2f, w:%4.2f )", $this->_x, 
		$this->_y, $this->_z, $this->_w);
	}

	public function __destruct() {
		if (self::$verbose == TRUE) {
			printf("Vertex( x:%5.2f, y:%5.2f, z:%4.2f, w:%4.2f, %s ) destructed\n", $this->_x, 
			$this->_y, $this->_z, $this->_w, $this->_color);
		}
	}

	public static function doc() {
		$str = file_get_contents('Vertex.doc.txt');
		return $str.PHP_EOL;
	}
}

?>