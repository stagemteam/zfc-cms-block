<?php

namespace Stagem\ZfcCmsBlock\View\Helper;

use Popov\ZfcCurrent\CurrentHelper;
use Stagem\ZfcCmsBlock\Service\CmsBlockService;
use Zend\View\Helper\AbstractHelper;

class ContentHelper extends AbstractHelper
{
    /** @var CmsBlockService */
    protected $contentService;

    /** @var CurrentHelper */
    protected $currentHelper;

    public function __construct(CmsBlockService $contentService, CurrentHelper $currentHelper)
    {
        $this->contentService = $contentService;
        $this->currentHelper = $currentHelper;
    }

    /**
     * @param $mnemo
     * @return bool
     */
    public function get($mnemo) {
        $lang = $this->currentHelper->currentRequest()->getAttribute('langObject');
        $contentBlock = $this->contentService->getCmsBlocksByLangAndMnemo($mnemo, $lang);
        if ($contentBlock) {
            return $contentBlock[0]->getContent();
        }
        return false;
    }
}