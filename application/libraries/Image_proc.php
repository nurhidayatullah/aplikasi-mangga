<?php
class Image_proc{
	var $tresh = 50;
	var $citra;
	var $citra_asli;
	var $file;
	var $ukuran;
	var $keliling;
	var $area;
	public function grayscale(){
        $dest = imagecreatetruecolor($this->ukuran[0],$this->ukuran[1]);
        for($x=0;$x<$this->ukuran[0];$x++){
			for($y=0;$y<$this->ukuran[1];$y++){
				$gray = $this->get_luminance(imagecolorat($this->citra,$x,$y));
				$new_gray  = imagecolorallocate($dest,$gray,$gray,$gray);
				imagesetpixel($dest,$x,$y,$new_gray); 
			}
		}
		
		$this->citra = $dest;
	}
	
	function read_file($file){
		$this->citra = imagecreatefromjpeg($file);
		$this->citra_asli = $this->citra;
		$this->file = $file;
		$this->ukuran = getimagesize($file);
	}
	
	public function save($file,$path){ 
		imagejpeg($file,$path, 100);
		imagedestroy($file);
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
	//	$this->save($this->citra,$this->file);
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
		for($x=0;$x<256;$x++){
			$means['R'] = $means['R'] + ($x*($histogram[0][$x]/$histogram[4]));
			$means['G'] = $means['G'] + ($x*($histogram[1][$x]/$histogram[4]));
			$means['B'] = $means['B'] + ($x*($histogram[2][$x]/$histogram[4]));
		}
		return $means;
	}
	public function get_varian($means){
		$image_width 	= imagesx($this->citra);
		$image_height 	= imagesy($this->citra);
		$pixel = $image_width*$image_height;
		$Var['R']=0; //varian Red
		$Var['G']=0; //Varian Green
		$Var['B']=0; //Varian Blue
		for($x=0;$x<$image_width;$x++){
			for($y=0;$y<$image_height;$y++){
				$rgb = imagecolorat($this->citra, $x, $y); 
				$r = ($rgb >> 16) & 0xFF;
				$g = ($rgb >> 8) & 0xFF;
				$b = $rgb & 0xFF;
				$Var['R']=$Var['R']+((pow($r-$means['R'],2)));
				$Var['G']=$Var['G']+((pow($r-$means['G'],2)));
				$Var['B']=$Var['B']+((pow($r-$means['B'],2)));
				}
			}
		$Varian['R'] = ($Var['R']/$pixel);
		$Varian['G'] = ($Var['G']/$pixel);
		$Varian['B'] = ($Var['B']/$pixel);
		return $Varian;
	}
	public function get_deviasi($varian){ //$varian = array varian
		$Dev['R'] = sqrt($varian['R']);
		$Dev['G'] = sqrt($varian['G']);
		$Dev['B'] = sqrt($varian['B']);
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
		$this->keliling = $this->sobel();
	}
	function set_area(){
		$this->area = $this->get_area();
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
				$rgb_k = imagecolorat($keliling,$x,$y);
	        	$r = ($rgb_k >> 16) & 0xFF;
				$g = ($rgb_k >> 8) & 0xFF;
				$b = $rgb_k & 0xFF;
				if($r == 255 && $g == 255 && $b ==255){
					$P = $P + 1;
				}
				
	        }
	    }
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
				if($rgb_area['r'] == 255 && $rgb_area['g'] == 255 && $rgb_area['b'] ==255){
					$A = $A + 1;
				}
				$rgb_k = $this->get_rgb(imagecolorat($keliling,$x,$y));
				if($rgb_k['r'] == 255 && $rgb_k['g'] == 255 && $rgb_k['b'] ==255){
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
	
	var $luas;
	function get_area(){
		$area = imagecreatetruecolor($this->ukuran[0],$this->ukuran[1]);
		$front = imagecreatetruecolor($this->ukuran[0],$this->ukuran[1]);		
		for($x = 0;$x < $this->ukuran[0];$x++){
			for($y = 0;$y < $this->ukuran[1];$y++){
				$gray = $this->get_luminance(imagecolorat($this->citra,$x,$y));
				$rgb = $this->get_rgb(imagecolorat($this->citra_asli,$x,$y));
				if($gray > $this->tresh){
					$bw = 255;
					$r = $rgb['r'];
					$g = $rgb['g'];
					$b = $rgb['b'];
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
		$this->luas = $area;
		$this->save($this->citra,$this->file);
		return $area;
	}
	
	public function sobel(){
		error_reporting(0);
		$img = $this->luas;
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
				$new_gray  = imagecolorallocate($final,$gr,$gr,$gr);
				imagesetpixel($final,$x,$y,$new_gray);            
			}
        }
		return $final;
	//	$this->save($this->citra,$this->file);
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
}
?>