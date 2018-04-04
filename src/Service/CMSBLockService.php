<?php
/**
 *
 * @category Stagem
 * @package Stagem_Question
 * @author Vlad Kozak <vlad.gem.typ@gmail.com>
 * @datetime: 03.01.2018 14:14
 */

namespace Stagem\ZfcCmsBlock\Service;

use Stagem\ZfcCmsBlock\Model\CmsBlock;
use Popov\ZfcCore\Service\DomainServiceAbstract;
use Stagem\Question\Model\Question as Question;
use Stagem\Question\Model\Repository\QuestionRepository;

/**
 * Class CMSBlockService
 *
 * @method QuestionRepository getRepository()
 */
class CmsBlockService extends DomainServiceAbstract
{
    protected $entity = CmsBlock::class;

    public function save(CmsBlock $cmsBlock)
    {
        $om = $this->getObjectManager();
        if (!$om->contains($cmsBlock)) {
            $om->persist($cmsBlock);
        }
        $om->flush();
    }

    public function getCmsBlocksByMnemo($mnemo) {
        $cmsBlocks = $this->getRepository()->getCmsBlockByMnemo($mnemo)->getQuery()->getResult();

        return $cmsBlocks;

    }

    /**
     * @param $parsedBody
     * @return array
     */
    public function getCollectionFromParsedBody($parsedBody) {
        $collection = [];
        foreach ($parsedBody['cmsBlocks'] as $item) {
         $cmsBlock = $this->getObjectModel();
            foreach (array_keys($item) as $value) {
                $method = 'set' . ucfirst($value);
                $cmsBlock->{$method}($item[$value]);
            }
            $collection[] = $cmsBlock;
        }

        return $collection;
    }

    /**
     * @param $mnemo
     * @return bool
     */
    public function getContentsByMnemo($mnemo) {
        $content = $this->getRepository()->getCmsBlockByMnemo($mnemo)->getQuery()->getResult();

        if ($content) {
            return $content[0];
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getCmsBlocksByLang($lang) {
        return $this->getRepository()->getCmsBlocksByLang($lang);

    }

    /**
     * @return mixed
     */
    public function getCmsBlocksByLangAndMnemo($mnemo, $lang) {
        return $this->getRepository()->getCmsBlocksByLangAndMnemo($mnemo, $lang)->getQuery()->getResult();

    }
}