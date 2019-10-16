<?php

class Color {
    public $r = 0;
    public $g = 0;
    public $b = 0;
	public static $verbose = FALSE;

	public function __construct(array $kwargs) {
		if (array_key_exists('rgb', $kwargs) === TRUE) {
			$this->r = ($kwargs[rgb] >> 16) & 0xff;
			$this->g = ($kwargs[rgb] >> 8) & 0xff;
			$this->b = ($kwargs[rgb]) & 0xff;
		}
		else {
			$this->r = intval($kwargs[red], 0);
			$this->g = intval($kwargs[green], 0);
			$this->b = intval($kwargs[blue], 0);
		}
		if (self::$verbose == TRUE) {
			print("Color( red: ".str_pad($this->r, 3, " ", STR_PAD_LEFT).", green: " .
			str_pad($this->g, 3, " ", STR_PAD_LEFT).", blue: ".str_pad($this->b, 3, " ", STR_PAD_LEFT)." ) constructed.\n");
		}
	}

	public function __toString() {
		return ("Color( red: ".str_pad($this->r, 3, " ", STR_PAD_LEFT).", green: " .
		str_pad($this->g, 3, " ", STR_PAD_LEFT).", blue: ".str_pad($this->b, 3, " ", STR_PAD_LEFT)." )");
	}
	
	public function __destruct() {
		if (self::$verbose == TRUE) {
			print("Color( red: ".str_pad($this->r, 3, " ", STR_PAD_LEFT).", green: " .
			str_pad($this->g, 3, " ", STR_PAD_LEFT).", blue: ".str_pad($this->b, 3, " ", STR_PAD_LEFT)." ) destructed.\n");
		}
	}

	public static function doc() {
		$str = file_get_contents('Color.doc.txt');
		return $str.PHP_EOL;
	}
	
	public function add( Color $rhs ) {
		$new['red'] = $this->r + $rhs->r;
		$new['green'] = $this->g + $rhs->g; 
		$new['blue'] = $this->b + $rhs->b;
		return (new Color($new));
	}

	public function sub( Color $rhs ) {
		$new['red'] = $this->r - $rhs->r;
		$new['green'] = $this->g - $rhs->g; 
		$new['blue'] = $this->b - $rhs->b;
		return (new Color($new));
	}
	public function mult( $f ) {
		$new['red'] = $this->r * $f;
		$new['green'] = $this->g * $f; 
		$new['blue'] = $this->b * $f;
		return (new Color($new));
	}
}

?>
