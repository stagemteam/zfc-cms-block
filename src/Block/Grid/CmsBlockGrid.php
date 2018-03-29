<?php
/**
 * The MIT License (MIT)
 * Copyright (c) 2018 Stagem Team
 * This source file is subject to The MIT License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/MIT
 *
 * @category Stagem
 * @package Stagem_Question
 * @author Serhii Popov <popow.serhii@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Stagem\ZfcCmsBlock\Block\Grid;

use Popov\ZfcDataGrid\Block\AbstractGrid;

class CmsBlockGrid extends AbstractGrid
{
    public function init()
    {
        $grid = $this->getDataGrid();
        $grid->setId('cms_block');
        $grid->setTitle('Contents');

        $rendererOptions = $grid->getToolbarTemplateVariables();

        $rendererOptions['navGridDel'] = true;
        $rendererOptions['inlineNavCancel'] = true;
        $rendererOptions['navGridRefresh'] = true;

        $grid->setToolbarTemplateVariables($rendererOptions);

        $colId = $this->add([
            'name' => 'Select',
            'construct' => ['mnemo', 'cms_block'],
            'identity' => true,
        ])->getDataGrid()->getColumnByUniqueId('cms_block_mnemo');

        $this->add([
            'name' => 'Select',
            'construct' => ['title', 'cms_block'],
            'label' => 'Name',
            'identity' => false,
            'width' => 3,
        ]);

        $this->add([
            'name' => 'Select',
            'construct' => ['mnemo', 'cms_block'],
            'label' => 'Mnemo',
            'translation_enabled' => true,
            'width' => 2,
        ]);

        $this->add([
            'name' => 'Action',
            'construct' => ['edit'],
            'label' => ' ',
            'width' => 1,
            'formatters' => [[
                'name' => 'Link',
                'attributes' => ['class' => 'pencil-edit-icon', 'target' => '_blank'],
                'link' => ['href' => '/admin/zfcContent/edit', 'placeholder_column' => $colId]
            ]],
        ]);

        return $this;
    }
}