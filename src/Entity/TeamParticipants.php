<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamParticipantsRepository")
 */
class TeamParticipants
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="teamParticipants")
     */
    private $team_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="teamParticipants")
     */
    private $user_id;

    public function getId()
    {
        return $this->id;
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

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

}
