<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PeopleRepository")
 */
class People
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $uid;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $knowForDepartment;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $alsoKnowAs = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $gender;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $biography;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $popularity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $placeOfBirth;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $profilePath;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $adult;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imdb_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $homepage;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthday;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $csBiography;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUid(): ?int
    {
        return $this->uid;
    }

    public function setUid(int $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function getKnowForDepartment(): ?string
    {
        return $this->knowForDepartment;
    }

    public function setKnowForDepartment(?string $knowForDepartment): self
    {
        $this->knowForDepartment = $knowForDepartment;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAlsoKnowAs(): ?array
    {
        return $this->alsoKnowAs;
    }

    public function setAlsoKnowAs(?array $alsoKnowAs): self
    {
        $this->alsoKnowAs = $alsoKnowAs;

        return $this;
    }

    public function getGender(): ?int
    {
        return $this->gender;
    }

    public function setGender(?int $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(?string $biography): self
    {
        $this->biography = $biography;

        return $this;
    }

    public function getPopularity(): ?float
    {
        return $this->popularity;
    }

    public function setPopularity(?float $popularity): self
    {
        $this->popularity = $popularity;

        return $this;
    }

    public function getPlaceOfBirth(): ?string
    {
        return $this->placeOfBirth;
    }

    public function setPlaceOfBirth(?string $placeOfBirth): self
    {
        $this->placeOfBirth = $placeOfBirth;

        return $this;
    }

    public function getProfilePath(): ?string
    {
        return $this->profilePath;
    }

    public function setProfilePath(?string $profilePath): self
    {
        $this->profilePath = $profilePath;

        return $this;
    }

    public function getAdult(): ?bool
    {
        return $this->adult;
    }

    public function setAdult(?bool $adult): self
    {
        $this->adult = $adult;

        return $this;
    }

    public function getImdbId(): ?string
    {
        return $this->imdb_id;
    }

    public function setImdbId(?string $imdb_id): self
    {
        $this->imdb_id = $imdb_id;

        return $this;
    }

    public function getHomepage(): ?string
    {
        return $this->homepage;
    }

    public function setHomepage(?string $homepage): self
    {
        $this->homepage = $homepage;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(?\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }


    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

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

    public function getCsBiography(): ?string
    {
        return $this->csBiography;
    }

    public function setCsBiography(?string $csBiography): self
    {
        $this->csBiography = $csBiography;

        return $this;
    }
}
