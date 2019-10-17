<?php

class UnholyFactory {
	private $bojc = array();
	
	function absorb($soldat) {
		if ($soldat instanceof Fighter) {
			if (in_array($soldat, $this->bojc) == TRUE)
				echo "(Factory already absorbed a fighter of type $soldat->name)\n";
			else {
                $this->bojc[$soldat->name] = $soldat;
                echo "(Factory absorbed a fighter of type $soldat->name)\n";
			}
		}
		else
			echo "(Factory can't absorb this, it's not a fighter)\n";
	}

	function fabricate($rf) {
		if (array_key_exists($rf, $this->bojc) == FALSE) {
			echo "(Factory hasn't absorbed any fighter of type $rf)\n";
			return;
		}
		echo "(Factory fabricates a fighter of type $rf)\n";
		return ($this->bojc[$rf]);
	}

}
?>