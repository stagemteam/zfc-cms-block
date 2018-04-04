<?php

namespace Stagem\ZfcCmsBlock\Action\Admin;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Stagem\ZfcCmsBlock\Form\Admin\CmsBlockForm;
use Stagem\ZfcCmsBlock\Form\Admin\CmsPageForm;
use Stagem\ZfcCmsBlock\Service\CmsBlockService;
use Zend\View\Model\ViewModel;
use Popov\ZfcForm\FormElementManager;

class EditAction
{
    /* @var CmsBlockService */
    protected $cmsBlockService;

    /** @var FormElementManager */
    protected $fm;

    public function __construct(CmsBlockService $cmsBlockService, FormElementManager $fm)
    {
        $this->cmsBlockService = $cmsBlockService;
        $this->fm = $fm;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        $cmsBlocksData = $this->cmsBlockService->getCmsBlocksByMnemo($request->getAttribute('id'));

         /** @var \Zend\Form\Form $form */
        $form = $this->fm->get(CmsBlockForm::class);
        /** @var \Zend\Form\Element\Collection $base */
        $base = $form->getBaseFieldset();
        $base->setObject($cmsBlocksData);

        $method = new \ReflectionMethod(get_class($form), 'extract');
        $method->setAccessible(true);
        $data = $method->invoke($form);

        $form->populateValues($data, true);

        if ($request->getMethod() == 'POST') {
            $postData = $request->getParsedBody();
            $form->setData($postData);
            if ($form->isValid()) {
                //$this->cmsBlockService->saveAllCmsBlocks($cmsBlocksData, $postData);
                $this->cmsBlockService->getObjectManager()->flush();
            }
        }

        $view = new ViewModel([
            'form' => $form,
        ]);

        return $handler->handle($request->withAttribute(ViewModel::class, $view));
    }
}