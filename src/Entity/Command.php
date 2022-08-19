<?php

namespace App\Entity;

use App\Repository\CommandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandRepository::class)
 */
class Command
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCommand;

    /**
     * @ORM\Column(type="smallint")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=CommandLine::class, mappedBy="command", orphanRemoval=true)
     */
    private $commandLines;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="commands")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity=Delivery::class, mappedBy="commande", orphanRemoval=true)
     */
    private $delivery;

    public function __construct()
    {
        $this->commandLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommand(): ?\DateTimeInterface
    {
        return $this->dateCommand;
    }

    public function setDateCommand(\DateTimeInterface $dateCommand): self
    {
        $this->dateCommand = $dateCommand;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

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
            foreach ($this->getCommandLines() as $existingItem) {
                // The item already exists, update the quantity
                if ($existingItem->equals($commandLine)) {
                    $existingItem->setQuntity(
                        $existingItem->getQuntity() + $commandLine->getQuntity()
                    );
                    return $this;
                }
            }


            $this->commandLines[] = $commandLine;
            $commandLine->setCommand($this);
        }

        return $this;
    }

    public function removeCommandLine(CommandLine $commandLine): self
    {
        if ($this->commandLines->removeElement($commandLine)) {
            // set the owning side to null (unless already changed)
            if ($commandLine->getCommand() === $this) {
                $commandLine->setCommand(null);
            }
        }

        return $this;
    }
    /**
     * Removes all items from the order.
     *
     * @return $this
     */
    public function removeItems(): self
    {
        foreach ($this->getCommandLines() as $item) {
            $this->removeCommandLine($item);
        }

        return $this;
    }

    /**
     * Calculates the order total.
     *
     * @return float
     */
    public function getTotal(): float
    {
        $total = 0;

        foreach ($this->getCommandLines() as $item) {
            $total += $item->getTotal();
        }

        return $total;
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
    public function __toString(){
        return (string)$this->getId();
    }

    public function getDelivery(): ?Delivery
    {
        return $this->delivery;
    }

    public function setDelivery(Delivery $delivery): self
    {
        // set the owning side of the relation if necessary
        if ($delivery->getCommande() !== $this) {
            $delivery->setCommande($this);
        }

        $this->delivery = $delivery;

        return $this;
    }
}
