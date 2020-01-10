<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
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
     * @ORM\Column(type="datetime")
     */
    private $date_cont;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCont(): ?\DateTimeInterface
    {
        return $this->date_cont;
    }

    public function setDateCont(\DateTimeInterface $date_cont): self
    {
        $this->date_cont = $date_cont;

        return $this;
    }
}
