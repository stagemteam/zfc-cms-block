<?php

namespace Stagem\ZfcCmsBlock\View\Helper;

use Popov\ZfcCurrent\CurrentHelper;
use Stagem\ZfcCmsBlock\Service\CmsBlockService;
use Stagem\ZfcLang\LangHelper;
use Zend\View\Helper\AbstractHelper;

class CmsBlockHelper extends AbstractHelper
{
    /** @var CmsBlockService */
    protected $contentService;

    /** @var LangHelper */
    protected $langHelper;

    public function __construct(CmsBlockService $contentService, LangHelper $langHelper)
    {
        $this->contentService = $contentService;
        $this->langHelper = $langHelper;
    }

    /**
     * @param $mnemo
     * @return bool
     */
    public function get($mnemo) {
        $lang = $this->langHelper->getCurrentLang();

        $contentBlock = $this->contentService->getCmsBlocksByLangAndMnemo($mnemo, $lang);
        if ($contentBlock) {
            return $contentBlock[0]->getContent();
        }
        return false;
    }
}