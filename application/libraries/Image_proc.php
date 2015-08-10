<?php
class Image_proc{
	var $tresh = 80;
	var $citra;
	var $file;
	var $path;
	var $ukuran;
	var $keliling;
	var $area;
	var $luas;
	public function cetak_tabel_rgb(){
        $dest = imagecreatetruecolor($this->ukuran[0],$this->ukuran[1]);
		$out = "<table border='1px'>";
		$out .="<tr><td></td>";
		for($b=0;$b<$this->ukuran[0];$b++){
			if($b < 100 || $b > ($this->ukuran[0]-3)){
				$out .="<td>".($b+1)."</td>";
			}else{
				if($b < 13){
					$out .="<td>---</td>";
				}
			}
			
		}
		$out .="</tr>";
        for($x=0;$x<$this->ukuran[1];$x++){
			if($x < 100 || $x > ($this->ukuran[1]-3)){
				$out .= "<tr>";
				$out .="<td>".($x+1)."</td>";
				for($y=0;$y<$this->ukuran[0];$y++){
					if($y < 100 || $y > ($this->ukuran[0]-3)){
						$out .= "<td>";
						$rgb = imagecolorat($this->citra,$y,$x);
						$r = ($rgb >> 16) & 0xFF;
						$g = ($rgb >> 8) & 0xFF;
						$b = $rgb & 0xFF;
						$out .="R : ".$r."</br>G : ".$g."</br>B : ".$b;
						$out .= "</td>";
					}else{
						if($y < 13){
							$out .="<td>---</td>";
						}
					}
				}
				$out .= "</tr>";
			}else{
				if($y < 13){
					$out.="<tr>---</tr>";
				}
			}
		}
		$out .= "</table>";
		echo $out;
	}
	
	function cetak_tabel_gray(){	
		$dest = imagecreatetruecolor($this->ukuran[0],$this->ukuran[1]);
		$out = "<table border='1px'>";
		$a = 1;
		$out .="<tr><td></td>";
		for($b=0;$b<$this->ukuran[0];$b++){
			if($b < 15 || $b > ($this->ukuran[0]-3)){
				$out .="<td>".($b+1)."</td>";
			}
		}
		$out .="</tr>";
		for($x = 0;$x < $this->ukuran[1];$x++){
			if($x < 15 || $x > ($this->ukuran[1]-3)){
				$out .= "<tr>";
				$out .="<td>".($a)."</td>";
				for($y = 0;$y < $this->ukuran[0];$y++){
					if($y < 15 || $y > ($this->ukuran[0]-3)){
						$out .= "<td>";
						$gray = round($this->get_luminance(imagecolorat($this->citra,$y,$x)));
						if($gray < 50){
							$gray = 0;
						}else{
							$gray = 1;
						}
						$out .= $gray;
						$out .="</td>";
					//	$new_gray  = imagecolorallocate($dest,$gray,$gray,$gray);
					//	imagesetpixel($dest,$y,$x,$new_gray);
					}
				}
				$out .= "</tr>";
			}
			$a++;
		}
		$out .= "</table>";
		echo $out;
	}
	
	function read_file($path,$file){
		$this->citra = imagecreatefromjpeg($path.$file);
		$this->path = $path;
		$this->file = $file;
		$this->ukuran = getimagesize($path.$file);
	}
	
	public function save($file,$path){ 
		imagejpeg($file,$path, 100);
	//	imagedestroy($file);
	}
	
