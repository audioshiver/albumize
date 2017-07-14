<?php 
ini_set('display_errors', 'On');

function get_image($loc,$class=''){
	$dir=DIR_IMG.$loc.DS;
	$ext=array('jpg','jpeg','png','tif','tiff');
	if (file_exists($dir)==false){
		echo 'Directory \'',$dir,'\' not found!';
	}else{
		$dir_contents=array_diff(scandir($dir),array('.','..'));
		shuffle($dir_contents);
		foreach($dir_contents as $image_raw){
			$image=rawurlencode($image_raw );
			$image_ext=strtolower(substr(strrchr($image,'.'),1));
			if((in_array($image_ext,$ext))==true){
				$link=$dir.$image;
				if($loc=='home'){
					echo '<div><div class="background resize" style="background-image:url(',$link,')"></div></div>';
				} else {
					echo '<div class="grid-block"><img class="js_show resize ',$loc,'" src="',$link,'" loc="' ,$loc,'"/></div>';
				}
			}
		}
	}
};