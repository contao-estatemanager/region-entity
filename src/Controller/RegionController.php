<?php

declare(strict_types=1);

namespace ContaoEstateManager\RegionEntity\Controller;

use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\StringUtil;
use ContaoEstateManager\RegionEntity\RegionModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(defaults={"_scope" = "frontend"})
 */
class RegionController
{
    /**
     * @var ContaoFramework
     */
    private $framework;

    public function __construct(ContaoFramework $framework)
    {
        $this->framework = $framework;
    }

    /**
     * Find regions by query
     *
     * Request:
     *   locale: Optional language parameter
     *
     * @Route("/region/all", name="region_query", defaults={"_token_check": false})
     */
    public function all(Request $request): JsonResponse
    {
        $this->framework->initialize();

        if($locale = $request->get('locale'))
        {
            $objRegions = RegionModel::findPublishedByLanguage($locale);
        }
        else
        {
            $objRegions = RegionModel::findByType('regular');
        }

        $arrMatches = [];

        foreach ($objRegions as $objRegion)
        {
            $arrMatch = $objRegion->row();
            $arrMatch['postalcodes'] = StringUtil::deserialize($objRegion->postalcodes);

            $arrMatches[] = $arrMatch;
        }

        return new JsonResponse([
            'results' => $arrMatches
        ]);
    }
}
