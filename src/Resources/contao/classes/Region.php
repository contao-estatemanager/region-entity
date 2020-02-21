<?php

/**
 * This file is part of Oveleon Region Entity.
 *
 * (c) https://www.oveleon.de/
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */

namespace ContaoEstateManager\RegionEntity;

class Region extends \Backend
{

    /**
     * Save connection from save callback
     *
     * @param $varValue
     * @param \DataContainer $dc
     *
     * @return string
     */
    public function regionConnectionSaveCallback($varValue, \DataContainer $dc)
    {
        $strTable = $dc->table;

        if($GLOBALS['TL_DCA'][ $strTable ]['fields'][ $dc->field ]['inputType'] === 'regionTree')
        {
            $arrRegions = \StringUtil::deserialize($varValue);

            // delete previous connections
            RegionConnectionModel::deleteByPidAndPtable($dc->activeRecord->id, $strTable);

            if($arrRegions !== null)
            {
                foreach ($arrRegions as $regionId)
                {
                    $this->saveConnectionRecord($regionId, $dc->activeRecord->id, $strTable);
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
    public function saveConnectionRecord($rid, $pid, $ptable)
    {
        $objConnection = new RegionConnectionModel();
        $objConnection->rid = $rid;
        $objConnection->pid = $pid;
        $objConnection->ptable = $ptable;

        $objConnection->save();
    }
}