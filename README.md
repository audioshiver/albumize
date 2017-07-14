# Albumize
Albumize is a snippet of code that lists images from a directory responsively. This code uses James Fairhurst's [Responsive Images with PHP and jQuery] (http://www.jamesfairhurst.co.uk/posts/view/responsive_images_with_php_and_jquery) script with added PHP to list images within a directory.

## Features
* List images inside a directory
* Automatically resize & cache images inside cache/ folder, which is automatically created
* Javascript will call cached images if window is resized

## Installation
* Copy the resize/ folder and config.php file to your root directory
* Add require('albumize/get_images.php') in your HTML
* Modify config.php as necessary
* Call PHP function with get_images('x'); where x is the directory in which the images are saved.

### Things not working
For some reason, portrait and square images will not resize. working on it.