	function norm(){
		$histogram = $this->histogram();
		$min = array();
		$max = array();
		for($x=0;$x<count($histogram);$x++){
			for($y=0;$y<count($histogram[$x]);$y++){
				if($histogram[$x][$y]!=0){
					$min[$x] = $y;
					break;
				}
			}
			for($y=(count($histogram[$x])-1);$y>=0;$y--){
				if($histogram[$x][$y]!=0){
					$max[$x] = $y;
					break;
				}
			}
		}
        $dest = imagecreatetruecolor($this->ukuran[0],$this->ukuran[1]);
        for($x=0;$x<$this->ukuran[0];$x++){
			for($y=0;$y<$this->ukuran[1];$y++){
				$rgb = imagecolorat($this->citra,$x,$y);
				$r = ($rgb >> 16) & 0xFF;
				$red=($r-$min[0])/($max[0]-$min[0]);
				$R=(int)($red*255);
				
				$g = ($rgb >> 8) & 0xFF;
				$green=($g-$min[1])/($max[1]-$min[1]);
				$G=(int)($green*255);
				
				$b = $rgb & 0xFF;
				$blue=($b-$min[2])/($max[2]-$min[2]);
				$B=(int)($blue*255);
				
				$new = imagecolorallocate($dest,$R,$G,$B);
				imagesetpixel($dest,$x,$y,$new); 
			}
		}
		$this->citra = $dest;
		$this->save($this->citra,$this->path."norm-".$this->file);
		return "norm-".$this->file;
	}
	
	public function histogram(){
		error_reporting(0);
		$image_width 	= imagesx($this->citra);
		$image_height 	= imagesy($this->citra);
		$value[0] 		= array();
		$value[1] 		= array();
		$value[2] 		= array();
		$value[3]		= array();
		$value[4]		= $image_width*$image_height;
		
		for($x=0;$x<$image_width;$x++){
			for($y=0;$y<$image_height;$y++){
				$rgb = imagecolorat($this->citra, $x, $y); 
				$r = ($rgb >> 16) & 0xFF;
				$g = ($rgb >> 8) & 0xFF;
				$b = $rgb & 0xFF;
				$gray = ($r+$g+$b)/3;
				$value[0][$r]++;
				$value[1][$g]++;
				$value[2][$b]++;
				$value[3][$gray]++;
			}
		}
		for($x=0;$x<256;$x++){
			if(empty($value[0][$x])){
				$value[0][$x] = 0;
			}
			if(empty($value[1][$x])){
				$value[1][$x] = 0;
			}
			if(empty($value[2][$x])){
				$value[2][$x] = 0;
			}
			if(empty($value[3][$x])){
				$value[3][$x] = 0;
			}
		}
		return $value;
	}
	public function get_means($histogram){//$histogram = array histogram
		$means['R'] = 0;
		$means['G'] = 0;
		$means['B'] = 0;
		$out = "Mean Green = ";
		for($x=0;$x<256;$x++){
		//	echo "p(".$x.") = ".$histogram[1][$x]."/".$histogram[4]." = ".round($histogram[1][$x]/$histogram[4],4)."</br>";
			$means['R'] = $means['R'] + ($x*($histogram[0][$x]/$histogram[4]));
			$means['G'] = $means['G'] + ($x*($histogram[1][$x]/$histogram[4]));
			$means['B'] = $means['B'] + ($x*($histogram[2][$x]/$histogram[4]));
			$out .= "+(".$x."*".round($histogram[1][$x]/$histogram[4],4).")";
		}
		$out .=" = ".$means['G'];
	//	echo $out;
		return $means;
	}
	public function get_varian($means){
		$image_width 	= imagesx($this->citra);
		$image_height 	= imagesy($this->citra);
		$pixel = $image_width*$image_height;
		$Var['R']=0; //varian Red
		$Var['G']=0; //Varian Green
		$Var['B']=0; //Varian Blue
		$out = "Moment nth Green = ";
		for($x=0;$x<$image_width;$x++){
			for($y=0;$y<$image_height;$y++){
				$rgb = imagecolorat($this->citra, $x, $y); 
				$r = ($rgb >> 16) & 0xFF;
				$g = ($rgb >> 8) & 0xFF;
				$b = $rgb & 0xFF;
				$out .= " + ( ( ".$r." - ".round($means['G'],4)." ) ^ 2 )";
				$Var['R']=$Var['R']+((pow($r-round($means['R'],4),2)));
				$Var['G']=$Var['G']+((pow($r-round($means['G'],4),2)));
				$Var['B']=$Var['B']+((pow($r-round($means['B'],4),2)));
				}
			}
			$out .=" / ".$pixel." = ".($Var['G']/$pixel);
		$Varian['R'] = ($Var['R']/$pixel);
		$Varian['G'] = ($Var['G']/$pixel);
		$Varian['B'] = ($Var['B']/$pixel);
	//	echo $out;
		return $Varian;
	}
	public function get_deviasi($varian){ //$varian = array varian
		$Dev['R'] = sqrt($varian['R']);
		$Dev['G'] = sqrt($varian['G']);
		$Dev['B'] = sqrt($varian['B']);
	//	echo "Standart Deviasi = sqrt(".$varian['G'].") = ".$Dev['G'];
		return $Dev;
	}
	public function compress($source, $destination, $quality) { //$source = file source,$destination = file destonation,$quality = quality destination file
		ini_set('memory_limit', '-1');
		$info = getimagesize($source);
		if ($info['mime'] == 'image/jpeg'){ 
			$image = imagecreatefromjpeg($source);
		}elseif ($info['mime'] == 'image/gif'){
			$image = imagecreatefromgif($source);
		}elseif ($info['mime'] == 'image/png'){ 
			$image = imagecreatefrompng($source);
		}
		imagejpeg($image, $destination, $quality);
		return $destination;
	}
	
