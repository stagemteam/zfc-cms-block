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
     * @param $name
     * @return mixed
     */
    public function get($name) {
        $lang = $this->currentHelper->currentRequest()->getAttribute('lang');
        $contentBlock = $this->contentService->getContentByMnemo($name, $lang);
        $method = 'getContent' . ucfirst($lang);
        if (method_exists($contentBlock, $method)) {
            return $contentBlock->{$method}();
        }
        return false;
    }
}