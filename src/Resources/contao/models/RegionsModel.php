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
 * @method static RegionsModel|null findById($id, array $opt=array())
 * @method static RegionsModel|null findByOid($id, array $opt=array())
 * @method static RegionsModel|null findByPk($id, array $opt=array())
 * @method static RegionsModel|null findOneBySorting($val, array $opt=array())
 * @method static RegionsModel|null findByIdOrAlias($val, array $opt=array())
 * @method static RegionsModel|null findOneBy($col, $val, array $opt=array())
 * @method static RegionsModel|null findOneByPid($val, array $opt=array())
 * @method static RegionsModel|null findOneByTstamp($val, array $opt=array())
 * @method static RegionsModel|null findOneByType($val, array $opt=array())
 * @method static RegionsModel|null findOneByTitle($val, array $opt=array())
 * @method static RegionsModel|null findOneByLanguage($val, array $opt=array())
 * @method static RegionsModel|null findOneByDescription($val, array $opt=array())
 * @method static RegionsModel|null findOneByPostalcodes($val, array $opt=array())
 * @method static RegionsModel|null findOneByState($val, array $opt=array())
 * @method static RegionsModel|null findOneByCountry($val, array $opt=array())
 * @method static RegionsModel|null findOneByPublished($val, array $opt=array())
 *
 * @method static \Model\Collection|RegionsModel[]|RegionsModel|null findByPid($val, array $opt=array())
 * @method static \Model\Collection|RegionsModel[]|RegionsModel|null findBySorting($val, array $opt=array())
 * @method static \Model\Collection|RegionsModel[]|RegionsModel|null findByTstamp($val, array $opt=array())
 * @method static \Model\Collection|RegionsModel[]|RegionsModel|null findByTitle($val, array $opt=array())
 * @method static \Model\Collection|RegionsModel[]|RegionsModel|null findByType($val, array $opt=array())
 * @method static \Model\Collection|RegionsModel[]|RegionsModel|null findByLanguage($val, array $opt=array())
 * @method static \Model\Collection|RegionsModel[]|RegionsModel|null findByDescription($val, array $opt=array())
 * @method static \Model\Collection|RegionsModel[]|RegionsModel|null findByPostalcodes($val, array $opt=array())
 * @method static \Model\Collection|RegionsModel[]|RegionsModel|null findByState($val, array $opt=array())
 * @method static \Model\Collection|RegionsModel[]|RegionsModel|null findByCountry($val, array $opt=array())
 * @method static \Model\Collection|RegionsModel[]|RegionsModel|null findByPublished($val, array $opt=array())
 * @method static \Model\Collection|RegionsModel[]|RegionsModel|null findMultipleByIds($var, array $opt=array())
 * @method static \Model\Collection|RegionsModel[]|RegionsModel|null findBy($col, $val, array $opt=array())
 * @method static \Model\Collection|RegionsModel[]|RegionsModel|null findAll(array $opt=array())
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
class RegionsModel extends \Model
{

    /**
     * Table name
     * @var string
     */
    protected static $strTable = 'tl_regions';
}
