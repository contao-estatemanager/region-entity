<?php

/*
 * This file is part of Oveleon Region Entity.
 *
 * (c) https://www.oveleon.de/
 */

// Back end modules
array_insert($GLOBALS['BE_MOD'], 1, array
(
    'real_estate' => array
    (
        'regions' => array
        (
            'tables'        => array('tl_regions')
        )
    )
));

// Models
$GLOBALS['TL_MODELS']['tl_regions']  = '\\ContaoEstateManager\\RegionEntity\\RegionsModel';

// Add permissions
$GLOBALS['TL_PERMISSIONS'][] = 'regions';
