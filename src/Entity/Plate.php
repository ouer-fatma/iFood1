<?php

namespace App\Entity;

use App\Repository\PlateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlateRepository::class)
 */
class Plate
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
    private $description;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $name;

    /**
     * @ORM\Column(type="bigint")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=PlateCategory::class, inversedBy="plates")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=CommandLine::class, mappedBy="plate", orphanRemoval=true)
     */
    private $commandLines;

    /**
     * @ORM\OneToMany(targetEntity=PackLine::class, mappedBy="Plate", orphanRemoval=true)
     */
    private $packLines;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    public function __construct()
    {
        $this->commandLines = new ArrayCollection();
        $this->packLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCategory(): ?PlateCategory
    {
        return $this->category;
    }

    public function setCategory(?PlateCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, CommandLine>
     */
    public function getCommandLines(): Collection
    {
        return $this->commandLines;
    }

    public function addCommandLine(CommandLine $commandLine): self
    {
        if (!$this->commandLines->contains($commandLine)) {
            $this->commandLines[] = $commandLine;
            $commandLine->setPlate($this);
        }

        return $this;
    }

    public function removeCommandLine(CommandLine $commandLine): self
    {
        if ($this->commandLines->removeElement($commandLine)) {
            // set the owning side to null (unless already changed)
            if ($commandLine->getPlate() === $this) {
                $commandLine->setPlate(null);
            }
        }

        return $this;
    }
    public function __toString(){
        return $this->getName();
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
            $packLine->setPlate($this);
        }

        return $this;
    }

    public function removePackLine(PackLine $packLine): self
    {
        if ($this->packLines->removeElement($packLine)) {
            // set the owning side to null (unless already changed)
            if ($packLine->getPlate() === $this) {
                $packLine->setPlate(null);
            }
        }

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
