<?php

namespace ContaoEstateManager\RegionEntity\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use ContaoEstateManager\RegionEntity\RegionRead;

/**
 * Handles the Region routes.
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class RegionController extends AbstractController
{
    /**
     * Runs the command scheduler. (READ)
     *
     * @param $module
     * @param $id
     *
     * @return JsonResponse|string
     */
    public function readAction($module, $id)
    {
        $this->container->get('contao.framework')->initialize();

        $controller = new RegionRead();

        return $controller->run($module, $id);
    }
}
