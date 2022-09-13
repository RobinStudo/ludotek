<?php

namespace App\Entity;

use App\Repository\GameRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 120)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $minimumAge = null;

    #[ORM\Column]
    private ?int $minimumPlayer = null;

    #[ORM\Column(nullable: true)]
    private ?int $maximumPlayer = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?DateTimeInterface $duration = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?DateTimeInterface $releaseAt = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\ManyToMany(targetEntity: Editor::class)]
    private Collection $editors;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: GameDesigner::class, orphanRemoval: true)]
    private Collection $designers;

    public function __construct()
    {
        $this->editors = new ArrayCollection();
        $this->designers = new ArrayCollection();
    }

    public function getId(): ?int
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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMinimumAge(): ?int
    {
        return $this->minimumAge;
    }

    public function setMinimumAge(int $minimumAge): self
    {
        $this->minimumAge = $minimumAge;

        return $this;
    }

    public function getMinimumPlayer(): ?int
    {
        return $this->minimumPlayer;
    }

    public function setMinimumPlayer(int $minimumPlayer): self
    {
        $this->minimumPlayer = $minimumPlayer;

        return $this;
    }

    public function getMaximumPlayer(): ?int
    {
        return $this->maximumPlayer;
    }

    public function setMaximumPlayer(?int $maximumPlayer): self
    {
        $this->maximumPlayer = $maximumPlayer;

        return $this;
    }

    public function getDuration(): ?DateTimeInterface
    {
        return $this->duration;
    }

    public function setDuration(DateTimeInterface $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getReleaseAt(): ?DateTimeInterface
    {
        return $this->releaseAt;
    }

    public function setReleaseAt(?DateTimeInterface $releaseAt): self
    {
        $this->releaseAt = $releaseAt;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Editor>
     */
    public function getEditors(): Collection
    {
        return $this->editors;
    }

    public function addEditor(Editor $editor): self
    {
        if (!$this->editors->contains($editor)) {
            $this->editors->add($editor);
        }

        return $this;
    }

    public function removeEditor(Editor $editor): self
    {
        $this->editors->removeElement($editor);

        return $this;
    }

    /**
     * @return Collection<int, GameDesigner>
     */
    public function getDesigners(): Collection
    {
        return $this->designers;
    }

    public function addDesigner(GameDesigner $designer): self
    {
        if (!$this->designers->contains($designer)) {
            $this->designers->add($designer);
            $designer->setGame($this);
        }

        return $this;
    }

    public function removeDesigner(GameDesigner $designer): self
    {
        if ($this->designers->removeElement($designer)) {
            // set the owning side to null (unless already changed)
            if ($designer->getGame() === $this) {
                $designer->setGame(null);
            }
        }

        return $this;
    }
}
