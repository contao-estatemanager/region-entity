<?php

namespace ContaoEstateManager\RegionEntity;

/**
 * Reads and writes Regions
 *
 * @property integer $rid
 * @property integer $pid
 * @property integer $ptable
 *
 * @method static RegionConnectionModel|null findOneByRid($id, array $opt=array())
 * @method static RegionConnectionModel|null findOneByPid($id, array $opt=array())
 * @method static RegionConnectionModel|null findOneByPtable($id, array $opt=array())
 *
 * @method static \Model\Collection|RegionConnectionModel[]|RegionConnectionModel|null findByRid($val, array $opt=array())
 * @method static \Model\Collection|RegionConnectionModel[]|RegionConnectionModel|null findByPid($val, array $opt=array())
 * @method static \Model\Collection|RegionConnectionModel[]|RegionConnectionModel|null findByPtable($val, array $opt=array())
 *
 * @method static integer countByRid($id, array $opt=array())
 * @method static integer countByPid($val, array $opt=array())
 * @method static integer countByPtable($val, array $opt=array())
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class RegionConnectionModel extends \Model
{

    /**
     * Table name
     * @var string
     */
    protected static $strTable = 'tl_region_connection';

    /**
     * Delete connections by pid and ptable
     *
     * @param $pid
     * @param $ptable
     */
    public static function deleteByPidAndPtable($pid, $ptable)
    {
        $strTable = static::$strTable;

        $objDatabase = \Database::getInstance();
        $objDatabase->prepare('DELETE FROM ' . $strTable . ' WHERE pid=' . $pid . ' AND ptable="' . $ptable . '"')->execute();
    }
}
