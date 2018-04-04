<?php

namespace Stagem\ZfcCmsBlock\Model\Repository;

class CmsBlockRepository extends \Doctrine\ORM\EntityRepository
{
    protected $_alias = 'cms_block';

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getCmsBlocks()
    {
        $l = 'lang';

        $qb = $this->createQueryBuilder($this->_alias)
            ->leftJoin($this->_alias . '.lang', $l);
        return $qb;
    }

    /**
     * @param $mnemo
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getCmsBlockByMnemo($mnemo) {
        $qb = $this->getCmsBlocks();

        $qb->where(
            $qb->expr()->andX(
                $qb->expr()->eq($this->_alias . '.mnemo', '?1')
            )
        );

        $qb->setParameters([1 => $mnemo]);

        return $qb;
    }

    /**
     * @param $lang
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getCmsBlocksByLang($lang) {
        $qb = $this->getCmsBlocks();

        $qb->where(
            $qb->expr()->andX(
                $qb->expr()->eq($this->_alias . '.lang', '?1')
            )
        );

        $qb->setParameter(1, $lang);

        return $qb;
    }

    /**
     * @param $mnemo
     * @param $lang
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getCmsBlocksByLangAndMnemo($mnemo, $lang) {
        $qb = $this->getCmsBlocks();

        $qb->where(
            $qb->expr()->andX(
                $qb->expr()->eq($this->_alias . '.mnemo', '?1'),
                $qb->expr()->eq($this->_alias . '.lang', '?2')
            )
        );

        $qb->setParameters([1 => $mnemo, 2 => $lang]);
        return $qb;
    }

}