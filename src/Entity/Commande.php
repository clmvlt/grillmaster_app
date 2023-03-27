<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $montant_euro = null;

    #[ORM\Column]
    private ?int $montant_fidelite = null;

    #[ORM\Column]
    private ?int $gain_fidelite = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_commande = null;

    #[ORM\ManyToOne(inversedBy: 'lesCommandes')]
    private ?TypeCommande $id_typecommande = null;

    #[ORM\ManyToOne(inversedBy: 'lesCommandes')]
    private ?User $id_utilisateur = null;

    #[ORM\ManyToMany(targetEntity: Article::class, inversedBy: 'lesCommandes')]
    private Collection $lesArticles;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?User $User = null;


    public function __construct()
    {
        $this->lesArticles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontantEuro(): ?float
    {
        return $this->montant_euro;
    }

    public function setMontantEuro(float $montant_euro): self
    {
        $this->montant_euro = $montant_euro;

        return $this;
    }

    public function getMontantFidelite(): ?int
    {
        return $this->montant_fidelite;
    }

    public function setMontantFidelite(int $montant_fidelite): self
    {
        $this->montant_fidelite = $montant_fidelite;

        return $this;
    }

    public function getGainFidelite(): ?int
    {
        return $this->gain_fidelite;
    }

    public function setGainFidelite(int $gain_fidelite): self
    {
        $this->gain_fidelite = $gain_fidelite;

        return $this;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->date_commande;
    }

    public function setDateCommande(\DateTimeInterface $date_commande): self
    {
        $this->date_commande = $date_commande;

        return $this;
    }

    public function getIdTypecommande(): ?TypeCommande
    {
        return $this->id_typecommande;
    }

    public function setIdTypecommande(?TypeCommande $id_typecommande): self
    {
        $this->id_typecommande = $id_typecommande;

        return $this;
    }

    public function getIdUtilisateur(): ?User
    {
        return $this->id_utilisateur;
    }

    public function setIdUtilisateur(?User $id_utilisateur): self
    {
        $this->id_utilisateur = $id_utilisateur;

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

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

}
