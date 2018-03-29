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

    protected $contentGrid;

    protected $config;

    public function __construct(CmsBlockService $cmsBlockService, CmsBlockGrid $contentGrid, CurrentHelper $currentHelper/*, array $config*/)
    {
        $this->cmsBlockService = $cmsBlockService;
        $this->contentGrid = $contentGrid;
        $this->currentHelper = $currentHelper;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $contentBlocks = $this->cmsBlockService->getAllContents();

        $this->contentGrid->init();
        $productDataGrid = $this->contentGrid->getDataGrid();
        $productDataGrid->setDataSource($contentBlocks);
        $productDataGrid->render();

        $response = $productDataGrid->getResponse();
        return $handler->handle($request->withAttribute(ViewModel::class, $response));
    }
}

