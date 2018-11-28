<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TopicRepository")
 */
class Topic
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Proverb", mappedBy="topic")
     */
    private $proverbs;

    public function __construct()
    {
        $this->proverbs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Proverb[]
     */
    public function getProverbs(): Collection
    {
        return $this->proverbs;
    }

    public function addProverb(Proverb $proverb): self
    {
        if (!$this->proverbs->contains($proverb)) {
            $this->proverbs[] = $proverb;
            $proverb->addTopic($this);
        }

        return $this;
    }

    public function removeProverb(Proverb $proverb): self
    {
        if ($this->proverbs->contains($proverb)) {
            $this->proverbs->removeElement($proverb);
            $proverb->removeTopic($this);
        }

        return $this;
    }
}
