<?php

namespace Stagem\ZfcCmsBlock\Action\Admin;

use Stagem\ZfcCmsBlock\Block\Grid\CmsBlockGrid;
use Stagem\ZfcCmsBlock\Service\CmsBlockService;
use Popov\ZfcCurrent\CurrentHelper;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Server\MiddlewareInterface;
use Fig\Http\Message\RequestMethodInterface;
use Stagem\ZfcCmsPage\Service\CmsPageService;
use Stagem\ZfcLang\LangHelper;
use Zend\View\Model\ViewModel;

class IndexAction implements MiddlewareInterface, RequestMethodInterface
{
    /**
     * @var CmsBlockService
     */
    protected $cmsBlockService;

    /**
     * @var CurrentHelper
     */
    protected $currentHelper;


    /** @var LangHelper */
    protected $langHelper;

    protected $contentGrid;

    protected $config;

    public function __construct(CmsBlockService $cmsBlockService, CmsBlockGrid $contentGrid,  LangHelper $langHelper, CurrentHelper $currentHelper/*, array $config*/)
    {
        $this->cmsBlockService = $cmsBlockService;
        $this->contentGrid = $contentGrid;
        $this->currentHelper = $currentHelper;
        $this->langHelper = $langHelper;

    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $lang = $this->langHelper->getCurrentLang();
        $contentBlocks = $this->cmsBlockService->getCmsBlocksByLang($lang);

        $this->contentGrid->init();
        $productDataGrid = $this->contentGrid->getDataGrid();
        $productDataGrid->setDataSource($contentBlocks);
        $productDataGrid->render();

        $response = $productDataGrid->getResponse();
        return $handler->handle($request->withAttribute(ViewModel::class, $response));
    }
}