	function set_keliling(){
		return $this->sobel();
	}
	
	function set_area(){
		return $this->get_area();
	}
	
	function get_circularity(){
		$keliling = $this->keliling;
		$area = $this->area;
		$P = 0;
		$A = 0;
		for($x = 0;$x < $this->ukuran[0];$x++){
	        for($y = 0;$y < $this->ukuran[1];$y++){
	        	$rgb_area = imagecolorat($area,$x,$y);
	        	$ra = ($rgb_area >> 16) & 0xFF;
				$ga = ($rgb_area >> 8) & 0xFF;
				$ba = $rgb_area & 0xFF;
				if($ra == 255 && $ga == 255 && $ba ==255){
					$A = $A + 1;
				}
				if($keliling[$x][$y] == 1){
					$P = $P + 1;
				}
				
	        }
	    }
		//echo "Area : ".$A.",Kel : ".$P;
	    $circularity = (4*3.14*$A)/($P*$P);
	    return $circularity;
	}
	
	function get_compactness(){
		$keliling = $this->keliling;
		$area = $this->area;
		$P = 0;
		$A = 0;
		for($x = 0;$x < $this->ukuran[0];$x++){
			for($y = 0;$y < $this->ukuran[1];$y++){
				$rgb_area = $this->get_rgb(imagecolorat($area,$x,$y));
				//print_r($rgb_area);
				if($rgb_area['r'] == 255 && $rgb_area['g'] == 255 && $rgb_area['b'] ==255){
					$A = $A + 1;
				}
				if($keliling[$x][$y] == 1){
					$P = $P + 1;
				}
				
			}
		}
		$compactness = ($P*$P)/$A;
		return $compactness;
	}
	
	public function get_luminance($rgb){
        $r = ($rgb >> 16) & 0xFF;
		$g = ($rgb >> 8) & 0xFF;
		$b = $rgb & 0xFF;
		return (($r+$g+$b)/3);
    }
	
