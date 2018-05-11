<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamParticipantRepository")
 */
class TeamParticipant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="teamParticipants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $team_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="teamParticipants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="teamParticipants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $matched_user_id;

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

    public function getMatchedUserId(): ?User
    {
        return $this->matched_user_id;
    }

    public function setMatchedUserId(?User $matched_user_id): self
    {
        $this->matched_user_id = $matched_user_id;

        return $this;
    }
}
