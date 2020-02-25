<?php

namespace ContaoEstateManager\RegionEntity;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Region read controller.
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class RegionRead extends \Frontend
{
    /**
     * Method Constants
     */
    const METHOD_GET  = 'GET';
    const METHOD_POST = 'POST';

    /**
     * Current search string
     */
    protected $strSearchValue = '';

    /**
     * Current search fields
     */
    protected $arrSearchFields = ['title', 'postalcodes'];

    /**
     * Already searched parent ID's
     */
    protected $arrParentIds = [];

    /**
     * Run the controller
     *
     * @param String $module  Module-Name
     * @param int    $id      Id
     *
     * @return JsonResponse|string
     */
    public function run($module, $id)
    {
        $error = [
            'status' => 0,
            'message' => 'OK',
        ];

        switch ($module)
        {
            case 'search':
                $validParam = array('search', 'fields', 'language');
                $currParam  = $this->getParameters(self::METHOD_GET, $validParam);

                if(!$currParam['language'] || !$currParam['search'])
                {
                    $error = [
                        'status'  => 2,
                        'message' => "Missing parameter, make sure that 'search' and 'language' are passed."
                    ];

                    break;
                }

                if($currParam['fields'])
                {
                    $this->arrSearchFields = $currParam['fields'];
                }

                $root = RegionModel::findOneByLanguage($currParam['language']);

                if(!$root)
                {
                    $error = [
                        'status'  => 3,
                        'message' => "Language " . $currParam['language'] . " could not be found."
                    ];

                    break;
                }

                $arrResults  = [];

                // Set current search value
                $this->strSearchValue = $currParam['search'];

                $arrColumns = ['published=1', 'pid=?'];
                $arrValues  = [$root->id];

                $this->appendFieldSearchQuery( $arrColumns, $arrValues);

                // prepare results
                if($objRegions = RegionModel::findBy($arrColumns, $arrValues))
                {
                    $this->arrParentIds = [];

                    $this->subRegionsSearch($objRegions, $arrResults, true);
                    $result = $arrResults;
                }

                break;
            default:
                $result = null;
                $error = [
                    'status'  => 1,
                    'message' => "Module '$module' could not be found"
                ];
        }

        $data = array(
            'error' => $error,
            'data'  => $result
        );

        return new JsonResponse($data);
    }

    /**
     * Adds search parameters with specific fields to the column and value array
     *
     * @param $arrColumns
     * @param $arrValues
     */
    protected function appendFieldSearchQuery(&$arrColumns, &$arrValues)
    {
        $arrQuery = [];

        foreach ($this->arrSearchFields as $field)
        {
            switch ($field)
            {
                case 'title':
                    $arrQuery[] = $field . ' LIKE ?';
                    $arrValues[] = $this->strSearchValue . '%';
                    break;
                case 'postalcodes':
                    $arrQuery[] = $field . ' LIKE ?';
                    $arrValues[] = '%"'.$this->strSearchValue . '%"%';
                    break;
            }
        }

        $arrColumns[] = implode(' || ', $arrQuery);
    }

    /**
     * Returns all regions and their sub regions by current search parameter
     *
     * @param \Model\Collection|RegionModel[]|RegionModel|null $objRegion   Region object to start from
     * @param array  $arrRegions  Array in which the values are stored
     * @param bool   $asArray     Return results as array
     */
    public function subRegionsSearch($objRegion, &$arrRegions, $asArray=false)
    {
        while($objRegion->next())
        {
            if(!$asArray)
            {
                $arrRegions[ $objRegion->id ] = $objRegion->current();
            }
            else
            {
                $arrRegions[ $objRegion->id ] = $objRegion->row();

                if($arrRegions[ $objRegion->id ]['postalcodes'])
                {
                    $arrRegions[ $objRegion->id ]['postalcodes'] = \StringUtil::deserialize($arrRegions[ $objRegion->id ]['postalcodes']);
                }
            }

            if(in_array($objRegion->id, $this->arrParentIds)){
                continue;
            }

            $this->arrParentIds[] = $objRegion->id;

            $arrColumns = ['published=1', 'pid=?'];
            $arrValues   = [$objRegion->id];

            $this->appendFieldSearchQuery( $arrColumns, $arrValues);

            $objSubRegions = RegionModel::findBy($arrColumns, $arrValues);

            if($objSubRegions !== null)
            {
                $this->subRegionsSearch($objSubRegions, $arrRegions, $asArray);
            }
        }
    }

    /**
     * Return parameters by method
     *
     * @param $method
     * @param array $arrValidParam Array of valid parameters
     * @param array $arrDefaultParam Optional array of default parameters
     *
     * @return array
     */
    public function getParameters($method, $arrValidParam, $arrDefaultParam=array())
    {
        $arrMethod = array();
        $param = $arrDefaultParam;

        switch($method){
            case self::METHOD_GET:  $arrMethod = $_GET; break;
            case self::METHOD_POST: $arrMethod = $_POST; break;
        }

        foreach ($arrMethod as $key => $value)
        {
            if (in_array($key, $arrValidParam))
            {
                $param[$key] = $value;
            }
        }

        return $param;
    }
}
