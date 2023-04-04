<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\ManyToMany(targetEntity: Article::class, inversedBy: 'lesMenus')]
    private Collection $lesArticles;

    #[ORM\Column(length: 8000000)]
    private ?string $image = null;

    public function __construct()
    {
        $this->lesArticles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getLesArticles(): Collection
    {
        return $this->lesArticles;
    }

    public function addLesArticle(Article $lesArticle): self
    {
        if (!$this->lesArticles->contains($lesArticle)) {
            $this->lesArticles->add($lesArticle);
        }

        return $this;
    }

    public function removeLesArticle(Article $lesArticle): self
    {
        $this->lesArticles->removeElement($lesArticle);

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

}
