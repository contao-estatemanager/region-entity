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

                if(!$currParam['fields'])
                {
                    $fields = array('title');
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

                $arrQuery    = [];
                $arrResults  = [];
                $arrCollumns = ['published=1', 'pid=?'];
                $arrValues   = [$root->id];

                // prepare field
                foreach ($fields as $field)
                {
                    switch ($field)
                    {
                        case 'title':
                            $arrQuery[] = $field . ' LIKE ?';
                            $arrValues[] = $currParam['search'] . '%';
                            break;
                    }
                }

                $arrCollumns[] = implode(' || ', $arrQuery);

                // prepare results
                if($objRegions = RegionModel::findBy($arrCollumns, $arrValues))
                {
                    while($objRegions->next())
                    {
                        $arrResults[ $objRegions->id ] = $objRegions->row();

                        if($arrResults[ $objRegions->id ]['postalcodes'])
                        {
                            $arrResults[ $objRegions->id ]['postalcodes'] = \StringUtil::deserialize($arrResults[ $objRegions->id ]['postalcodes']);
                        }
                    }

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
