<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $confirmed = null;


    #[ORM\OneToMany(mappedBy: 'reservation', targetEntity: Ride::class)]
    private Collection $ride;

    #[ORM\OneToMany(mappedBy: 'reservation', targetEntity: User::class)]
    private Collection $passenger;

    public function __construct()
    {
        $this->ride = new ArrayCollection();
        $this->passenger = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isConfirmed(): ?bool
    {
        return $this->confirmed;
    }

    public function setConfirmed(bool $confirmed): self
    {
        $this->confirmed = $confirmed;

        return $this;
    }




    /**
     * @return Collection<int, Ride>
     */
    public function getRide(): Collection
    {
        return $this->ride;
    }

    public function addRide(Ride $ride): self
    {
        if (!$this->ride->contains($ride)) {
            $this->ride->add($ride);
            $ride->setReservation($this);
        }

        return $this;
    }

    public function removeRide(Ride $ride): self
    {
        if ($this->ride->removeElement($ride)) {
            // set the owning side to null (unless already changed)
            if ($ride->getReservation() === $this) {
                $ride->setReservation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getPassenger(): Collection
    {
        return $this->passenger;
    }

    public function addPassenger(User $passenger): self
    {
        if (!$this->passenger->contains($passenger)) {
            $this->passenger->add($passenger);
            $passenger->setReservation($this);
        }

        return $this;
    }

    public function removePassenger(User $passenger): self
    {
        if ($this->passenger->removeElement($passenger)) {
            // set the owning side to null (unless already changed)
            if ($passenger->getReservation() === $this) {
                $passenger->setReservation(null);
            }
        }

        return $this;
    }
}
