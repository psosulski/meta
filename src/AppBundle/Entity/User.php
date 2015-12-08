<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @ORM\HasLifecycleCallbacks()
 */
class User {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string",length=100)
     */
    protected $username;
    /**
     * @ORM\Column(type="string",length=255)
     */
    protected $mail;
    /**
     * @ORM\Column(type="string",length=255)
     */
    protected $password;
    /**
     * @ORM\Column(name="registered_at",type="datetime")
     */
    protected $registeredAt;

    /**
     * @ORM\OneToMany(targetEntity="entry", mappedBy="user")
     */
    protected $entry;


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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return User
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set registeredAt
     *
     * @ORM\PrePersist
     */
    public function setRegisteredAtValue()
    {
        $this->registeredAt = new \DateTime();
    }

    /**
     * Get registeredAt
     *
     * @return \DateTime
     */
    public function getRegisteredAt()
    {
        return $this->registeredAt;
    }

    /**
     * Set registeredAt
     *
     * @param \DateTime $registeredAt
     * @return User
     */
    public function setRegisteredAt($registeredAt)
    {
        $this->registeredAt = $registeredAt;

        return $this;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->entry = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add entry
     *
     * @param \AppBundle\Entity\entry $entry
     * @return User
     */
    public function addEntry(\AppBundle\Entity\entry $entry)
    {
        $this->entry[] = $entry;

        return $this;
    }

    /**
     * Remove entry
     *
     * @param \AppBundle\Entity\entry $entry
     */
    public function removeEntry(\AppBundle\Entity\entry $entry)
    {
        $this->entry->removeElement($entry);
    }

    /**
     * Get entry
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEntry()
    {
        return $this->entry;
    }
}
