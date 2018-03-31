<?php

namespace Stagem\ZfcCmsBlock\Action\Admin;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Stagem\ZfcCmsBlock\Form\Admin\CmsBlockForm;
use Stagem\ZfcCmsBlock\Service\CmsBlockService;
use Zend\View\Model\ViewModel;
use Popov\ZfcForm\FormElementManager;

class testAction
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

        //$cmsBlocksData = $this->cmsBlockService->prepareData($request->getAttribute('id'));
        //$cmsBlocksData = $this->cmsBlockService->prepareData($request->getAttribute('id'));
        $cmsBlocksData = ($cmsBlocksData = $this->cmsBlockService->getRepository()->findBy(['mnemo' => $request->getAttribute('id')]))
            ? $cmsBlocksData
            : $this->getObjectModel();

        $test['cms-blocks'] = $cmsBlocksData;

        $std = new \stdClass();
        $std->cmsBlocks = $cmsBlocksData;
        $std->getArrayCopy = function() {
            return [];
        };


        $form = $this->fm->get(CmsBlockForm::class);
        /** @var \Zend\Form\Element\Collection $base */
        $base = $form->getBaseFieldset();
        //foreach ($cmsBlocksData as $cms) {
        //    $form
        //    $data = $form->getHydrator()->extract($cmsBlocksData);
        //}

        //$base->setData($cmsBlocksData);
        $base->setObject($cmsBlocksData);
        //$form->bind($cmsBlocksData);
        //$form->setData($data);

        //$form->setData($cmsBlock);
        if ($request->getMethod() == 'POST') {
            $postData = $request->getParsedBody();
            $form->setData($request->getParsedBody());
            if ($form->isValid()) {
                $this->cmsBlockService->saveAllCmsBlocks($cmsBlocksData, $postData);
            }
        }

        $view = new ViewModel([
            'form' => $form,
        ]);

        return $handler->handle($request->withAttribute(ViewModel::class, $view));
    }
}