<?php

namespace Stagem\ZfcCmsBlock\Model;

use Doctrine\ORM\Mapping as ORM;
use Popov\ZfcCore\Model\DomainAwareTrait;
use Stagem\ZfcLang\Model\Lang;

/**
 * @ORM\Entity(repositoryClass="Stagem\ZfcCmsBlock\Model\Repository\CMSBlockRepository")
 * @ORM\Table(name="cms_block")
 */
class CmsBlock {

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
    private $mnemo;

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
    public function getMnemo()
    {
        return $this->mnemo;
    }

    /**
     * @param string $mnemo
     */
    public function setMnemo($mnemo)
    {
        $this->mnemo = $mnemo;
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
    public function getIsActive()
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

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    public function exchangeArray($data)
    {
        $this->title = $data['title'];
        $this->mnemo = $data['mnemo'];
        $this->content = $data['content'];
    }

}