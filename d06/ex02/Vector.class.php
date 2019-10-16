<?php
require_once('Color.class.php');
require_once('Vertex.class.php');

class Vector {
	private $_x = 0;
	private $_y = 0;
	private $_z = 0;
	private $_w = 0.0;
	public static $verbose = FALSE;

	public function __construct (array $kwargs) {
		if (array_key_exists('dest', $kwargs) == TRUE &&
				array_key_exists('orig', $kwargs) == TRUE) {
			$this->_x = $kwargs[dest]->_x - $kwargs[orig]->_x;
			$this->_y = $kwargs[dest]->_y - $kwargs[orig]->_y;
			$this->_z = $kwargs[dest]->_z - $kwargs[orig]->_z;
			$this->_w = $kwargs[dest]->_w - $kwargs[orig]->_w;
		}
		elseif (array_key_exists('dest', $kwargs) == TRUE) {
			$vtx = new Vertex(['x'=>0,'y'=>0,'z'=>0]);
			$this->_x = $kwargs[dest]->_x;
			$this->_y = $kwargs[dest]->_y;
			$this->_z = $kwargs[dest]->_z;
			$this->_w = 0;
		}
		else return FALSE;
		if (self::$verbose == TRUE)
			printf("$this constructed\n");
	}

	function magnitude() {
		return (sqrt(pow($this->_x, 2) + pow($this->_y, 2) + pow($this->_z, 2)));
	}

	function normalize() {
		$d  = sqrt(pow($this->_x, 2) + pow($this->_y, 2) + pow($this->_z, 2));
		$res =($this->_z / $d);
		$vtx = new Vertex([ 'x' => ($this->_x / $d), 'y' => ($this->_y / $d), 'z' => ($this->_z / $d) ]);
		return (new Vector (['dest' => $vtx]));
	}

	function add( Vector $rhs ) {
		$vtx = new Vertex(['x' => ($this->_x + $rhs->_x), 'y' => ($this->_y + $rhs->_y), 
			'z' => ($this->_z + $rhs->_z)]);
		return (new Vector(['dest'=> $vtx]));
	}

	function sub ( Vector $rhs ) {
		$x = $this->_x - $rhs->_x;
		$y = $this->_y - $rhs->_y;
		$z = $this->_z - $rhs->_z;
		$sub = new Vertex(['x'=>$x, 'y'=>$y, 'z'=>$z]);
		return (new Vector(['dest'=> $sub]));
	}

	function opposite() {
		$vtx = new Vertex(['x' => -($this->_x), 'y' => -($this->_y), 'z' => -($this->_z), 'w' => ($this->_w)]);
		return (new Vector(['dest' => $vtx]));
	}

	function scalarProduct( $k ) {
		$vtx = new Vertex(['x'=>$this->_x * $k, 'y'=>$this->_y * $k, 'z'=>$this->_z * $k, 'w'=>$this->_w]);
		return (new Vector(['dest'=> $vtx]));
	}

	function dotProduct( Vector $rhs ) {
		$dot = ($this->_x * $rhs->_x) + ($this->_y * $rhs->_y)
			+ ($this->_z * $rhs->_z);
		return ($dot);
	}

	function cos( Vector $rhs ) {
		$cos = ($this->dotProduct($rhs)) / ($this->magnitude() * $rhs->magnitude());
		return ($cos);
	}

	function crossProduct( Vector $rhs ) {
		$cross[x] = ($this->_y * $rhs->_z) - ($this->_z * $rhs->_y);
		$cross[y] = ($this->_z * $rhs->_x) - ($this->_x * $rhs->_z);
		$cross[z] = ($this->_x * $rhs->_y) - ($this->_y * $rhs->_x);
		return (new Vector(['dest'=> new Vertex($cross)]));
	}

	public function __toString() {
		return sprintf("Vector( x:%4.2f, y:%4.2f, z:%4.2f, w:%4.2f )",
			$this->_x, $this->_y, $this->_z, $this->_w);
	}

	public function __destruct() {
		if (self::$verbose == TRUE)
			printf("$this destructed\n");
		}

	public static function doc() {
		$str = file_get_contents('Vector.doc.txt');
		return $str.PHP_EOL;
	}

	function __get($name) {
		return ($this->$name);
	}
}

?>	