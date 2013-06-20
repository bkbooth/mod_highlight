<?php
/**
* Highlight Module
* 2011 Benjamin Booth
* @bkbooth11
* bkbooth@facebook.com
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once (JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');

class modHighlightHelper
{
	// Get the images
	function getImagesList($images_path) {
		$images_list = array();
		if ($handle = opendir($images_path)) {
			while (false !== ($file = readdir($handle))) {
				if ($file != "." && $file != ".." && is_file($images_path.DS.$file) && getimagesize($images_path.DS.$file)) {
					array_push($images_list, $file);
				}
			}
			closedir($handle);
		}
		sort($images_list);
		return $images_list;
	} // function getImagesList
	
	// Read the associated text file with each image and return an array of details
	function getImagesURLs($images_path, $images_list) {
		$images_urls = array();
		foreach ($images_list as $image) {
			$details_file = substr($image, 0, strrpos($image, '.')) . '.txt';
			$details = array();
			$handle = fopen($images_path.DS.$details_file, 'r');
			$temp = str_replace(array("\r", "\n"), "", fgets($handle));
			array_push($images_urls, $temp);
			fclose($handle);
		}
		return $images_urls;
	} // function getImagesDetails

} // class modHighlightHelper
?>