	function get_rgb($rgb){
		$data['r'] = ($rgb >> 16) & 0xFF;
		$data['g'] = ($rgb >> 8) & 0xFF;
		$data['b'] = $rgb & 0xFF;
		return $data;
	}
	
	
	function get_area(){
		$area = imagecreatetruecolor($this->ukuran[0],$this->ukuran[1]);
		$front = imagecreatetruecolor($this->ukuran[0],$this->ukuran[1]);		
		for($x = 0;$x < $this->ukuran[0];$x++){
			for($y = 0;$y < $this->ukuran[1];$y++){
				$gray = $this->get_rgb(imagecolorat($this->citra,$x,$y));
				if($gray['g'] > $gray['b'] && $gray['g'] > $this->tresh){
					$bw = 255;
					$r = $gray['r'];
					$g = $gray['g'];
					$b = $gray['b'];
				}else{
					$bw = 0;
					$r = 0;
					$g = 0;
					$b = 0;
				}
				$new_img  = imagecolorallocate($front,$r,$g,$b);
				imagesetpixel($front,$x,$y,$new_img);
				$new_gray  = imagecolorallocate($area,$bw,$bw,$bw);
				imagesetpixel($area,$x,$y,$new_gray);
			}
		}
		$this->citra = $front;
		$this->area = $area;
		$this->save($this->citra,$this->path."area-".$this->file);
		return "area-".$this->file;
	}
	function cetak_sobel(){
		$img = $this->area;
		$a = 1;
        $final = imagecreatetruecolor($this->ukuran[0],$this->ukuran[1]);
		$out = "<table border='1px'>";
		$out .="<tr><td></td>";
		for($b=0;$b<$this->ukuran[0];$b++){
			$out .="<td>".($b+1)."</td>";
		}
		$out .="</tr>";
		$hitung = "";
		for($x = 0;$x < $this->ukuran[1];$x++){
			$out .= "<tr>";
			$out .="<td>".($a)."</td>";
			for($y = 0;$y < $this->ukuran[0];$y++){
				$pixel_up = $this->get_luminance(imagecolorat($img,$y,$x-1));
				$pixel_down = $this->get_luminance(imagecolorat($img,$y,$x+1)); 
				$pixel_left = $this->get_luminance(imagecolorat($img,$y-1,$x));
				$pixel_right = $this->get_luminance(imagecolorat($img,$y+1,$x));
				$pixel_up_left = $this->get_luminance(imagecolorat($img,$y-1,$x-1));
				$pixel_up_right = $this->get_luminance(imagecolorat($img,$y+1,$x-1));
				$pixel_down_left = $this->get_luminance(imagecolorat($img,$y-1,$x+1));
				$pixel_down_right = $this->get_luminance(imagecolorat($img,$y+1,$x+1));
				$hitung .= "Piksel[".$x."][".$y."] = sqrt(";
				$conv_x = ($pixel_up_right+($pixel_right*2)+$pixel_down_right)-($pixel_up_left+($pixel_left*2)+$pixel_down_left);
				$hitung .= "(((".$pixel_up_right." + (".$pixel_right." * 2) + ".$pixel_down_right." )-( ".$pixel_up_left." + ( ".$pixel_left." * 2 ) + ".$pixel_down_left." ))^2) + ";
				$conv_y = ($pixel_up_left+($pixel_up*2)+$pixel_up_right)-($pixel_down_left+($pixel_down*2)+$pixel_down_right);
				$hitung .= "(((".$pixel_up_left." + (".$pixel_up." * 2) + ".$pixel_up_right." )-( ".$pixel_down_left." + ( ".$pixel_down." * 2 ) + ".$pixel_down_right." ))^2)";
				$gray = sqrt(($conv_x*$conv_x)+($conv_y*$conv_y));
			//	echo ($conv_x*$conv_x)." ".($conv_y*$conv_y)."<br/>";
				$hitung .= " = ".$gray." < ".$this->tresh;
				if($gray > $this->tresh){
					$gr = 1;
				}else {
					$gr = 0;
				}
				$hitung .= " = ".$gr."</br>";
				$out .="<td>".$gr."</td>";         
			}
			$out .="</tr>";
			$a++;
        }
		echo $hitung;
		$out .="</table>";
	//	echo $out;
	}
	public function sobel(){
		error_reporting(0);
		$img = $this->area;
        $final = imagecreatetruecolor($this->ukuran[0],$this->ukuran[1]);
        for($x = 0;$x < $this->ukuran[0];$x++){
			for($y = 0;$y < $this->ukuran[1];$y++){
				$pixel_up = $this->get_luminance(imagecolorat($img,$x,$y-1));
				$pixel_down = $this->get_luminance(imagecolorat($img,$x,$y+1)); 
				$pixel_left = $this->get_luminance(imagecolorat($img,$x-1,$y));
				$pixel_right = $this->get_luminance(imagecolorat($img,$x+1,$y));
				$pixel_up_left = $this->get_luminance(imagecolorat($img,$x-1,$y-1));
				$pixel_up_right = $this->get_luminance(imagecolorat($img,$x+1,$y-1));
				$pixel_down_left = $this->get_luminance(imagecolorat($img,$x-1,$y+1));
				$pixel_down_right = $this->get_luminance(imagecolorat($img,$x+1,$y+1));
				$conv_x = ($pixel_up_right+($pixel_right*2)+$pixel_down_right)-($pixel_up_left+($pixel_left*2)+$pixel_down_left);
				$conv_y = ($pixel_up_left+($pixel_up*2)+$pixel_up_right)-($pixel_down_left+($pixel_down*2)+$pixel_down_right);
				$gray = sqrt(($conv_x*$conv_x)+($conv_y*$conv_y));
				
				if($gray > $this->tresh){
					$gr = 255;
				}else {
					$gr = 0;
				}
				//echo $gr;
				$new_gray  = imagecolorallocate($final,$gr,$gr,$gr);
				imagesetpixel($final,$x,$y,$new_gray);            
			}
        }
		$this->keliling = $final;
		$keliling = $this->thinning();
		$this->save($keliling,$this->path."keliling-".$this->file);
		return "keliling-".$this->file;
	}
	public function prewitt(){
		error_reporting(0);
		$img = $this->citra;
        $final = imagecreatetruecolor($this->ukuran[0],$this->ukuran[1]);
        for($x = 0;$x < $this->ukuran[0];$x++){
			for($y = 0;$y < $this->ukuran[1];$y++){
				$pixel_up = $this->get_luminance(imagecolorat($img,$x,$y-1));
				$pixel_down = $this->get_luminance(imagecolorat($img,$x,$y+1)); 
				$pixel_left = $this->get_luminance(imagecolorat($img,$x-1,$y));
				$pixel_right = $this->get_luminance(imagecolorat($img,$x+1,$y));
				$pixel_up_left = $this->get_luminance(imagecolorat($img,$x-1,$y-1));
				$pixel_up_right = $this->get_luminance(imagecolorat($img,$x+1,$y-1));
				$pixel_down_left = $this->get_luminance(imagecolorat($img,$x-1,$y+1));
				$pixel_down_right = $this->get_luminance(imagecolorat($img,$x+1,$y+1));
				
				$conv_x = ($pixel_up_right+$pixel_right+$pixel_down_right)-($pixel_up_left+$pixel_left+$pixel_down_left);
				$conv_y = ($pixel_up_left+$pixel_up+$pixel_up_right)-($pixel_down_left+$pixel_down+$pixel_down_right);
				$gray = sqrt(($conv_x*$conv_x)+($conv_y*$conv_y));
				
				if($gray > $this->tresh){
					$gr = 255;
				}else {
					$gr = 0;
				}
				$new_gray  = imagecolorallocate($final,$gr,$gr,$gr);
				imagesetpixel($final,$x,$y,$new_gray);            
			}
        }
		$this->citra = $final;
	}
	private function getNeighbors($imgval, $x, $y, $w, $h) {
        $a = array(10);
        for ($n = 1; $n < 10; $n++) {
            $a[$n] = 0;
        }
        if ($y - 1 >= 0) {
            $a[2] = $imgval[$x][$y - 1];
            if ($x + 1 < $w) {
                $a[3] = $imgval[$x + 1][$y - 1];
            }
            if ($x - 1 >= 0) {
                $a[9] = $imgval[$x - 1][$y - 1];
            }
        }
        if ($y + 1 < $h) {
            $a[6] = $imgval[$x][$y + 1];
            if ($x + 1 < $w) {
                $a[5] = $imgval[$x + 1][$y + 1];
            }
            if ($x - 1 >= 0) {
                $a[7] = $imgval[$x - 1][$y + 1];
            }
        }
        if ($x + 1 < $w) {
            $a[4] = $imgval[$x + 1][$y];
        }
        if ($x - 1 >= 0) {
            $a[8] = $imgval[$x - 1][$y];
        }
        return $a;
    }
	public function thinning() {
		$image = $this->keliling;
		$final = imagecreatetruecolor($this->ukuran[0],$this->ukuran[1]);
        $h = $this->ukuran[1];
        $w = $this->ukuran[0];
        $imgval = array(array($w),array($h));
		$mark = array(array($w),array($h));
        for ($y = 0; $y < $h; $y++) {
            for ($x = 0; $x < $w; $x++) {
				$rgb = $this->get_rgb(imagecolorat($image,$x,$y));
			//	print_r($rgb);
				$imgval[$x][$y] = (($rgb['r'] == 255) && ($rgb['g'] == 255) && ($rgb['b'] ==255) ? 1:0);
            }
        }
				
		//print_r($imgval);
        $hasdelete = true;
        while ($hasdelete) {
            $hasdelete = false;
            for ($y = 0; $y < $h; $y++) {
                for ($x = 0; $x < $w; $x++) {
                    if ($imgval[$x][$y] == 1) {
                        $nb = $this->getNeighbors($imgval, $x, $y, $w, $h);
                        $a = 0;
                        for ($i = 2; $i < 9; $i++) {
                            if (($nb[$i] == 0) && ($nb[$i + 1] == 1)) {
                                $a++;
                            }
                        }
                        if (($nb[9] == 0) && ($nb[2] == 1)) {
                            $a++;
                        }
                        $b = $nb[2] + $nb[3] + $nb[4] + $nb[5] + $nb[6] + $nb[7] + $nb[8] + $nb[9];
                        $p1 = $nb[2] * $nb[4] * $nb[6];
                        $p2 = $nb[4] * $nb[6] * $nb[8];
                        if (($a == 1) && (($b >= 2) && ($b <= 6))
                                && ($p1 == 0) && ($p2 == 0)) {
                            $mark[$x][$y] = 0;
                            $hasdelete = true;
                        } else {
                            $mark[$x][$y] = 1;
                        }
                    } else {
                        $mark[$x][$y] = 0;
                    }
                }
            }
            for ($y = 0; $y < $h; $y++) {
                for ($x = 0; $x < $w; $x++) {
                    $imgval[$x][$y] = $mark[$x][$y];
                }
            }

            //
            for ($y = 0; $y < $h; $y++) {
                for ($x = 0; $x < $w; $x++) {
                    if ($imgval[$x][$y] == 1) {
                        $nb = $this->getNeighbors($imgval, $x, $y, $w, $h);
                        $a = 0;
                        for ($i = 2; $i < 9; $i++) {
                            if (($nb[$i] == 0) && ($nb[$i + 1] == 1)) {
                                $a++;
                            }
                        }
                        if (($nb[9] == 0) && ($nb[2] == 1)) {
                            $a++;
                        }
                        $b = $nb[2] + $nb[3] + $nb[4] + $nb[5] + $nb[6] + $nb[7] + $nb[8] + $nb[9];
                        $p1 = $nb[2] * $nb[4] * $nb[8];
                        $p2 = $nb[2] * $nb[6] * $nb[8];
                        if (($a == 1) && (($b >= 2) && ($b <= 6))
                                && ($p1 == 0) && ($p2 == 0)) {
                            $mark[$x][$y] = 0;
                            $hasdelete = true;
                        } else {
                            $mark[$x][$y] = 1;
                        }
                    } else {
                        $mark[$x][$y] = 0;
                    }
                }
            }
            for ($y = 0; $y < $h; $y++) {
                for ($x = 0; $x < $w; $x++) {
                    $imgval[$x][$y] = $mark[$x][$y];
                }
            }
        }
		for ($y = 0; $y < $h; $y++) {
            for ($x = 0; $x < $w; $x++) {
                if ($imgval[$x][$y] == 1) {
                    $new_gray  = imagecolorallocate($final,255,255,255);
                } else {
                    $new_gray  = imagecolorallocate($final,0,0,0);
				
                }
				
			//	print_r($mark);
				imagesetpixel($final,$x,$y,$new_gray); 
            }
        }
		$this->keliling = $imgval;
		return $final;
	}
}
?>