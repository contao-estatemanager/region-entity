<?php

/**
 * This file is part of Oveleon Region Entity.
 *
 * (c) https://www.oveleon.de/
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */

// Back end modules
if(isset($GLOBALS['BE_MOD']['real_estate']))
{
    $GLOBALS['BE_MOD']['real_estate']['regions'] = array('tables' => array('tl_regions'));
}
else
{
    array_insert($GLOBALS['BE_MOD'], 1, array
    (
        'real_estate' => array
        (
            'regions' => array
            (
                'tables' => array('tl_regions')
            )
        )
    ));
}

// Models
$GLOBALS['TL_MODELS']['tl_regions'] = '\\ContaoEstateManager\\RegionEntity\\RegionsModel';

// Add permissions
$GLOBALS['TL_PERMISSIONS'][] = 'regions';

// Back end form fields
$GLOBALS['BE_FFL']['regionTree'] = '\\ContaoEstateManager\\RegionEntity\\RegionTree';

// Hooks
$GLOBALS['TL_HOOKS']['executePostActions'][] = array('\\ContaoEstateManager\\RegionEntity\\Ajax', 'executePostActions');
