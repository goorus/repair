<?php

namespace Repair\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 *
 * @ORM\Table(name="news")
 * @ORM\Entity
 */
class News
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $announce;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $publicTime;

    /**
     * @var \Repair\NewsBundle\Entity\NewsCategory
     *
     * @ORM\ManyToOne(targetEntity="NewsCategory")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="newsCategoryId", referencedColumnName="id")
     * })
     * @Assert\NotBlank
     */
    private $newsCategory;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="NewsLink", mappedBy="news", cascade={"all"}, orphanRemoval=true)
     * @ORM\OrderBy({"pos" = "ASC"})
     */
    protected $newsLinks;

    public function __construct()
    {
        $this->created = new \DateTime('now');
        $this->updated = new \DateTime('now');
        $this->newsLinks = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set announce
     *
     * @param text $announce
     */
    public function setAnnounce($announce)
    {
        $this->announce = $announce;
    }

    /**
     * Get announce
     *
     * @return text
     */
    public function getAnnounce()
    {
        return $this->announce;
    }

    /**
     * Set text
     *
     * @param text $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Get text
     *
     * @return text
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set createdAt
     *
     * @param datetime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime|string $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = is_object($updated)
            ? $updated
            : new \DateTime($updated);
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set publicTime
     *
     * @param \DateTime $publicTime
     */
    public function setPublicTime($publicTime)
    {
        $this->publicTime = $publicTime;
    }

    /**
     * Get publicTime
     *
     * @return \DateTime
     */
    public function getPublicTime()
    {
        return $this->publicTime;
    }


    /**
     *
     * @return string
     */
    public function getPubYear()
    {
        return $this->publicTime->format('Y');
    }

    /**
     * Set newsCategory
     *
     * @param \Repair\NewsBundle\Entity\NewsCategory $newsCategory
     */
    public function setNewsCategory(\Repair\NewsBundle\Entity\NewsCategory $newsCategory)
    {
        $this->newsCategory = $newsCategory;
    }

    /**
     * Get newsCategory
     *
     * @return \Repair\NewsBundle\Entity\NewsCategory
     */
    public function getNewsCategory()
    {
        return $this->newsCategory;
    }

    /**
     * Add newsLinks
     *
     * @param \Repair\NewsBundle\Entity\NewsLink $newsLinks
     */
    public function addNewsLinks(\Repair\NewsBundle\Entity\NewsLink $newsLinks)
    {
        $this->newsLinks[] = $newsLinks;
    }

    /**
     * Get newsLinks
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getNewsLinks()
    {
        return $this->newsLinks;
    }


    public function setNewsLinks( $newsLinks)
    {
        $this->newsLinks= $newsLinks;

        //foreach ( $this->newsLinks  as $link) $link->setPos (555);

        foreach ($this->newsLinks as $pos => $link)
        {
           // print '<br>'.$link.' '.$pos;
            $link->setNews ($this); //->setPos ($pos);
        }
      /// die ('xxxxxxx');
    }


    function __toString()
    {
        return $this->getTitle() ? $this->getTitle() : '[Без названия]';
    }
}