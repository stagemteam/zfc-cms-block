<?php

namespace Stagem\ZfcCmsBlock\Model;

use Doctrine\ORM\Mapping as ORM;
use Popov\ZfcCore\Model\DomainAwareTrait;
use Stagem\ZfcLang\Model\Lang;

/**
 * @ORM\Entity(repositoryClass="Stagem\ZfcCmsBlock\Model\Repository\CMSPageRepository")
 * @ORM\Table(name="cms_page")
 */
class CmsPage {

	use DomainAwareTrait;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

	/**
	 * @ORM\Column(type="string", unique=false, nullable=false)
	 * @var string
	 */
	private $title;

    /**
     * @ORM\Column(type="string", unique=false, nullable=false)
     * @var string
     */
    private $pageUrl;

    /**
     * @ORM\Column(type="string", unique=false, nullable=false)
     * @var string
     */
    private $contentHeading;

    /**
     * @ORM\Column(type="text", unique=false, nullable=true)
     * @var string
     */
    private $content;

    /**
     * @var \DateTime
     * @ORM\Column(name="createdAt", nullable=true, type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="updatedAt", nullable=true, type="datetime")
     */
    private $updatedAt;


    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true, options={"default":"0"})
     */
    private $sortOrder = 0;

    /**
     * @ORM\Column(type="string", unique=false, nullable=true)
     * @var string
     */
    private $metaKeywords;

    /**
     * @ORM\Column(type="string", unique=false, nullable=true)
     * @var string
     */
    private $metaDescription;

    /**
     * @var Lang
     *
     * @ORM\ManyToOne(targetEntity="Stagem\ZfcLang\Model\Lang", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="langId", referencedColumnName="id", nullable=true)
     * })
     */
    private $lang;

    /**
     * var boolean
     * @ORM\Column(type="boolean", nullable=true, options={"default":"1"})
     */
    private $isActive = 1;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getPageUrl()
    {
        return $this->pageUrl;
    }

    /**
     * @param string $pageUrl
     */
    public function setPageUrl($pageUrl)
    {
        $this->pageUrl = $pageUrl;
    }

    /**
     * @return string
     */
    public function getContentHeading()
    {
        return $this->contentHeading;
    }

    /**
     * @param string $contentHeading
     */
    public function setContentHeading($contentHeading)
    {
        $this->contentHeading = $contentHeading;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return int
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    /**
     * @param int $sortOrder
     */
    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;
    }

    /**
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * @param string $metaKeywords
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * @param string $metaDescription
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;
    }

    /**
     * @return Lang
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @param Lang $lang
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
    }

    /**
     * @return mixed
     */
    public function getisActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }
}