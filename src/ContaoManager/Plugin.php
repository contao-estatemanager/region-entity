<?php

/*
 * This file is part of Oveleon Region Entity.
 *
 * (c) https://www.oveleon.de/
 */

declare(strict_types=1);

namespace ContaoEstateManager\RegionEntity\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use ContaoEstateManager\RegionEntity\RegionEntity;

class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(RegionEntity::class)
                ->setLoadAfter([ContaoCoreBundle::class])
                ->setReplace(['region-entity']),
        ];
    }
}
