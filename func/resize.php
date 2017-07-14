<?php
// *** Include the class
include('../config.php');
include('resize-class.php');
ini_set('display_errors', 'On');

// list of available image sizes
// insert more sizes for finer grain control
$image_sizes = array(
	'320', // smallest
	'480',
	'768',
	'940' // largest
);

// get image directory ~wedding/
$image_path = $_POST['loc'] . DS;

// get image filename ~01.jpg
$image_filename = preg_replace('/(\d{3}_)/','',(basename($_POST['image'])));

// get window width
$browser_width = (int) $_POST['width'];

// build image path 
$image = DIR_BASE.DIR_IMG.$image_path.$image_filename;

// get original image size
$size = getimagesize($image);

// set original width & height
$width = $size[0];
$height = $size[1];

// get the optimum width
foreach($image_sizes as $k=>$v) {
	if((int) $v < $browser_width) {
		$width = (int)$v;
	}
}

// check we're not over re-sizing
if($width > $size[0]) {
	$width = $size[0];
}

// check if the original image can fit on screen
if($size[0] < $browser_width) {
	$width = $size[0];
}

// check against largest image size
$reverse = array_reverse($image_sizes);
if($size[0] > $reverse[0] && $browser_width > $reverse[0]) {
	$width = $reverse[0];
}

// build new filename
$new_image_name = $width.'_'.basename($image);

// check to see if cache directory exists
if (!is_dir(DIR_BASE.DIR_IMG.$image_path.'cache')) {
	mkdir(DIR_BASE.DIR_IMG.$image_path.'cache', 0777, true);
}

// new cache location
$new_image_loc = DIR_BASE.DIR_IMG.$image_path.'cache/';

// new cache image path
$new_image_path = $new_image_loc.$new_image_name;


// re-sized image already exists
if(file_exists($new_image_path)) {
	echo str_replace(DIR_BASE,"",$new_image_path);
	exit;
}

// *** 1) Initialise / load image
$resizeObj = new resize($image);
// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
$resizeObj->resizeImage($width, $height);
// *** 3) Save image
$resizeObj->saveImage($new_image_path, 80);

echo str_replace(DIR_BASE,"",$new_image_path);