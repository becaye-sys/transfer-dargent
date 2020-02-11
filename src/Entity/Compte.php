<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\CompteController;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompteRepository")
 *@ApiResource(
 *    normalizationContext={"groups"={"get"}},
 * denormalizationContext={"groups"={"post"}},
 * collectionOperations={
 *         "get"
 *          ,
 *         "post"={"security"="is_granted(['ROLE_SUPER_ADMIN','ROLE_ADMIN'])", "security_message"="Vous N'avez pas L'autorisation pour cree un Compte",
 * "controller"=CompteController::class
  *   }
 *     },
 * itemOperations={
 *     "get"={"normalization_context"={"groups"={"get"}}},
 *      "put"={"security"="is_granted(['ROLE_SUPER_ADMIN','ROLE_ADMIN'])", "security_message"="Vous N'avez pas L'autorisation pour cree un Compte",
 * "denormalizationContext"={"groups"={"post"}}}
 * }
 *     )
 */
class Compte
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"get", "post"})
     */
    private $numero;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"get", "post"})
     */
    private $solde;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"get", "post"})
     */
    private $date_c;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="compte")
     *@ORM\JoinColumn(nullable=false)
     * @Groups({"get", "post"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Partenaire", inversedBy="compte", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"get", "post"})
     */
    private $partenaire;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Depot", mappedBy="compte", cascade={"persist"})
     * @Groups({"get", "post"})
     */
    private $depot;

    public function __construct()
    {
        $this->depot = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }
    
    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getSolde(): ?int
    {
        return $this->solde;
    }

    public function setSolde(int $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    public function getDateC(): ?\DateTimeInterface
    {
        return $this->date_c;
    }

    public function setDateC(\DateTimeInterface $date_c): self
    {
        $this->date_c = $date_c;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPartenaire(): ?Partenaire
    {
        return $this->partenaire;
    }

    public function setPartenaire(?Partenaire $partenaire): self
    {
        $this->partenaire = $partenaire;

        return $this;
    }

    /**
     * @return Collection|Depot[]
     */
    public function getDepot(): Collection
    {
        return $this->depot;
    }

    public function addDepot(Depot $depot): self
    {
        if (!$this->depot->contains($depot)) {
            $this->depot[] = $depot;
            $depot->setCompte($this);
        }

        return $this;
    }

    public function removeDepot(Depot $depot): self
    {
        if ($this->depot->contains($depot)) {
            $this->depot->removeElement($depot);
            // set the owning side to null (unless already changed)
            if ($depot->getCompte() === $this) {
                $depot->setCompte(null);
            }
        }

        return $this;
    }
}
