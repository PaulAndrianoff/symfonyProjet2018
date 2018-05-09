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
     * @ORM\GeneratedValue()
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $draw_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $end_at;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\user", inversedBy="teams")
     */
    private $admin_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TeamParticipants", mappedBy="team_id")
     */
    private $teamParticipants;

    public function __construct()
    {
        $this->admin_id = new ArrayCollection();
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

    public function setDrawAt(?\DateTimeInterface $draw_at): self
    {
        $this->draw_at = $draw_at;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->end_at;
    }

    public function setEndAt(?\DateTimeInterface $end_at): self
    {
        $this->end_at = $end_at;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|user[]
     */
    public function getAdminId(): Collection
    {
        return $this->admin_id;
    }

    public function addAdminId(user $adminId): self
    {
        if (!$this->admin_id->contains($adminId)) {
            $this->admin_id[] = $adminId;
        }

        return $this;
    }

    public function removeAdminId(user $adminId): self
    {
        if ($this->admin_id->contains($adminId)) {
            $this->admin_id->removeElement($adminId);
        }

        return $this;
    }

    /**
     * @return Collection|TeamParticipants[]
     */
    public function getTeamParticipants(): Collection
    {
        return $this->teamParticipants;
    }

    public function addTeamParticipant(TeamParticipants $teamParticipant): self
    {
        if (!$this->teamParticipants->contains($teamParticipant)) {
            $this->teamParticipants[] = $teamParticipant;
            $teamParticipant->setTeamId($this);
        }

        return $this;
    }

    public function removeTeamParticipant(TeamParticipants $teamParticipant): self
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

}
