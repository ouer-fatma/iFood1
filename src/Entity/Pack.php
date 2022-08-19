<?php

namespace App\Entity;

use App\Repository\PackRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PackRepository::class)
 */
class Pack
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=PackLine::class, mappedBy="pack", orphanRemoval=true)
     */
    private $packLines;

    /**
     * @ORM\ManyToOne(targetEntity=Event::class, inversedBy="packs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $event;

    public function __construct()
    {
        $this->packLines = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, PackLine>
     */
    public function getPackLines(): Collection
    {
        return $this->packLines;
    }

    public function addPackLine(PackLine $packLine): self
    {
        if (!$this->packLines->contains($packLine)) {
            $this->packLines[] = $packLine;
            $packLine->setPack($this);
        }

        return $this;
    }

    public function removePackLine(PackLine $packLine): self
    {
        if ($this->packLines->removeElement($packLine)) {
            // set the owning side to null (unless already changed)
            if ($packLine->getPack() === $this) {
                $packLine->setPack(null);
            }
        }

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }
    public function __toString(){
        return $this->getName();
    }
}
