<?php

namespace Stagem\ZfcCmsBlock\Action\Admin;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Stagem\ZfcCmsBlock\Form\Admin\CmsBlockForm;
use Stagem\ZfcCmsBlock\Form\Admin\CmsPageForm;
use Stagem\ZfcCmsBlock\Service\CmsBlockService;
use Zend\Expressive\Helper\UrlHelper;
use Zend\View\Model\ViewModel;
use Popov\ZfcForm\FormElementManager;
use Zend\Diactoros\Response\RedirectResponse;
class CreateAction
{
    /* @var CmsBlockService */
    protected $cmsBlockService;

    /* @var UrlHelper */
    protected $urlHelper;

    /** @var FormElementManager */
    protected $fm;

    public function __construct(CmsBlockService $cmsBlockService, UrlHelper $urlHelper, FormElementManager $fm)
    {
        $this->cmsBlockService = $cmsBlockService;
        $this->urlHelper = $urlHelper;
        $this->fm = $fm;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /** @var \Zend\Form\Form $form */
        $form = $this->fm->get(CmsBlockForm::class);

        if ($request->getMethod() == 'POST') {

            $collection = $this->cmsBlockService->getCollectionFromParsedBody($request->getParsedBody());

            /** @var \Zend\Form\Element\Collection $base */
            $base = $form->getBaseFieldset();
            $base->setObject($collection);

            $method = new \ReflectionMethod(get_class($form), 'extract');
            $method->setAccessible(true);
            $data = $method->invoke($form);

            $form->populateValues($data, true);


            $postData = $request->getParsedBody();
            $form->setData($postData);
            if ($form->isValid()) {
                //$this->cmsBlockService->saveAllCmsBlocks($cmsBlocksData, $postData);

                $this->cmsBlockService->getObjectManager()->flush();
                return new RedirectResponse($this->urlHelper->generate('admin/default',
                    [
                        'resource' => 'cms-block',
                        'action' => 'index',
                        'lang' => $request->getAttribute('lang')
                    ]
                ));
            }
        }

        $view = new ViewModel([
            'form' => $form,
        ]);

        return $handler->handle($request->withAttribute(ViewModel::class, $view));
    }
}