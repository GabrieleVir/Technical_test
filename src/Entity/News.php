<?php
// src/Entity/News.php
namespace src\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * @ORM\Entity
 * @ORM\Table(name="news")
 */
class News
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
	private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
	private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $body;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * One news has many comments.
     * @OneToMany(targetEntity="Comment", mappedBy="news", cascade={"remove"})
     */
    private $comments;

    /**
     * Get Id
     *
     * @return int
     */
	public function getId()
	{
		return $this->id;
	}

    /**
     * Set Title
     *
     * @param string $title
     * @return News $this
     */
	public function setTitle($title)
	{
		$this->title = $title;

		return $this;
	}

    /**
     * Get Title
     *
     * @return string
     */
	public function getTitle()
	{
		return $this->title;
	}

    /**
     * Set body
     *
     * @param string $body
     * @return $this
     */
	public function setBody($body)
	{
		$this->body = $body;

		return $this;
	}

    /**
     * Get body
     *
     * @return string
     */
	public function getBody()
	{
		return $this->body;
	}

    /**
     * Set createdAt
     *
     * @param $createdAt
     * @return $this
     */
	public function setCreatedAt(DateTime $createdAt)
	{
		$this->createdAt = $createdAt;

		return $this;
	}

    /**
     * Get createdAt
     *
     * @return DateTime
     */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
	public function getComments() {
	    return $this->comments;
    }
}