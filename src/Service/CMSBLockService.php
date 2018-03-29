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

    public function save(CmsBlock $question)
    {
        $om = $this->getObjectManager();
        if (!$om->contains($question)) {
            $om->persist($question);
        }
        $om->flush();
    }

    /**
     * @param $mnemo
     * @return bool
     */
    public function getContentByMnemo($mnemo) {
        $content = $this->getRepository()->getCmsBlockByMnemo($mnemo)->getQuery()->getResult();

        if ($content) {
            return $content[0];
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getAllContents() {
        return $this->getRepository()->getCmsBlocks();

    }
}