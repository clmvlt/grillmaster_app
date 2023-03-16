<?php

namespace App\Entity;

use App\Repository\FamilleArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FamilleArticleRepository::class)]
class FamilleArticle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'famille', targetEntity: Article::class)]
    private Collection $lesArticles;

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
            $lesArticle->setFamille($this);
        }

        return $this;
    }

    public function removeLesArticle(Article $lesArticle): self
    {
        if ($this->lesArticles->removeElement($lesArticle)) {
            // set the owning side to null (unless already changed)
            if ($lesArticle->getFamille() === $this) {
                $lesArticle->setFamille(null);
            }
        }

        return $this;
    }
}
