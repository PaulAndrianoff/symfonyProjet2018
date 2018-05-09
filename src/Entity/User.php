<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar_img_url;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Team", mappedBy="admin_id")
     */
    private $teams;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TeamParticipants", mappedBy="user_id")
     */
    private $teamParticipants;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
        $this->teamParticipants = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getAvatarImgUrl(): ?string
    {
        return $this->avatar_img_url;
    }

    public function setAvatarImgUrl(?string $avatar_img_url): self
    {
        $this->avatar_img_url = $avatar_img_url;

        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): self
    {
        if (!$this->teams->contains($team)) {
            $this->teams[] = $team;
            $team->addAdminId($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams->contains($team)) {
            $this->teams->removeElement($team);
            $team->removeAdminId($this);
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
            $teamParticipant->setUserId($this);
        }

        return $this;
    }

    public function removeTeamParticipant(TeamParticipants $teamParticipant): self
    {
        if ($this->teamParticipants->contains($teamParticipant)) {
            $this->teamParticipants->removeElement($teamParticipant);
            // set the owning side to null (unless already changed)
            if ($teamParticipant->getUserId() === $this) {
                $teamParticipant->setUserId(null);
            }
        }

        return $this;
    }
}
