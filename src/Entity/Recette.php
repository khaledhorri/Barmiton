<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\RecetteRepository;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=RecetteRepository::class)
 * @Vich\Uploadable
 * @UniqueEntity("title", message="Ce titre de recette existe déjà")
 * 
 */
class Recette
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *          min = 10, 
     *          max = 50, 
     *          minMessage="Votre titre doit contenir au moins {{ limit }} caractères",
     *          maxMessage="Votre titre ne doit pas dépasser {{ limit }} caractères"
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *          min = 5, 
     *          max = 255, 
     *          minMessage="Votre résumé doit contenir au moins {{ limit }} caractères",
     *          maxMessage="Votre titre ne doit pas dépasser {{ limit }} caractères"
     * )
     */
    private $abstract;

    /**
     * @ORM\Column(type="text")
     * Assert\Length(
     *          min = 50,
     *          minMessage="Votre préparation doit contenir au moins {{ limit }} caractères")
     */
    private $preparation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $time;

    /**
     * @ORM\Column(type="integer")
     */
    private $person;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $image;


    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="recettes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="recettes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $username;


    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="recette_image", fileNameProperty="imageName")
     * 
     * @var File|null
     */

    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageName;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;



    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAbstract(): ?string
    {
        return $this->abstract;
    }

    public function setAbstract(?string $abstract): self
    {
        $this->abstract = $abstract;

        return $this;
    }

    public function getPreparation(): ?string
    {
        return $this->preparation;
    }

    public function setPreparation(string $preparation): self
    {
        $this->preparation = $preparation;

        return $this;
    }

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(string $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getPerson(): ?int
    {
        return $this->person;
    }

    public function setPerson(int $person): self
    {
        $this->person = $person;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
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

    public function getUsername(): ?User
    {
        return $this->username;
    }

    public function setUsername(?User $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
