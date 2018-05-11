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
    private $end_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $draw_at;

    /**
     * @ORM\Column(type="integer")
     */
    private $fixe_price;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $admin_email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $admin_password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Participant", mappedBy="team_id", orphanRemoval=true)
     */
    private $participants;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getcreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setcreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

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

    public function getDrawAt(): ?\DateTimeInterface
    {
        return $this->draw_at;
    }

    public function setDrawAt(\DateTimeInterface $draw_at): self
    {
        $this->draw_at = $draw_at;

        return $this;
    }

    public function getFixePrice(): ?int
    {
        return $this->fixe_price;
    }

    public function setFixePrice(int $fixe_price): self
    {
        $this->fixe_price = $fixe_price;

        return $this;
    }

    public function getAdminEmail(): ?string
    {
        return $this->admin_email;
    }

    public function setAdminEmail(string $admin_email): self
    {
        $this->admin_email = $admin_email;

        return $this;
    }

    public function getAdminPassword(): ?string
    {
        return $this->admin_password;
    }

    public function setAdminPassword(string $admin_password): self
    {
        $this->admin_password = $admin_password;

        return $this;
    }

    /**
     * @return Collection|Participant[]
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(Participant $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants[] = $participant;
            $participant->setTeamId($this);
        }

        return $this;
    }

    public function removeParticipant(Participant $participant): self
    {
        if ($this->participants->contains($participant)) {
            $this->participants->removeElement($participant);
            // set the owning side to null (unless already changed)
            if ($participant->getTeamId() === $this) {
                $participant->setTeamId(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return (string) $this->id;
    }
}
