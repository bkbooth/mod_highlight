<?php
/**
* Highlight Module
* 2011 Benjamin Booth
* @bkbooth11
* bkbooth@facebook.com
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// Include the syndicate functions only once
require_once (dirname(__FILE__).DS.'helper.php');

// Read in the parameters
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
$images_folder = $params->get('images_folder',		'images/polaroids');
$images_width = $params->get('images_width',		788);
$images_height = $params->get('images_height',		358);
$transition_time = $params->get('transition_time',	1000);
$image_time = $params->get('image_time',			5000);

$images_path = JPATH_SITE.DS.$images_folder;
$images_url = JURI::base().$images_folder;

$images_list = modHighlightHelper::getImagesList($images_path);
$images_urls = modHighlightHelper::getImagesURLs($images_path, $images_list);

require(JModuleHelper::getLayoutPath('mod_highlight', $params->get('layout', 'default')));

?>
