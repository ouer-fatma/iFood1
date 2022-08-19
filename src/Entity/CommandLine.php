<?php

namespace App\Entity;

use App\Repository\CommandLineRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandLineRepository::class)
 */
class CommandLine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quntity;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="commandLines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Command::class, inversedBy="commandLines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $command;

    /**
     * @ORM\ManyToOne(targetEntity=Plate::class, inversedBy="commandLines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $plate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuntity(): ?int
    {
        return $this->quntity;
    }

    public function setQuntity(int $quntity): self
    {
        $this->quntity = $quntity;

        return $this;
    }

    public function getUser(): ?Utilisateur
    {
        return $this->user;
    }

    public function setUser(?Utilisateur $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCommand(): ?Command
    {
        return $this->command;
    }

    public function setCommand(?Command $command): self
    {
        $this->command = $command;

        return $this;
    }

    public function getPlate(): ?Plate
    {
        return $this->plate;
    }

    public function setPlate(?Plate $plate): self
    {
        $this->plate = $plate;

        return $this;
    }
    /**
     * Tests if the given item given corresponds to the same order item.
     *
     * @param CommandLine $item
     *
     * @return bool
     */
    public function equals(CommandLine $item): bool
    {
        return $this->getPlate()->getId() === $item->getPlate()->getId();
    }
    /**
     * Calculates the item total.
     *
     * @return float|int
     */
    public function getTotal(): float
    {
        return $this->getPlate()->getPrice() * $this->getQuntity();
    }
    public function __toString(){
        return (string)$this->getId();
    }
}
