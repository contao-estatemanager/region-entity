<?php

/**
 * This file is part of Oveleon Region Entity.
 *
 * (c) https://www.oveleon.de/
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */

// Back end modules
$GLOBALS['BE_MOD']['system']['regions'] = array
(
    'tables' => array('tl_region', 'tl_region_connection')
);

// Models
$GLOBALS['TL_MODELS']['tl_region'] = 'ContaoEstateManager\RegionEntity\RegionModel';
$GLOBALS['TL_MODELS']['tl_region_connection'] = 'ContaoEstateManager\RegionEntity\RegionConnectionModel';

// Back end form fields
$GLOBALS['BE_FFL']['regionTree'] = 'ContaoEstateManager\RegionEntity\RegionTree';

// Hooks
$GLOBALS['TL_HOOKS']['executePostActions'][] = array('ContaoEstateManager\RegionEntity\Ajax', 'executePostActions');
