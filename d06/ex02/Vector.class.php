<?php
require_once('Color.class.php');
require_once('Vertex.class.php');

class Vector {
	private $_x = 0;
	private $_y = 0;
	private $_z = 0;
	private $_w = 0;
	public static $verbose = FALSE;

	public function __construct (array $kwargs) {
		if (array_key_exists('dest', $kwargs) == TRUE) {
			$this->dest = $kwargs[dest];
		}
		else return FALSE;
		if (array_key_exists('orig', $kwargs) == TRUE)
			$this->orig = $kwargs[orig];
		else $this->orig = new Vertex(['x'=> 0, 'y'=>0, 'z'=>0, 'w'=>1]);
		if (self::$verbose == TRUE)
			printf("Vector( x:%4.2f, y:%4.2f, z:%4.2f, w:%4.2f ) constructed\n",
				$this->dest->_x, $this->dest->_y, $this->dest->_z, $this->dest->_w);
	}

	function magnitude() {
		$vect = ['x'=>($this->dest->_x - $this->orig->_x), 'y'=>($this->dest->_y - $this->orig->_y),
			'z'=>($this->dest->_z - $this->orig->_z)];
		return (sqrt(pow($vect[x], 2) + pow($vect[y], 2) + pow($vect[z], 2)));
	}

	function normalize() {
		$d  = sqrt(pow($vect[x], 2) + pow($vect[y], 2) + pow($vect[z], 2));
		return (new Vector(['dest'=>['x'=> $this->orig->_x / $d, 'y'=>$this->orig->_y / $d,
			'z'=>$this->orig->_z, 'w'=>$this->_w]]));
	}

	function add( Vector $rhs ) {
		$sum[x] = $this->dest->_x + $rhs->dest->_x;
		$sum[y] = $this->dest->_y + $rhs->dest->_y;
		$sum[z] = $this->dest->_z + $rhs->dest->_z;
		$sum[w] = $this->dest->_w + $rhs->dest->_w;
		return (new Vector(['dest'=>$sum]));
	}

	function sub ( Vector $rhs ) {
		$sub[x] = $this->dest->_x - $rhs->dest->_x;
		$sub[y] = $this->dest->_y - $rhs->dest->_y;
		$sub[z] = $this->dest->_z - $rhs->dest->_z;
		$sub[w] = $this->dest->_w - $rhs->dest->_w;
		return (new Vector(['dest'=>$sub]));
	}

	function opposite() {
		return (new Vector(['dest'=>['x'=> -($this->dest->_x), 'y'=>-($this->dest->_y),
			'z'=>-($this->dest->_z), 'w'=>$this->dest->_w]]));
	}

	function scalarProduct( $k ) {
		return (new Vector(['dest'=>['x'=>$this->dest->_x * $k, 'y'=>$this->dest->_y * $k,
			'z'=>$this->dest->_z * $k, 'w'=>$this->dest->_w]]));
	}

	function dotProduct( Vector $rhs ) {
		$dot = ($this->dest->_x * $rhs->dest->_x) + ($this->dest->_y * $rhs->dest->_y)
			+ ($this->dest->_z * $rhs->dest->_z);
		return ($dot);
	}

	function cos( Vector $rhs ) {
		$cos = ($this->dest->dotProduct($rhs)) / ($this->magnitude * $rhs->magnitude);
		return ($cos);
	}

	function crossProduct( Vector $rhs ) {
		echo "v razrabotke.........";
	}

	public function __toString() {
		return sprintf("Vector( x:%4.2f, y:%4.2f, z:%4.2f, w:%4.2f )",
			$this->dest->_x, $this->dest->_y, $this->dest->_z, $this->dest->_w);
	}

	public function __destructor() {
		if (self::$verbose == TRUE)
			printf("Vector( x:%4.2f, y:%4.2f, z:%4.2f, w:%4.2f ) destructed\n",
				$this->dest->_x, $this->dest->_y, $this->dest->_z, $this->dest->_w);
	}

	public static function doc() {
		$str = file_get_contents('Vector.doc.txt');
		return $str.PHP_EOL;
	}
}

?>	