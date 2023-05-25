<?php

namespace App\Entity;

use App\Repository\RuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RuleRepository::class)]
class Rule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'rule', targetEntity: User::class)]
    private Collection $author;

    #[ORM\ManyToMany(targetEntity: Ride::class, mappedBy: 'rules')]
    private Collection $rides;

    public function __construct()
    {
        $this->author = new ArrayCollection();
        $this->rides = new ArrayCollection();
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
     * @return Collection<int, User>
     */
    public function getAuthor(): Collection
    {
        return $this->author;
    }

    public function addAuthor(User $author): self
    {
        if (!$this->author->contains($author)) {
            $this->author->add($author);
            $author->setRule($this);
        }

        return $this;
    }

    public function removeAuthor(User $author): self
    {
        if ($this->author->removeElement($author)) {
            // set the owning side to null (unless already changed)
            if ($author->getRule() === $this) {
                $author->setRule(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Ride>
     */
    public function getRides(): Collection
    {
        return $this->rides;
    }

    public function addRide(Ride $ride): self
    {
        if (!$this->rides->contains($ride)) {
            $this->rides->add($ride);
            $ride->addRule($this);
        }

        return $this;
    }

    public function removeRide(Ride $ride): self
    {
        if ($this->rides->removeElement($ride)) {
            $ride->removeRule($this);
        }

        return $this;
    }




}
