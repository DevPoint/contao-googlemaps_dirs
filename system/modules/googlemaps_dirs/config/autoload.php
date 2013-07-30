<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 * 
 * @package    GoogleMapsDirs
 * @copyright  DevPoint | Wilfried Reiter 2013
 * @author     DevPoint | Wilfried Reiter <wilfried.reiter@devpoint.at>
 * @link       http://contao.org
 * @license    MIT
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'ModuleGoogleMapsDirections' => 'system/modules/googlemaps_dirs/modules/ModuleGoogleMapsDirections.php'
));

/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_googlemaps_directions'	=> 'system/modules/googlemaps_dirs/templates'
));
