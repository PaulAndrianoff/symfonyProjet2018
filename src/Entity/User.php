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
     * @ORM\Column(type="string", length=150)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Team", mappedBy="admin_id", orphanRemoval=true)
     */
    private $teams;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category")
     */
    private $category_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TeamParticipant", mappedBy="user_id", orphanRemoval=true)
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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
            $team->setAdminId($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams->contains($team)) {
            $this->teams->removeElement($team);
            // set the owning side to null (unless already changed)
            if ($team->getAdminId() === $this) {
                $team->setAdminId(null);
            }
        }

        return $this;
    }

    public function getCategoryId(): ?Category
    {
        return $this->category_id;
    }

    public function setCategoryId(?Category $category_id): self
    {
        $this->category_id = $category_id;

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
            $teamParticipant->setUserId($this);
        }

        return $this;
    }

    public function removeTeamParticipant(TeamParticipant $teamParticipant): self
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

    public function __toString() {
        return (string) $this->name;
    }
}
