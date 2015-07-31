<?php
/* Author : Nur Hidayatullah
 * Created : 22 Apr 2015
 */
class Voted_perceptron{
	
	function train($data,$label,$v,$c){		// function pelatihan
		$is_result = "";
		for($x = 0; $x < strlen($label); $x++){
			$target[$x] = ($label{$x}==1)?(int)$label{$x}:-1;
		}
		for($x = 0; $x < count($v); $x++){
			$out[$x] = $this->dot_product($data,$v[$x]);
			//print_r($data);
			if($out[$x] ==$target[$x]){
				$is_result .=1;
			}else{
				$is_result .=0;
				for($y = 0;$y < count($v[$x]);$y++){
					//echo $data[$y]."<br/>";
					$v_baru[$y] = $v[$x][$y]+($target[$x]*$data[$y]);
					$out = "v_".($y+1).($x+1)." = ".$v[$x][$y]."+(".$target[$x]."*".$data[$y].") = ".$v_baru[$y]."<br/>";
					//echo $out;
				}
				$v[$x] = $v_baru;
			}
			
		}
		$ck = strpos($is_result,"0");
		if($ck===FALSE){
			$c = $c + 1;
			$result = array('c'=>$c);
		}else{
			$v_baru = array();
			/* for($x = 0; $x < count($v); $x++){
				
			} */
			$c = 0;
			//print_r($v);
			$z = array();
			for($x = 0;$x < count($v);$x++){
				for($y = 0;$y < count($v[$x]);$y++){
					$z[$y][$x] = $v[$x][$y];
				}
			}
			$result = array('v'=>$z,'c'=>$c);
		}
		return $result;
	}
	
	function sign($y_in){ // aktivasi
		if($y_in >= 0){
			$y = 1;
		}else{
			$y = -1;
		}
		return $y;
	}
	function dot_product($data,$v){
		$y_in = 0;
		$out = "y_in = ";
		for($x = 0;$x < count($v);$x++){
			$y_in = $y_in + ($data[$x]*$v[$x]);
			$out .= "(".$data[$x]."*".$v[$x].")+";
		}
		$out .= " = ".$y_in;
		//echo $out;
		//echo $this->sign($y_in);
		return $this->sign($y_in);	
	}
	
	function classifier($data,$v){
		$print = "";
		$t = "<br/><br/>";
		for($y = 0;$y < 3;$y++){
			$out[$y] = 0;
			$print .= "y[".$y."] = ";
			$t .= "y[".$y."] = ";
			foreach($v as $vektor){
				$y_in[$y]=0;
				for($x = 0;$x < count($data);$x++){
					if($x != (count($data)-1)){
						$print .= "(".$data[$x]."*".$vektor[$y][$x].")+";
					}else{
						$print .= "(".$data[$x]."*".$vektor[$y][$x].")= ";
					}
					$y_in[$y] = $y_in[$y]+($data[$x]*$vektor[$y][$x]);
					
				}
				$print .= $y_in[$y]."<br/>";
				$t .= "(sign(".$y_in[$y].")*".$vektor[3].")+";
				$out[$y] = $out[$y]+($this->sign($y_in[$y])*$vektor[3]);
			}
			$t .= "= sign(".$out[$y].")=".$this->sign($out[$y])."<br/>";
			 
			$out[$y] = $this->sign($out[$y]);
		}
		$print .= $t;
		echo $print;
		print_r($out);
		/* foreach($v as $v){
			for($y = 0;$y < 3;$y++){
				
				for($x = 0;$x < count($data);$x++){
					$out[$y] = $out[$y]+($data[$x]*$v[$y][$x]);
				}
				$out[$y] = $this->sign($out[$y])*$v[3];
			}
			print_r($out);
		} */
	}
	/* function classifier($data,$v,$c,$k){ // fungsi untuk klasifikasi
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
	} */
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