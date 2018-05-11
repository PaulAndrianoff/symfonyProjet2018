<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 */
class Team
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $draw_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $end_at;

    /**
     * @ORM\Column(type="integer")
     */
    private $price_min;

    /**
     * @ORM\Column(type="integer")
     */
    private $price_max;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $team_code;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="teams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $admin_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TeamParticipant", mappedBy="team_id", orphanRemoval=true)
     */
    private $teamParticipants;

    public function __construct()
    {
        $this->teamParticipants = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getDrawAt(): ?\DateTimeInterface
    {
        return $this->draw_at;
    }

    public function setDrawAt(\DateTimeInterface $draw_at): self
    {
        $this->draw_at = $draw_at;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->end_at;
    }

    public function setEndAt(\DateTimeInterface $end_at): self
    {
        $this->end_at = $end_at;

        return $this;
    }

    public function getPriceMin(): ?int
    {
        return $this->price_min;
    }

    public function setPriceMin(int $price_min): self
    {
        $this->price_min = $price_min;

        return $this;
    }

    public function getPriceMax(): ?int
    {
        return $this->price_max;
    }

    public function setPriceMax(int $price_max): self
    {
        $this->price_max = $price_max;

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

    public function getTeamCode(): ?string
    {
        return $this->team_code;
    }

    public function setTeamCode(string $team_code): self
    {
        $this->team_code = $team_code;

        return $this;
    }

    public function getAdminId(): ?User
    {
        return $this->admin_id;
    }

    public function setAdminId(?User $admin_id): self
    {
        $this->admin_id = $admin_id;

        return $this;
    }

    /**
     * @return Collection|TeamParticipant[]
     */
    public function getTeamParticipants(): Collection
    {
        return $this->teamParticipants;
    }

    public function addTeamParticipant(TeamParticipant $teamParticipant): self
    {
        if (!$this->teamParticipants->contains($teamParticipant)) {
            $this->teamParticipants[] = $teamParticipant;
            $teamParticipant->setTeamId($this);
        }

        return $this;
    }

    public function removeTeamParticipant(TeamParticipant $teamParticipant): self
    {
        if ($this->teamParticipants->contains($teamParticipant)) {
            $this->teamParticipants->removeElement($teamParticipant);
            // set the owning side to null (unless already changed)
            if ($teamParticipant->getTeamId() === $this) {
                $teamParticipant->setTeamId(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return (string) $this->name;
    }
}
