<?php
require_once ('Color.class.php');
require_once ('Vertex.class.php');
require_once ('Vector.class.php');

class Matrix {
	const IDENTITY = "IDENTITY";
	const SCALE = "SCALE";
	const RX = "Ox ROTATION";
	const RY = "Oy ROTATION";
	const RZ = "Oz ROTATION";
	const TRANSLATION = "TRANSLATION";
	const PROJECTION = "PROJECTION";
	static $verbose = FALSE;
    private $_vtcX;
    private $_vtcY;
    private $_vtcZ;
    private $_vtxO;

	private function array_keys_exists($keys, $array){
		foreach($keys as $key){
			if(array_key_exists($key, $array) == FALSE)
				return FALSE;
		}
		return TRUE;
	}

	private function zeromatr() {
	    $this->_vtcX = new Vector(['dest'=>new Vertex(['x'=>0.0, 'y'=>0.0, 'z'=>0.0])]);
        $this->_vtcY = new Vector(['dest'=>new Vertex(['x'=>0.0, 'y'=>0.0, 'z'=>0.0])]);
        $this->_vtcZ = new Vector(['dest'=>new Vertex(['x'=>0.0, 'y'=>0.0, 'z'=>0.0])]);
		$this->_vtxO = new Vertex(['x'=>0.0, 'y'=>0.0, 'z'=>0.0]);
    }

	private function matr() {
	    $this->_vtcX = new Vector(['dest'=>new Vertex(['x'=>1.0, 'y'=>0.0, 'z'=>0.0])]);
        $this->_vtcY = new Vector(['dest'=>new Vertex(['x'=>0.0, 'y'=>1.0, 'z'=>0.0])]);
        $this->_vtcZ = new Vector(['dest'=>new Vertex(['x'=>0.0, 'y'=>0.0, 'z'=>1.0])]);
		$this->_vtxO = new Vertex(['x'=>0.0, 'y'=>0.0, 'z'=>0.0]);
    }

	function __construct(array $kwargs) {
		if (array_key_exists('preset', $kwargs) == TRUE && $kwargs[preset] != "")
		{
            $this->matr();
            switch($kwargs[preset]) {
				case Matrix::SCALE:{
					$this->_vtcX->_x *= $kwargs[scale];
					$this->_vtcY->_y *= $kwargs[scale];
					$this->_vtcZ->_z *= $kwargs[scale];
                    break;
                }
                case Matrix::IDENTITY:{
                    break;
				}
				case Matrix::TRANSLATION:{
					$this->_vtxO->_x += $kwargs[vtc]->_x;
					$this->_vtxO->_y += $kwargs[vtc]->_y;
					$this->_vtxO->_z += $kwargs[vtc]->_z;
                    break;
				}
				case Matrix::RX:{
					$this->_vtcY->_y = cos($kwargs[angle]);
					$this->_vtcY->_z = sin($kwargs[angle]);
					$this->_vtcZ->_z = cos($kwargs[angle]);
					$this->_vtcZ->_y = -sin($kwargs[angle]);
					break;
				}
				case Matrix::RY:{
					$this->_vtcX->_x = cos($kwargs[angle]);
					$this->_vtcX->_z = -sin($kwargs[angle]);
					$this->_vtcZ->_x = sin($kwargs[angle]);
					$this->_vtcZ->_z = cos($kwargs[angle]);
					break;
				}
				case Matrix::RZ:{
					$this->_vtcX->_x = cos($kwargs[angle]);
					$this->_vtcX->_y = sin($kwargs[angle]);
					$this->_vtcY->_x = -sin($kwargs[angle]);
					$this->_vtcY->_y = cos($kwargs[angle]);
					break;
				}
				case Matrix::PROJECTION:{
					$this->_vtcX->_x = 1 / ($kwargs[ratio] * tan(deg2rad($kwargs[fov])/2));
					$this->_vtcY->_y = 1 / tan(deg2rad($kwargs[fov])/2);
					$this->_vtcZ->_z = -( ($kwargs[far] + $kwargs[near]) / ($kwargs[far] - $kwargs[near]) );
					$this->_vtcZ->_w = -1;
					$this->_vtxO->_z = -( (2 * $kwargs[far] * $kwargs[near]) / ($kwargs[far] - $kwargs[near]) );
					$this->_vtxO->_w = 0;
					break;
				}
			}
		}
		else if ($kwargs[preset] == "")
			$this->zeromatr();
		else return FALSE;
        if (self::$verbose == TRUE && $kwargs[preset != ""]) {
			if ($kwargs[preset] == "IDENTITY")
				printf("Matrix $kwargs[preset] instance constructed\n");
			else
				printf("Matrix $kwargs[preset] preset instance constructed\n");
		}
	}

