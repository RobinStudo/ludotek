<?php

namespace App\Entity;

use App\Repository\GameDesignerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameDesignerRepository::class)]
class GameDesigner
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'designers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Game $game = null;

    #[ORM\Id]
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Designer $designer = null;

    #[ORM\Column]
    private array $roles = [];

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        $this->game = $game;

        return $this;
    }

    public function getDesigner(): ?Designer
    {
        return $this->designer;
    }

    public function setDesigner(?Designer $designer): self
    {
        $this->designer = $designer;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
}
