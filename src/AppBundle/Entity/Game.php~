<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="meta_game")
 */
class Game{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="integer")
     */
    protected $title;
    /**
     * @ORM\Column(type="integer")
     */
    protected $year;
    /**
     * @ORM\Column(type="decimal",scale=2)
     */
    protected $rating;
    /**
     * @ORM\Column(type="text", length=2000)
     */
    protected $description;
    /**
     * @ORM\Column(type="text", length=255)
     */
    protected $url;
    /**
     * @ORM\ManyToOne(targetEntity="entry", inversedBy="game")
     * @ORM\JoinColumn(name="entry_id",referencedColumnName="id")
     */
    protected $entry;

    public function __construct()
    {
        $this->entry = new ArrayCollection();
    }

    /**
     * Set entry
     *
     * @param \AppBundle\Entity\entry $entry
     * @return Game
     */
    public function setEntry(\AppBundle\Entity\entry $entry = null)
    {
        $this->entry = $entry;

        return $this;
    }

    /**
     * Get entry
     *
     * @return \AppBundle\Entity\entry 
     */
    public function getEntry()
    {
        return $this->entry;
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
     * @param integer $title
     * @return Game
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return integer 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set year
     *
     * @param integer $year
     * @return Game
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set rating
     *
     * @param string $rating
     * @return Game
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return string 
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Game
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Game
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }
}
