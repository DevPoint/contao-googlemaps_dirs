<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2013 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @package    GoogleMapsDirs
 * @copyright  DevPoint | Wilfried Reiter 2013
 * @author     DevPoint | Wilfried Reiter <wilfried.reiter@devpoint.at>
 * @license    MIT
 */

class ModuleGoogleMapsDirections extends \Module {

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_googlemaps_directions';

    /**
     * Generate module
     */
    protected function compile()
    {
        // get map data
        $objMap = $this->Database->prepare("SELECT * FROM tl_dlh_googlemaps WHERE id=?")
            ->limit(1)
            ->execute($this->dlh_googlemap);
        $map = $objMap->fetchAssoc();

        // get elements data
        $objElements = $this->Database->prepare("SELECT * FROM tl_dlh_googlemaps_elements WHERE (pid=? and published=?) ORDER BY sorting")
            ->execute($map['id'],true);
        $map['elements'] = $objElements->fetchAllAssoc();
        $map['sensor'] = $map['sensor'] ? 'true' : 'false';
        $map['language'] = $GLOBALS['TL_LANGUAGE'];

        $this->import('dlh_googlemaps');
        $this->Template->map = $this->dlh_googlemaps->render_dlh_googlemap($this->Environment->base,$map,$this->dlh_googlemap_size,$this->dlh_googlemap_zoom);
        $this->Template->labels = $GLOBALS['TL_LANG']['googlemaps_dirs']['labels'];

        $GLOBALS['TL_JAVASCRIPT'][] = 'http'.($this->Environment->ssl ? 's' : '').'://maps.google.com/maps/api/js?language='.$map['language'].'&amp;sensor='.$map['sensor'];

    }
}
