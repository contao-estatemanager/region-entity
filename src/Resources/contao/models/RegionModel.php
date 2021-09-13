<?php

namespace ContaoEstateManager\RegionEntity;

use Contao\Model;

/**
 * Reads and writes Regions
 *
 * @property integer $id
 * @property integer $pid
 * @property integer $oid
 * @property integer $sorting
 * @property integer $tstamp
 * @property integer $type
 * @property string  $title
 * @property string  $language
 * @property string  $description
 * @property string  $postalcodes
 * @property string  $country
 * @property string  $state
 * @property boolean $published
 *
 * @method static RegionModel|null findById($id, array $opt=array())
 * @method static RegionModel|null findByOid($id, array $opt=array())
 * @method static RegionModel|null findByPk($id, array $opt=array())
 * @method static RegionModel|null findOneBySorting($val, array $opt=array())
 * @method static RegionModel|null findByIdOrAlias($val, array $opt=array())
 * @method static RegionModel|null findOneBy($col, $val, array $opt=array())
 * @method static RegionModel|null findOneByPid($val, array $opt=array())
 * @method static RegionModel|null findOneByTstamp($val, array $opt=array())
 * @method static RegionModel|null findOneByType($val, array $opt=array())
 * @method static RegionModel|null findOneByTitle($val, array $opt=array())
 * @method static RegionModel|null findOneByLanguage($val, array $opt=array())
 * @method static RegionModel|null findOneByDescription($val, array $opt=array())
 * @method static RegionModel|null findOneByPostalcodes($val, array $opt=array())
 * @method static RegionModel|null findOneByState($val, array $opt=array())
 * @method static RegionModel|null findOneByCountry($val, array $opt=array())
 * @method static RegionModel|null findOneByPublished($val, array $opt=array())
 *
 * @method static Model\Collection|RegionModel[]|RegionModel|null findByPid($val, array $opt=array())
 * @method static Model\Collection|RegionModel[]|RegionModel|null findBySorting($val, array $opt=array())
 * @method static Model\Collection|RegionModel[]|RegionModel|null findByTstamp($val, array $opt=array())
 * @method static Model\Collection|RegionModel[]|RegionModel|null findByTitle($val, array $opt=array())
 * @method static Model\Collection|RegionModel[]|RegionModel|null findByType($val, array $opt=array())
 * @method static Model\Collection|RegionModel[]|RegionModel|null findByLanguage($val, array $opt=array())
 * @method static Model\Collection|RegionModel[]|RegionModel|null findByDescription($val, array $opt=array())
 * @method static Model\Collection|RegionModel[]|RegionModel|null findByPostalcodes($val, array $opt=array())
 * @method static Model\Collection|RegionModel[]|RegionModel|null findByState($val, array $opt=array())
 * @method static Model\Collection|RegionModel[]|RegionModel|null findByCountry($val, array $opt=array())
 * @method static Model\Collection|RegionModel[]|RegionModel|null findByPublished($val, array $opt=array())
 * @method static Model\Collection|RegionModel[]|RegionModel|null findMultipleByIds($var, array $opt=array())
 * @method static Model\Collection|RegionModel[]|RegionModel|null findBy($col, $val, array $opt=array())
 * @method static Model\Collection|RegionModel[]|RegionModel|null findAll(array $opt=array())
 *
 * @method static integer countById($id, array $opt=array())
 * @method static integer countByOid($val, array $opt=array())
 * @method static integer countByPid($val, array $opt=array())
 * @method static integer countBySorting($val, array $opt=array())
 * @method static integer countByTitle($val, array $opt=array())
 * @method static integer countByType($val, array $opt=array())
 * @method static integer countByLanguage($val, array $opt=array())
 * @method static integer countByDescription($val, array $opt=array())
 * @method static integer countByPostalcodes($val, array $opt=array())
 * @method static integer countByState($val, array $opt=array())
 * @method static integer countByCountry($val, array $opt=array())
 * @method static integer countByTstamp($val, array $opt=array())
 * @method static integer countByPublished($val, array $opt=array())
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class RegionModel extends Model
{
    /**
     * Table name
     * @var string
     */
    protected static $strTable = 'tl_region';

    /**
     * Find published regions by its parent ID's
     *
     * @param integer $intId      The region PID
     * @param array   $arrOptions An optional options array
     *
     * @return Model\Collection|RegionModel[]|RegionModel|null The model collection or null if there is no published region
     */
    public static function findPublishedByPid($intId, array $arrOptions=array())
    {
        $t = static::$strTable;

        $arrColumns = array(
            "$t.pid=?",
            "$t.published=1"
        );

        return static::findBy($arrColumns, $intId, $arrOptions);
    }

    /**
     * Find published root by language
     *
     * @param string $strLocale
     *
     * @return array|RegionModel|null
     */
    public static function findPublishedRootByLanguage(string $strLocale): ?RegionModel
    {
        $t = static::$strTable;

        $arrColumns = array(
            "$t.type=?",
            "$t.language=?",
            "$t.published=?"
        );

        $arrValues = [
            'root',
            $strLocale,
            1
        ];

        return static::findOneBy($arrColumns, $arrValues);
    }

    /**
     * Find published regions by language
     *
     * @param string  $strLocale  The locale string
     * @param array   $arrOptions An optional options array
     *
     * @return array|null The model collection or null if there is no published region
     */
    public static function findPublishedByLanguage(string $strLocale, array $arrOptions=array()): ?array
    {
        $objRoot = static::findPublishedRootByLanguage($strLocale);

        if(null === $objRoot)
        {
            return null;
        }

        $arrRegions = [];

        // Add region children
        static::addSubRegions([$objRoot->id], $arrRegions, $arrOptions);

        if(count($arrRegions))
        {
            return $arrRegions;
        }

        return null;
    }

    /**
     * Add subregions
     *
     * @param array|null $arrRegionsIds
     * @param array $arrRegions
     * @param array|null $arrOptions
     */
    private static function addSubRegions(?array $arrRegionsIds, array &$arrRegions, ?array $arrOptions=null): void
    {
        if(null === $arrRegionsIds)
        {
            return;
        }

        $t = static::$strTable;

        $arrColumns = [
            "$t.pid IN (?)",
            "$t.published=?"
        ];

        $arrValues = [
            implode(",", $arrRegionsIds),
            1
        ];

        $objSubRegions = static::findBy($arrColumns, $arrValues, $arrOptions);
        $arrTmpRegions = [];

        if(null === $objSubRegions)
        {
            return;
        }

        foreach ($objSubRegions as $objRegion)
        {
            $arrTmpRegions[$objRegion->id] = $objRegion;
        }

        // Add region to collection
        $arrRegions = array_merge($arrRegions, $arrTmpRegions);

        // Find and add subregions
        static::addSubRegions(array_keys($arrTmpRegions), $arrRegions, $arrOptions);
    }
}