	function mult( Matrix $rhs ) {
		$m = new Matrix(['preset'=>""]);
		$m->_vtcX->_x = $this->_vtcX->_x * $rhs->_vtcX->_x + $this->_vtcY->_x * $rhs->_vtcX->_y + $this->_vtcZ->_x * $rhs->_vtcX->_z + $this->_vtxO->_x * $rhs->_vtcX->_w;
		$m->_vtcY->_x = $this->_vtcX->_x * $rhs->_vtcY->_x + $this->_vtcY->_x * $rhs->_vtcY->_y + $this->_vtcZ->_x * $rhs->_vtcY->_z + $this->_vtxO->_x * $rhs->_vtcY->_w;
		$m->_vtcZ->_x = $this->_vtcX->_x * $rhs->_vtcZ->_x + $this->_vtcY->_x * $rhs->_vtcZ->_y + $this->_vtcZ->_x * $rhs->_vtcZ->_z + $this->_vtxO->_x * $rhs->_vtcZ->_w;
		$m->_vtxO->_x = $this->_vtcX->_x * $rhs->_vtxO->_x + $this->_vtcY->_x * $rhs->_vtxO->_y + $this->_vtcZ->_x * $rhs->_vtxO->_z + $this->_vtxO->_x	* $rhs->_vtxO->_w;

		$m->_vtcX->_y = $this->_vtcX->_y * $rhs->_vtcX->_x + $this->_vtcY->_y * $rhs->_vtcX->_y + $this->_vtcZ->_y * $rhs->_vtcX->_z + $this->_vtxO->_y * $rhs->_vtcX->_w;
		$m->_vtcY->_y = $this->_vtcX->_y * $rhs->_vtcY->_x + $this->_vtcY->_y * $rhs->_vtcY->_y + $this->_vtcZ->_y * $rhs->_vtcY->_z + $this->_vtxO->_y * $rhs->_vtcY->_w;
		$m->_vtcZ->_y = $this->_vtcX->_y * $rhs->_vtcZ->_x + $this->_vtcY->_y * $rhs->_vtcZ->_y + $this->_vtcZ->_y * $rhs->_vtcZ->_z + $this->_vtxO->_y * $rhs->_vtcZ->_w;
		$m->_vtxO->_y = $this->_vtcX->_y * $rhs->_vtxO->_x + $this->_vtcY->_y * $rhs->_vtxO->_y + $this->_vtcZ->_y * $rhs->_vtxO->_z + $this->_vtxO->_y * $rhs->_vtxO->_w;
		
		$m->_vtcX->_z = $this->_vtcX->_z * $rhs->_vtcX->_x + $this->_vtcY->_z * $rhs->_vtcX->_y + $this->_vtcZ->_z * $rhs->_vtcX->_z + $this->_vtxO->_z * $rhs->_vtcX->_w;
		$m->_vtcY->_z = $this->_vtcX->_z * $rhs->_vtcY->_x + $this->_vtcY->_z * $rhs->_vtcY->_y + $this->_vtcZ->_z * $rhs->_vtcY->_z + $this->_vtxO->_z * $rhs->_vtcY->_w;
		$m->_vtcZ->_z = $this->_vtcX->_z * $rhs->_vtcZ->_x + $this->_vtcY->_z * $rhs->_vtcZ->_y + $this->_vtcZ->_z * $rhs->_vtcZ->_z + $this->_vtxO->_z * $rhs->_vtcZ->_w;
		$m->_vtxO->_z = $this->_vtcX->_z * $rhs->_vtxO->_x + $this->_vtcY->_z * $rhs->_vtxO->_y + $this->_vtcZ->_z * $rhs->_vtxO->_z + $this->_vtxO->_z * $rhs->_vtxO->_w;
		
		$m->_vtcX->_w = $this->_vtcX->_w * $rhs->_vtcX->_x + $this->_vtcY->_w * $rhs->_vtcX->_y + $this->_vtcZ->_w * $rhs->_vtcX->_z + $this->_vtxO->_w * $rhs->_vtcX->_w;
		$m->_vtcY->_w = $this->_vtcX->_w * $rhs->_vtcY->_x + $this->_vtcY->_w * $rhs->_vtcY->_y + $this->_vtcZ->_w * $rhs->_vtcY->_z + $this->_vtxO->_w * $rhs->_vtcY->_w;
		$m->_vtcZ->_w = $this->_vtcX->_w * $rhs->_vtcZ->_x + $this->_vtcY->_w * $rhs->_vtcZ->_y + $this->_vtcZ->_w * $rhs->_vtcZ->_z + $this->_vtxO->_w * $rhs->_vtcZ->_w;
		$m->_vtxO->_w = $this->_vtcX->_w * $rhs->_vtxO->_x + $this->_vtcY->_w * $rhs->_vtxO->_y + $this->_vtcZ->_w * $rhs->_vtxO->_z + $this->_vtxO->_w * $rhs->_vtxO->_w;
		return($m);
	}

