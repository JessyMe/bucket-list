<?php

namespace App\Entity;

use App\Repository\IdeeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=IdeeRepository::class)
 */
class Idea
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *
     * @Assert\NotBlank(message="Please provide your idea!")
     * @Assert\Length(
     *      min = 2,
     *      max = 250,
     *      minMessage = "Your idea must be at least {{ limit }} characters long",
     *      maxMessage = "Your idea cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column (type="string", length=250)
     */
    private $title;

    /**
     *
     * @Assert\NotBlank(message="Please provide the description!")
     * @Assert\Length(
     *      min = 2,
     *      max = 1000,
     *      minMessage = "The description must be at least {{ limit }} characters long",
     *      maxMessage = "The description cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column (type="text", nullable=true )
     */
    private $description;

    /**
     * @Assert\NotBlank(message="Please provide your username!")
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your username must be at least {{ limit }} characters long",
     *      maxMessage = "Your username cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column (type="string", length=100)
     */
    private $author;

    /**
     * @Assert\Type(type="boolean", message="This value is not valid!")
     * @ORM\Column (type="boolean")
     */
    private $isPublished;

    /**
     * @Assert\DateTime(message="This value is not valid!")
     * @Assert\LessThanOrEqual("now")
     * @ORM\Column (type="datetime")
     */
    private $dateCreated;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="ideas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * @param mixed $isPublished
     */
    public function setIsPublished($isPublished): void
    {
        $this->isPublished = $isPublished;
    }

    /**
     * @return mixed
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * @param mixed $dateCreated
     */
    public function setDateCreated($dateCreated): void
    {
        $this->dateCreated = $dateCreated ;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }


}
