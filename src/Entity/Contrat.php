<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContratRepository")
 */
class Contrat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $termes;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Partenaire", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $partenaire;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_co;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTermes(): ?string
    {
        return $this->termes;
    }

    public function setTermes(string $termes): self
    {
        $this->termes = $termes;

        return $this;
    }

    public function getPartenaire(): ?Partenaire
    {
        return $this->partenaire;
    }

    public function setPartenaire(Partenaire $partenaire): self
    {
        $this->partenaire = $partenaire;

        return $this;
    }

    public function getDateCo(): ?\DateTimeInterface
    {
        return $this->date_co;
    }

    public function setDateCo(\DateTimeInterface $date_co): self
    {
        $this->date_co = $date_co;

        return $this;
    }


    public function genContrat($data){
        $contrat = [
           'RC Partenaire' => $data->getPartenaire()->getRc(),
           'Ninea'=> $data->getPartenaire()->getNinea(),
           'Date de Creation' => $data->getDateCo(),
           "Termes" => $data->getTermes()
       ];
       $response = new JsonResponse($contrat);
       return $response;
   }

}
