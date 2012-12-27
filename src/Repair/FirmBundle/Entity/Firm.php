<?php

namespace Repair\FirmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 *
 * @ORM\Table(name="firm")
 * @ORM\Entity
 */
class Firm
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
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $contact;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="ownerId", referencedColumnName="id")
     * })
     * @Assert\NotBlank
     */
    private $owner;

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
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $active;

    public function __construct()
    {
        $this->created = new \DateTime('now');
        $this->updated = new \DateTime('now');
    }

    public function __toString()
    {
        return $this->getTitle() ?: '[Без названия]';
    }

    /**
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
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
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getOwner()
    {
        return $this->owner;
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
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
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
     * @param boolean $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @param string $contact
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
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
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param \Application\Sonata\UserBundle\Entity\User $user
     */
    public function setOwner($user)
    {
        $this->owner = $user;
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
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
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

}