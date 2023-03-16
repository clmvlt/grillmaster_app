<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(length: 8000000)]
    private ?string $image = null;

    #[ORM\Column]
    private ?float $prix_euro = null;

    #[ORM\Column]
    private ?int $prix_fidelite = null;

    #[ORM\Column]
    private ?bool $fidelite = null;

    #[ORM\Column(length: 1000)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\ManyToMany(targetEntity: Commande::class, mappedBy: 'lesArticles')]
    private Collection $lesCommandes;

    #[ORM\ManyToMany(targetEntity: Menu::class, mappedBy: 'lesArticles')]
    private Collection $lesMenus;

    #[ORM\ManyToOne(inversedBy: 'lesArticles')]
    private ?FamilleArticle $famille = null;

    public function __construct()
    {
        $this->lesCommandes = new ArrayCollection();
        $this->lesMenus = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPrixEuro(): ?float
    {
        return $this->prix_euro;
    }

    public function setPrixEuro(float $prix_euro): self
    {
        $this->prix_euro = $prix_euro;

        return $this;
    }

    public function getPrixFidelite(): ?int
    {
        return $this->prix_fidelite;
    }

    public function setPrixFidelite(int $prix_fidelite): self
    {
        $this->prix_fidelite = $prix_fidelite;

        return $this;
    }

    public function isFidelite(): ?bool
    {
        return $this->fidelite;
    }

    public function setFidelite(bool $fidelite): self
    {
        $this->fidelite = $fidelite;

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

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getLesCommandes(): Collection
    {
        return $this->lesCommandes;
    }

    public function addLesCommande(Commande $lesCommande): self
    {
        if (!$this->lesCommandes->contains($lesCommande)) {
            $this->lesCommandes->add($lesCommande);
            $lesCommande->addLesArticle($this);
        }

        return $this;
    }

    public function removeLesCommande(Commande $lesCommande): self
    {
        if ($this->lesCommandes->removeElement($lesCommande)) {
            $lesCommande->removeLesArticle($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Menu>
     */
    public function getLesMenus(): Collection
    {
        return $this->lesMenus;
    }

    public function addLesMenu(Menu $lesMenu): self
    {
        if (!$this->lesMenus->contains($lesMenu)) {
            $this->lesMenus->add($lesMenu);
            $lesMenu->addLesArticle($this);
        }

        return $this;
    }

    public function removeLesMenu(Menu $lesMenu): self
    {
        if ($this->lesMenus->removeElement($lesMenu)) {
            $lesMenu->removeLesArticle($this);
        }

        return $this;
    }

    public function getFamille(): ?FamilleArticle
    {
        return $this->famille;
    }

    public function setFamille(?FamilleArticle $famille): self
    {
        $this->famille = $famille;

        return $this;
    }

}
