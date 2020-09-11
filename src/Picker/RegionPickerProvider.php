<?php
/**
 * This file is part of Oveleon Region Entity.
 *
 * Copied from PagePickerProvider
 * @author Leo Feyer <https://github.com/leofeyer>
 *
 * RegionPickerProvider
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */

declare(strict_types=1);

namespace ContaoEstateManager\RegionEntity\Picker;

use Contao\CoreBundle\Picker\AbstractInsertTagPickerProvider;
use Contao\CoreBundle\Picker\DcaPickerProviderInterface;
use Contao\CoreBundle\Picker\PickerConfig;

use Knp\Menu\FactoryInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Translation\TranslatorInterface;

class RegionPickerProvider extends AbstractInsertTagPickerProvider implements DcaPickerProviderInterface
{
    /**
     * @var Security
     */
    private $security;

    public function __construct(FactoryInterface $menuFactory, RouterInterface $router, ?TranslatorInterface $translator, Security $security)
    {
        parent::__construct($menuFactory, $router, $translator);

        $this->security = $security;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'regionPicker';
    }

    /**
     * {@inheritdoc}
     */
    public function supportsContext($context): bool
    {
        return in_array($context, ['region', 'link'], true) && $this->security->isGranted('contao_user.modules', 'region');
    }

    /**
     * {@inheritdoc}
     */
    public function supportsValue(PickerConfig $config): bool
    {
        if ('region' === $config->getContext()) {
            return is_numeric($config->getValue());
        }

        return $this->isMatchingInsertTag($config);
    }

    /**
     * {@inheritdoc}
     */
    public function getDcaTable(): string
    {
        return 'tl_region';
    }

    /**
     * {@inheritdoc}
     */
    public function getDcaAttributes(PickerConfig $config): array
    {
        $value = $config->getValue();
        $attributes = ['fieldType' => 'radio'];

        if ('region' === $config->getContext()) {
            if ($fieldType = $config->getExtra('fieldType')) {
                $attributes['fieldType'] = $fieldType;
            }

            if ($source = $config->getExtra('source')) {
                $attributes['preserveRecord'] = $source;
            }

            if (is_array($rootNodes = $config->getExtra('rootNodes'))) {
                $attributes['rootNodes'] = $rootNodes;
            }

            if ($value) {
                $attributes['value'] = array_map('\intval', explode(',', $value));
            }

            return $attributes;
        }

        $chunks = $this->getInsertTagChunks($config);

        if ($value && false !== strpos($value, $chunks[0])) {
            $attributes['value'] = str_replace($chunks, '', $value);
        }

        return $attributes;
    }

    /**
     * {@inheritdoc}
     */
    public function convertDcaValue(PickerConfig $config, $value)
    {
        if ('region' === $config->getContext()) {
            return (int) $value;
        }

        return sprintf($this->getInsertTag($config), $value);
    }

    /**
     * {@inheritdoc}
     */
    protected function getRouteParameters(PickerConfig $config = null): array
    {
        return ['do' => 'regions'];
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefaultInsertTag(): string
    {
        return '{{region::%s}}';
    }
}
