<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParticipantRepository")
 */
class Participant
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
    private $email;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $pseudo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="participants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $team_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $avatar;

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

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getTeamId(): ?Team
    {
        return $this->team_id;
    }

    public function setTeamId(?Team $team_id): self
    {
        $this->team_id = $team_id;

        return $this;
    }

    public function getAvatar(): ?int
    {
        return $this->avatar;
    }

    public function setAvatar(?int $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }
}
