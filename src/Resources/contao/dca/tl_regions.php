<?php
/*
 * This file is part of Oveleon Region Entity.
 *
 * (c) https://www.oveleon.de/
 */

$GLOBALS['TL_DCA']['tl_regions'] = array
(
	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'markAsCopy'                  => 'title',
        'onload_callback' => array
        (
            array('tl_regions', 'setRootType'),
            array('tl_regions', 'translateRootTitle')
        ),
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
				'published,oid' => 'index'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
            'mode'                    => 5,
            'icon'                    => 'pagemounts.svg',
            'paste_button_callback'   => array('tl_regions', 'pasteRegion'),
            'panelLayout'             => 'filter;search'
		),
        'label' => array
        (
            'fields'                  => array('title'),
            'format'                  => '%s',
            'label_callback'          => array('tl_regions', 'addLanguage')
        ),
		'global_operations' => array
		(
			'all' => array
			(
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			)
		),
		'operations' => array
		(
            'edit' => array
            (
                'href'                => 'act=edit',
                'icon'                => 'edit.svg',
                'button_callback'     => array('tl_regions', 'editRegion')
            ),
            'copy' => array
            (
                'href'                => 'act=paste&amp;mode=copy',
                'icon'                => 'copy.svg',
                'attributes'          => 'onclick="Backend.getScrollOffset()"',
                'button_callback'     => array('tl_regions', 'copyRegion')
            ),
            'copyChilds' => array
            (
                'href'                => 'act=paste&amp;mode=copy&amp;childs=1',
                'icon'                => 'copychilds.svg',
                'attributes'          => 'onclick="Backend.getScrollOffset()"',
                'button_callback'     => array('tl_regions', 'copyRegionWithSubregions')
            ),
            'cut' => array
            (
                'href'                => 'act=paste&amp;mode=cut',
                'icon'                => 'cut.svg',
                'attributes'          => 'onclick="Backend.getScrollOffset()"',
                'button_callback'     => array('tl_regions', 'cutRegion')
            ),
            'delete' => array
            (
                'href'                => 'act=delete',
                'icon'                => 'delete.svg',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
                'button_callback'     => array('tl_regions', 'deleteRegion')
            ),
            'toggle' => array
            (
                'icon'                => 'visible.svg',
                'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback'     => array('tl_regions', 'toggleIcon')
            ),
            'show' => array
            (
                'href'                => 'act=show',
                'icon'                => 'show.svg'
            )
		)
	),

	// Palettes
	'palettes' => array
	(
        '__selector__'                => array('type'),
        'default'                     => '{title_legend},title,type',
        'root'                        => '{title_legend},title,type;{config_legend},language;{publish_legend},published',
        'regular'                     => '{title_legend},title,type;{publish_legend},published'
	),

    // Fields
	'fields' => array
	(
		'id' => array
		(
            'label'                   => array('ID'),
            'search'                  => true,
            'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'pid' => array
		(
            'sql'                     => "int(10) unsigned NOT NULL default 0"
		),
        'sorting' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default 0"
        ),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default 0"
		),
		'oid' => array
		(
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'title' => array
		(
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
        'type' => array
        (
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'select',
            'options'                 => array('root', 'regular'),
            'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'w50'),
            'reference'               => &$GLOBALS['TL_LANG']['tl_regions'],
            'save_callback' => array
            (
                array('tl_regions', 'checkRootType')
            ),
            'sql'                     => "varchar(64) NOT NULL default 'regular'"
        ),
        'language' => array
        (
            'exclude'                 => true,
            'search'                  => true,
            'sorting'                 => true,
            'flag'                    => 1,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'description' => array
        (
            'inputType'               => 'textarea',
            'eval'                    => array('rte'=>'tinyMCE', 'tl_class'=>'clr'),
            'sql'                     => "text NULL"
        ),
        'postalcodes' => array
        (
            'inputType'               => 'listWizard',
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "text NULL"
        ),
        'state' => array
        (
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'country' => array
        (
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'published' => array
        (
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('doNotCopy'=>true),
            'sql'                     => "char(1) NOT NULL default ''"
        )
	)
);

/**
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */

use ContaoEstateManager\RegionEntity\RegionsModel;

class tl_regions extends \Backend
{
	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

    /**
     * Add language
     *
     * @param array                $row
     * @param string               $label
     * @param DataContainer        $dc
     * @param string               $imageAttribute
     * @param boolean              $blnReturnImage
     * @param boolean              $blnProtected
     *
     * @return string
     */
    public function addLanguage($row, $label, DataContainer $dc=null, $imageAttribute='', $blnReturnImage=false, $blnProtected=false)
    {
        if($row['type'] === 'root')
        {
            $label .= ' <span style="color:#999;padding-left:3px">[' . $row['language'] . ']</span>';
        }
        else
        {
            $label .= ' <span style="color:#999;padding-left:3px">[' . $row['oid'] . ']</span>';
        }

        $image = 'root';

        return '<a href="javascript:;">' . \Image::getHtml(($row['published'] ? $image : $image . '_1') . '.svg', '', 'data-icon="' . $image . '.svg" data-icon-disabled="' . $image . '_1.svg"') . '</a> ' . $label;
    }

    /**
     * Make new top-level regions root regions
     *
     * @param DataContainer $dc
     */
    public function translateRootTitle(DataContainer $dc)
    {
        $GLOBALS['TL_LANG']['MSC']['pageManager'] = &$GLOBALS['TL_LANG']['tl_regions']['pageManager'];
    }

    /**
     * Make new top-level regions root regions
     *
     * @param DataContainer $dc
     */
    public function setRootType(DataContainer $dc)
    {
        if (\Input::get('act') != 'create')
        {
            return;
        }

        // Insert into
        if (\Input::get('pid') == 0)
        {
            $GLOBALS['TL_DCA']['tl_regions']['fields']['type']['default'] = 'root';
        }
        elseif (\Input::get('mode') == 1)
        {
            $objPage = $this->Database->prepare("SELECT * FROM " . $dc->table . " WHERE id=?")
                ->limit(1)
                ->execute(\Input::get('pid'));

            if ($objPage->pid == 0)
            {
                $GLOBALS['TL_DCA']['tl_regions']['fields']['type']['default'] = 'root';
            }
        }
    }

    /**
     * Make sure that top-level pages are root pages
     *
     * @param mixed                $varValue
     * @param DataContainer $dc
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function checkRootType($varValue, DataContainer $dc)
    {
        if ($varValue != 'root' && $dc->activeRecord->pid == 0)
        {
            throw new Exception($GLOBALS['TL_LANG']['ERR']['topLevelRoot']);
        }

        return $varValue;
    }

    /**
     * Return the paste region button
     *
     * @param DataContainer $dc
     * @param array                $row
     * @param string               $table
     * @param boolean              $cr
     * @param array                $arrClipboard
     *
     * @return string
     */
    public function pasteRegion(DataContainer $dc, $row, $table, $cr, $arrClipboard=null)
    {
        $disablePA = false;
        $disablePI = false;

        // Disable all buttons if there is a circular reference
        if ($arrClipboard !== false && (($arrClipboard['mode'] == 'cut' && ($cr == 1 || $arrClipboard['id'] == $row['id'])) || ($arrClipboard['mode'] == 'cutAll' && ($cr == 1 || in_array($row['id'], $arrClipboard['id'])))))
        {
            $disablePA = true;
            $disablePI = true;
        }

        $return = '';

        // Return the buttons
        $imagePasteAfter = \Image::getHtml('pasteafter.svg', sprintf($GLOBALS['TL_LANG'][$table]['pasteafter'][1], $row['id']));
        $imagePasteInto = \Image::getHtml('pasteinto.svg', sprintf($GLOBALS['TL_LANG'][$table]['pasteinto'][1], $row['id']));

        if ($row['id'] > 0)
        {
            $return = $disablePA ? \Image::getHtml('pasteafter_.svg') . ' ' : '<a href="' . $this->addToUrl('act=' . $arrClipboard['mode'] . '&amp;mode=1&amp;pid=' . $row['id'] . (!is_array($arrClipboard['id']) ? '&amp;id=' . $arrClipboard['id'] : '')) . '" title="' . \StringUtil::specialchars(sprintf($GLOBALS['TL_LANG'][$table]['pasteafter'][1], $row['id'])) . '" onclick="Backend.getScrollOffset()">' . $imagePasteAfter . '</a> ';
        }

        return $return . ($disablePI ? \Image::getHtml('pasteinto_.svg') . ' ' : '<a href="' . $this->addToUrl('act=' . $arrClipboard['mode'] . '&amp;mode=2&amp;pid=' . $row['id'] . (!is_array($arrClipboard['id']) ? '&amp;id=' . $arrClipboard['id'] : '')) . '" title="' . \StringUtil::specialchars(sprintf($GLOBALS['TL_LANG'][$table]['pasteinto'][$row['id'] > 0 ? 1 : 0], $row['id'])) . '" onclick="Backend.getScrollOffset()">' . $imagePasteInto . '</a> ');
    }

    /**
     * Return the edit region button
     *
     * @param array  $row
     * @param string $href
     * @param string $label
     * @param string $title
     * @param string $icon
     * @param string $attributes
     *
     * @return string
     */
    public function editRegion($row, $href, $label, $title, $icon, $attributes)
    {
        return ($this->User->hasAccess('regions', 'alpty')) ? '<a href="' . $this->addToUrl($href . '&amp;id=' . $row['id']) . '" title="' . \StringUtil::specialchars($title) . '"' . $attributes . '>' . \Image::getHtml($icon, $label) . '</a> ' : \Image::getHtml(preg_replace('/\.svg$/i', '_.svg', $icon)) . ' ';
    }

    /**
     * Return the copy region button
     *
     * @param array  $row
     * @param string $href
     * @param string $label
     * @param string $title
     * @param string $icon
     * @param string $attributes
     * @param string $table
     *
     * @return string
     */
    public function copyRegion($row, $href, $label, $title, $icon, $attributes, $table)
    {
        if ($GLOBALS['TL_DCA'][$table]['config']['closed'])
        {
            return '';
        }

        return ($this->User->hasAccess('regions', 'alpty')) ? '<a href="' . $this->addToUrl($href . '&amp;id=' . $row['id']) . '" title="' . \StringUtil::specialchars($title) . '"' . $attributes . '>' . \Image::getHtml($icon, $label) . '</a> ' : \Image::getHtml(preg_replace('/\.svg$/i', '_.svg', $icon)) . ' ';
    }

    /**
     * Return the copy region with subregions button
     *
     * @param array  $row
     * @param string $href
     * @param string $label
     * @param string $title
     * @param string $icon
     * @param string $attributes
     * @param string $table
     *
     * @return string
     */
    public function copyRegionWithSubregions($row, $href, $label, $title, $icon, $attributes, $table)
    {
        if ($GLOBALS['TL_DCA'][$table]['config']['closed'])
        {
            return '';
        }

        $objSubregions = RegionsModel::findByPid($row['id']);

        return ($objSubregions !== null && $objSubregions->count() > 0 && $this->User->hasAccess('regions', 'alpty')) ? '<a href="' . $this->addToUrl($href . '&amp;id=' . $row['id']) . '" title="' . \StringUtil::specialchars($title) . '"' . $attributes . '>' . \Image::getHtml($icon, $label) . '</a> ' : \Image::getHtml(preg_replace('/\.svg$/i', '_.svg', $icon)) . ' ';
    }

    /**
     * Return the cut region button
     *
     * @param array  $row
     * @param string $href
     * @param string $label
     * @param string $title
     * @param string $icon
     * @param string $attributes
     *
     * @return string
     */
    public function cutRegion($row, $href, $label, $title, $icon, $attributes)
    {
        return ($this->User->hasAccess('regions', 'alpty')) ? '<a href="' . $this->addToUrl($href . '&amp;id=' . $row['id']) . '" title="' . \StringUtil::specialchars($title) . '"' . $attributes . '>' . \Image::getHtml($icon, $label) . '</a> ' : \Image::getHtml(preg_replace('/\.svg$/i', '_.svg', $icon)) . ' ';
    }

    /**
     * Return the delete region button
     *
     * @param array  $row
     * @param string $href
     * @param string $label
     * @param string $title
     * @param string $icon
     * @param string $attributes
     *
     * @return string
     */
    public function deleteRegion($row, $href, $label, $title, $icon, $attributes)
    {
        $root = func_get_arg(7);

        return ($this->User->hasAccess('regions', 'alpty')) ? '<a href="' . $this->addToUrl($href . '&amp;id=' . $row['id']) . '" title="' . \StringUtil::specialchars($title) . '"' . $attributes . '>' . \Image::getHtml($icon, $label) . '</a> ' : \Image::getHtml(preg_replace('/\.svg$/i', '_.svg', $icon)) . ' ';
    }

    /**
     * Return the "toggle visibility" button
     *
     * @param array  $row
     * @param string $href
     * @param string $label
     * @param string $title
     * @param string $icon
     * @param string $attributes
     *
     * @return string
     */
    public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
    {
        if (\Input::get('tid'))
        {
            $this->toggleVisibility(\Input::get('tid'), (\Input::get('state') == 1), (@func_get_arg(12) ?: null));
            $this->redirect($this->getReferer());
        }

        // Check permissions AFTER checking the tid, so hacking attempts are logged
        if (!$this->User->hasAccess('tl_regions::published', 'alexf'))
        {
            return '';
        }

        $href .= '&amp;tid=' . $row['id'] . '&amp;state=' . ($row['published'] ? '' : 1);

        if (!$row['published'])
        {
            $icon = 'invisible.svg';
        }

        if (!$this->User->hasAccess('regions', 'alpty') || ($objRegion = RegionsModel::findById($row['id'])) === null)
        {
            return \Image::getHtml($icon) . ' ';
        }

        return '<a href="' . $this->addToUrl($href) . '" title="' . \StringUtil::specialchars($title) . '"' . $attributes . '>' . \Image::getHtml($icon, $label, 'data-state="' . ($row['published'] ? 1 : 0) . '"') . '</a> ';
    }

    /**
     * Disable/enable a user group
     *
     * @param integer              $intId
     * @param boolean              $blnVisible
     * @param \DataContainer $dc
     *
     * @throws \CoreBundle\Exception\AccessDeniedException
     */
    public function toggleVisibility($intId, $blnVisible, \DataContainer $dc=null)
    {
        // Set the ID and action
        \Input::setGet('id', $intId);
        \Input::setGet('act', 'toggle');

        if ($dc)
        {
            $dc->id = $intId; // see #8043
        }

        // Trigger the onload_callback
        if (is_array($GLOBALS['TL_DCA']['tl_regions']['config']['onload_callback']))
        {
            foreach ($GLOBALS['TL_DCA']['tl_regions']['config']['onload_callback'] as $callback)
            {
                if (is_array($callback))
                {
                    $this->import($callback[0]);
                    $this->{$callback[0]}->{$callback[1]}($dc);
                }
                elseif (is_callable($callback))
                {
                    $callback($dc);
                }
            }
        }

        // Check the field access
        if (!$this->User->hasAccess('tl_regions::published', 'alexf'))
        {
            throw new \CoreBundle\Exception\AccessDeniedException('Not enough permissions to publish/unpublish region ID ' . $intId . '.');
        }

        // Set the current record
        if ($dc)
        {
            $objRow = $this->Database->prepare("SELECT * FROM tl_regions WHERE id=?")
                ->limit(1)
                ->execute($intId);

            if ($objRow->numRows)
            {
                $dc->activeRecord = $objRow;
            }
        }

        $objVersions = new \Versions('tl_regions', $intId);
        $objVersions->initialize();

        // Trigger the save_callback
        if (is_array($GLOBALS['TL_DCA']['tl_regions']['fields']['published']['save_callback']))
        {
            foreach ($GLOBALS['TL_DCA']['tl_regions']['fields']['published']['save_callback'] as $callback)
            {
                if (is_array($callback))
                {
                    $this->import($callback[0]);
                    $blnVisible = $this->{$callback[0]}->{$callback[1]}($blnVisible, $dc);
                }
                elseif (is_callable($callback))
                {
                    $blnVisible = $callback($blnVisible, $dc);
                }
            }
        }

        $time = time();

        // Update the database
        $this->Database->prepare("UPDATE tl_regions SET tstamp=$time, published='" . ($blnVisible ? '1' : '') . "' WHERE id=?")
            ->execute($intId);

        if ($dc)
        {
            $dc->activeRecord->tstamp = $time;
            $dc->activeRecord->published = ($blnVisible ? '1' : '');
        }

        $objVersions->create();
    }
}
