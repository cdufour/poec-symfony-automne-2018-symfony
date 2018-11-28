<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProverbRepository")
 */
class Proverb
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $body;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Topic", inversedBy="proverbs")
     */
    private $topic;

    /**
     * @ORM\Column(type="integer")
     */
    private $popularity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Country", inversedBy="proverbs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    public function __construct()
    {
        $this->topic = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }


    /**
     * @return Collection|Topic[]
     */
    public function getTopic(): Collection
    {
        return $this->topic;
    }

    public function addTopic(Topic $topic): self
    {
        if (!$this->topic->contains($topic)) {
            $this->topic[] = $topic;
        }

        return $this;
    }

    public function removeTopic(Topic $topic): self
    {
        if ($this->topic->contains($topic)) {
            $this->topic->removeElement($topic);
        }

        return $this;
    }

    public function getPopularity(): ?int
    {
        return $this->popularity;
    }

    public function setPopularity(int $popularity): self
    {
        $this->popularity = $popularity;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }
}