	function transformVertex( Vertex $vtx ) {
		return (new Vertex([
			'x'=> ($vtx->_x * $this->_vtcX->_x) + ($vtx->_y * $this->_vtcX->_y) + ($vtx->_z * $this->_vtcX->_z) + ($vtx->_w * $this->_vtxO->_w),
			'y'=> ($vtx->_x * $this->_vtcY->_x + $vtx->_y * $this->_vtcY->_y + $vtx->_z * $this->_vtcY->_z + $vtx->_w * $this->_vtxO->_w),
			'z'=> ($vtx->_x * $this->_vtcZ->_x + $vtx->_y * $this->_vtcZ->_y + $vtx->_z * $this->_vtcZ->_z + $vtx->_w * $this->_vtxO->_w),
			'w'=> ($vtx->_w * $this->_vtxO->_x + $vtx->_y * $this->_vtxO->_y + $vtx->_z * $this->_vtxO->_z + $vtx->_w * $this->_vtxO->_w),
		]));
	}

	function __toString() {
        $s = "M | vtcX | vtcY | vtcZ | vtxO\n-----------------------------\n";
        $s .= sprintf("x | %.2f | %.2f | %.2f | %.2f\n", $this->_vtcX->_x,
            $this->_vtcY->_x, $this->_vtcZ->_x, $this->_vtxO->_x);
        $s .= sprintf("y | %.2f | %.2f | %.2f | %.2f\n", $this->_vtcX->_y,
            $this->_vtcY->_y, $this->_vtcZ->_y, $this->_vtxO->_y);
        $s .= sprintf("z | %.2f | %.2f | %.2f | %.2f\n", $this->_vtcX->_z,
            $this->_vtcY->_z, $this->_vtcZ->_z, $this->_vtxO->_z);
        $s .= sprintf("w | %.2f | %.2f | %.2f | %.2f", $this->_vtcX->_w,
            $this->_vtcY->_w, $this->_vtcZ->_w, $this->_vtxO->_w);
        return $s;
    }

    function __destruct() {
         if (self::$verbose == TRUE)
              printf("Matrix instance destructed\n");
	}
	
	public static function doc() {
		$str = file_get_contents('Matrix.doc.txt');
		return $str.PHP_EOL;
	}

}