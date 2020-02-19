<?php

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Controller\DepotController;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DepotRepository")
 * @ApiResource(
 * collectionOperations={
 *         "get"
 *          ,
 *         "post"={"security"="is_granted(['ROLE_SUPER_ADMIN','ROLE_ADMIN','ROLE_CAISSIER'])", "security_message"="Vous N'avez pas L'autorisation pour faire des Depots",
 * "controller"=DepotController::class
  *   }
 *     },
 * itemOperations={
 *     "get",
 *      "put"={"security"="is_granted(['ROLE_SUPER_ADMIN','ROLE_ADMIN','ROLE_CAISSIER'])", "security_message"="Vous N'avez pas L'autorisation pour faire des Depots"
 * ,
 * "controller"=DepotController::class
 * }
 * } )
 */
class Depot
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
    private $montant;

    /**
     * @ORM\Column(type="datetime")
      * @Groups({"get", "post"})
     */
    private $date_d;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="depot")
     *@ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Compte", inversedBy="depot")
     * @ORM\JoinColumn(nullable=false)
     */
    private $compte;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDateD(): ?\DateTimeInterface
    {
        return $this->date_d;
    }

    public function setDateD(\DateTimeInterface $date_d): self
    {
        $this->date_d = $date_d;

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

    public function getCompte(): ?Compte
    {
        return $this->compte;
    }

    public function setCompte(?Compte $compte): self
    {
        $this->compte = $compte;

        return $this;
    }
}
