<?php

/**
 * This file is part of Oveleon Region Entity.
 *
 * (c) https://www.oveleon.de/
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */

namespace ContaoEstateManager\RegionEntity;

use Contao\Backend;
use Contao\DataContainer;
use Contao\StringUtil;

class Region extends Backend
{

    /**
     * Save connection from save callback
     *
     * @param $varValue
     * @param DataContainer $dc
     *
     * @return null|string
     */
    public function regionConnectionSaveCallback($varValue, DataContainer $dc): ?string
    {
        $strTable = $dc->table;

        if($GLOBALS['TL_DCA'][ $strTable ]['fields'][ $dc->field ]['inputType'] === 'regionTree')
        {
            $arrRegions = StringUtil::deserialize($varValue);

            // delete previous connections
            RegionConnectionModel::deleteByPidAndPtable($dc->activeRecord->id, $strTable);

            if($arrRegions !== null)
            {
                foreach ($arrRegions as $regionId)
                {
                    static::saveConnectionRecord($regionId, $dc->activeRecord->id, $strTable);
                }
            }
        }

        return $varValue;
    }

    /**
     * Save connections
     *
     * @param $rid
     * @param $pid
     * @param $ptable
     */
    public static function saveConnectionRecord($rid, $pid, $ptable): void
    {
        $objConnection = new RegionConnectionModel();
        $objConnection->rid = $rid;
        $objConnection->pid = $pid;
        $objConnection->ptable = $ptable;

        $objConnection->save();
    }
}
