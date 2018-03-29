<?php
/**
 * @category Stagem
 * @package Stagem_Content
 * @author Kozak Vlad <vlad.gem.typ@gmail.com>
 * @datetime: 19.03.18 16:43
 */

namespace Stagem\ZfcCmsBlock\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Server\MiddlewareInterface;
use Fig\Http\Message\RequestMethodInterface;
use Zend\View\Model\ViewModel;

class PrivacyPolicyAction implements MiddlewareInterface, RequestMethodInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $view = new ViewModel([]);
        return $handler->handle($request->withAttribute(ViewModel::class, $view));

    }
}