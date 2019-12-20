<?php

namespace ContaoEstateManager\RegionEntity;

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
 * @method static \Model\Collection|RegionModel[]|RegionModel|null findByPid($val, array $opt=array())
 * @method static \Model\Collection|RegionModel[]|RegionModel|null findBySorting($val, array $opt=array())
 * @method static \Model\Collection|RegionModel[]|RegionModel|null findByTstamp($val, array $opt=array())
 * @method static \Model\Collection|RegionModel[]|RegionModel|null findByTitle($val, array $opt=array())
 * @method static \Model\Collection|RegionModel[]|RegionModel|null findByType($val, array $opt=array())
 * @method static \Model\Collection|RegionModel[]|RegionModel|null findByLanguage($val, array $opt=array())
 * @method static \Model\Collection|RegionModel[]|RegionModel|null findByDescription($val, array $opt=array())
 * @method static \Model\Collection|RegionModel[]|RegionModel|null findByPostalcodes($val, array $opt=array())
 * @method static \Model\Collection|RegionModel[]|RegionModel|null findByState($val, array $opt=array())
 * @method static \Model\Collection|RegionModel[]|RegionModel|null findByCountry($val, array $opt=array())
 * @method static \Model\Collection|RegionModel[]|RegionModel|null findByPublished($val, array $opt=array())
 * @method static \Model\Collection|RegionModel[]|RegionModel|null findMultipleByIds($var, array $opt=array())
 * @method static \Model\Collection|RegionModel[]|RegionModel|null findBy($col, $val, array $opt=array())
 * @method static \Model\Collection|RegionModel[]|RegionModel|null findAll(array $opt=array())
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
class RegionModel extends \Model
{

    /**
     * Table name
     * @var string
     */
    protected static $strTable = 'tl_region';
}
