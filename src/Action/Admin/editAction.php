<?php

namespace Stagem\ZfcCmsBlock\Action\Admin;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Stagem\ZfcCmsBlock\Form\Admin\CmsBlockForm;
use Stagem\ZfcCmsBlock\Service\CmsBlockService;
use Zend\View\Model\ViewModel;
use Popov\ZfcForm\FormElementManager;

class editAction
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

        $contentBlock = ($contentBlock = $this->cmsBlockService->find($id = (int) $request->getAttribute('id')))
            ? $contentBlock
            : $this->cmsBlockService->getObjectModel();

        /*$om->getRepository(Visitor::class)->findOneBy([
            'user' => $user,
        ]*/

        /** @var CmsBlockForm $form */
        $form = $this->fm->get(CmsBlockForm::class);
        $form->bind($contentBlock);

        if ($request->getMethod() == 'POST') {
            $form->setData($request->getParsedBody());
            if ($form->isValid()) {
                $this->cmsBlockService->save($contentBlock);
            }
        }

        $view = new ViewModel([
            'form' => $form,
        ]);

        return $handler->handle($request->withAttribute(ViewModel::class, $view));
    }
}