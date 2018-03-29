<?php

namespace Stagem\ZfcCmsBlock\Model\Repository;

class CmsPageRepository extends \Doctrine\ORM\EntityRepository
{
    protected $_alias = 'cms_page';

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getCMSPages()
    {
        $qb = $this->createQueryBuilder($this->_alias);
        return $qb;
    }

}