<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Entry
 *
 * @ORM\Table(name="meta_entry")
 */
class Entry
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(name="fetched_at",type="datetime")
     */
    private $fetchedAt;
    /**
     * @ORM\OneToMany(targetEntity="Movie",mappedBy="entry")
     */
    private $fetchedMovies;
    /**
     * @ORM\OneToMany(targetEntity="Game",mappedBy="entry")
     */
    private $fetchedGames;

    /**
     * @ORM\ManyToOne(targetEntity="User",inversedBy="entry")
     */
    private $user;

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
     * Set name
     *
     * @param string $name
     * @return Entry
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    public function __construct()
    {
        $this->fetchedMovies = new ArrayCollection();
        $this->fetchedGames = new ArrayCollection();
    }
    /**
     * Set fetchedAt
     *
     * @param \DateTime $fetchedAt
     * @return Entry
     */
    public function setFetchedAt($fetchedAt)
    {
        $this->fetchedAt = $fetchedAt;

        return $this;
    }

    /**
     * Get fetchedAt
     *
     * @return \DateTime 
     */
    public function getFetchedAt()
    {
        return $this->fetchedAt;
    }

    /**
     * Add fetchedMovies
     *
     * @param \AppBundle\Entity\Movie $fetchedMovies
     * @return Entry
     */
    public function addFetchedMovie(\AppBundle\Entity\Movie $fetchedMovies)
    {
        $this->fetchedMovies[] = $fetchedMovies;

        return $this;
    }

    /**
     * Remove fetchedMovies
     *
     * @param \AppBundle\Entity\Movie $fetchedMovies
     */
    public function removeFetchedMovie(\AppBundle\Entity\Movie $fetchedMovies)
    {
        $this->fetchedMovies->removeElement($fetchedMovies);
    }

    /**
     * Get fetchedMovies
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFetchedMovies()
    {
        return $this->fetchedMovies;
    }

    /**
     * Add fetchedGames
     *
     * @param \AppBundle\Entity\Game $fetchedGames
     * @return Entry
     */
    public function addFetchedGame(\AppBundle\Entity\Game $fetchedGames)
    {
        $this->fetchedGames[] = $fetchedGames;

        return $this;
    }

    /**
     * Remove fetchedGames
     *
     * @param \AppBundle\Entity\Game $fetchedGames
     */
    public function removeFetchedGame(\AppBundle\Entity\Game $fetchedGames)
    {
        $this->fetchedGames->removeElement($fetchedGames);
    }

    /**
     * Get fetchedGames
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFetchedGames()
    {
        return $this->fetchedGames;
    }

    /**
     * Add userId
     *
     * @param \AppBundle\Entity\User $userId
     * @return Entry
     */
    public function addUserId(\AppBundle\Entity\User $userId)
    {
        $this->userId[] = $userId;

        return $this;
    }

    /**
     * Remove userId
     *
     * @param \AppBundle\Entity\User $userId
     */
    public function removeUserId(\AppBundle\Entity\User $userId)
    {
        $this->userId->removeElement($userId);
    }

    /**
     * Get userId
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     * @return Entry
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
