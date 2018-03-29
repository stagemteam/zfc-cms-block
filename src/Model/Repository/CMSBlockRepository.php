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
        $qb = $this->createQueryBuilder($this->_alias);
        return $qb;
    }

    public function getCmsBlockByMnemo($mnemo) {
        $qb = $this->getCMSBlocks();

        $qb->where(
            $qb->expr()->andX(
                $qb->expr()->eq($this->_alias . '.mnemo', '?1')
            )
        );

        $qb->setParameters([1 => $mnemo]);

        return $qb;
    }

}