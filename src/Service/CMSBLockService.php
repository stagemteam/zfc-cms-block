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

    public function Key($key1, $key2)
    {
        if ($key1 == $key2)
            return 0;
        else if ($key1 > $key2)
            return 1;
        else
            return -1;
    }

    public function saveAllCmsBlocks($cmsBlocksData, $postData) {

        $array1 = array("a" => "green", "red", "blue", "red");
        $array2 = array("b" => "green", "yellow", "red");

        for ($i=0; $i <= count($postData); $i ++) {
            $result[$i] = array_diff($cmsBlocksData['cms-blocks'][$i], $postData['cms-blocks'][$i]);
        }

        \Zend\Debug\Debug::dump($result);

        /*$result = array_intersect($array1, $array2);
        print_r($result);
        var_dump(array_diff_ukey($cmsBlocksData, $postData, 'Key'));*/

       die(__METHOD__);
    }


    public function getCmsBlocksByMnemo($mnemo) {
        $cmsBlocks = ($cmsBlocks = $this->getRepository()->findBy(['mnemo' => $mnemo]))
            ? $cmsBlocks
            : $this->getObjectModel();

        return $cmsBlocks;

    }

    public function prepareData($mnemo) {
        $cmsBlocks = $this->getCmsBlocksByMnemo($mnemo);
        $i = 0;
        foreach ($cmsBlocks as $cmsBlock) {
            $data['cms-blocks'][$i]['id'] = $cmsBlock->getId();
            $data['cms-blocks'][$i]['title'] = $cmsBlock->getTitle();
            $data['cms-blocks'][$i]['mnemo'] = $cmsBlock->getMnemo();
            $data['cms-blocks'][$i]['content'] = $cmsBlock->getContent();
            $i++;
        }

        return $data;
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
    public function getAllContents() {
        return $this->getRepository()->getCmsBlocks();

    }
}