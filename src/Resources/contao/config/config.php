<?php

/**
 * This file is part of Oveleon Region Entity.
 *
 * (c) https://www.oveleon.de/
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */

// Back end modules
$GLOBALS['BE_MOD']['content']['regions'] = array
(
    'tables' => array('tl_region', 'tl_region_connection')
);

// Models
$GLOBALS['TL_MODELS']['tl_region'] = 'ContaoEstateManager\RegionEntity\RegionModel';
$GLOBALS['TL_MODELS']['tl_region_connection'] = 'ContaoEstateManager\RegionEntity\RegionConnectionModel';
