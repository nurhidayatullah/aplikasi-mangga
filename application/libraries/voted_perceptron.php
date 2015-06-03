<?php
/* Author : Nur Hidayatullah
 * Created : 22 Apr 2015
 */
class Voted_perceptron{
	
	function train($data,$label,$v,$c){		// function pelatihan
		$is_result = "";
		for($x = 0; $x < strlen($label); $x++){
			$target[$x] = (int)$label{$x};
		}
		for($x = 0; $x < count($v); $x++){
			$out[$x] = $this->dot_product($data,$v[$x]);
			if($out[$x] ==$target[$x]){
				$is_result .=1;
			}else{
				$is_result .=0;
				$v_baru = array();
				for($y = 0;$y < count($v[$x]);$y++){
					$v_baru[$y] = $v[$x][$y]+($target[$x]*$data[$x][$y]);
				}
				$v[$x] = $v_baru;
			}
			
		}
		$ck = strpos($is_result,"0");
		if($ck===FALSE){
			$c = $c + 1;
			$result = array('c'=>$c);
		}else{
			$c = 0;
			$result = array('v'=>$v,'c'=>$c);
		}
		return $result;
	}
	
	function sign($y_in){ // aktivasi
		if($y_in > 0){
			$y = 1;
		}else{
			$y = 0;
		}
		return $y;
	}
	function dot_product($data,$v){
		$y_in = 0;
		for($x = 0;$x < count($v);$x++){
			$y_in = $y_in + ($data[$x]*$v[$x]);
		}
		return $this->sign($y_in);	
	}
	function classifier($data,$v,$c,$k){ // fungsi untuk klasifikasi
		$s = 0;
		for($x = 0;$x <= $k;$x++){
			$y_in = 0;
			$row = 0;
			for($y=0;$y<count($v[$x]);$y++){
				$y_in = $y_in +($v[$x][$y]*$data[$y]);
				$row++;
			}
			$s = $s +($c[$x]*$this->sign($y_in));
		}
		return $this->sign($s);
	}
}
/*
$uji = array(array(-1,-1),array(-1,1),array(1,-1),array(1,1));
for($x=0;$x<count($uji);$x++){
	$hasil = $voted->classifier($uji[$x],$out['v'],$out['c'],$out['k']);
	echo "Data ".($x+1)." ";
	print_r($uji[$x]);
	echo "  Hasil : ".$hasil."</br>";
} */
?>