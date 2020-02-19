<?php

namespace App\Entity;
use App\Entity\Role;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\PickController;
use App\Controller\UserController;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
* @ApiResource(
 * collectionOperations={
 *         "get"={
 *          "normalization_context"={"groups"={"get"}}},
 *         "post"={"security"="is_granted(['ROLE_SUPER_ADMIN','ROLE_ADMIN','ROLE_PARTENAIRE','ROLE_ADMIN_PART'])", "security_message"="Vous N'avez pas L'autorisation pour cree ce type de User",
 * "controller"=UserController::class,
*"denormalizationContext"={"groups"={"post"}}}
 *     },
 * itemOperations={
 *    "get",
 *         "put"={
 * "security"="is_granted(['ROLE_SUPER_ADMIN','ROLE_ADMIN','ROLE_PARTENAIRE','ROLE_ADMIN_PART'])", "security_message"="Vous N'avez pas L'autorisation pour cree ce type de User",
 * "method"="put",
 * "normalization_context"={"groups"={"get"}},
 * },
 *         "put_image"={
 * * "method"="put",
 *         "path"="/users/{id}/image",
 *             "controller"=PickController::class,
 *             "deserialize"=false,
 *             "openapi_context"={
 *                 "requestBody"={
 *                     "content"={
 *                         "multipart/form-data"={
 *                             "schema"={
 *                                 "type"="object",
 *                                 "properties"={
 *                                     "file"={
 *                                         "type"="string",
 *                                         "format"="binary"
 *                                     }
 *                                 }
 *                             }
 *                         }
 *                     }
 *                 }
 *             }
 *         },
 *  
 *             
 *     },
 *    
 *     )
 */
class User implements UserInterface
{

    // public function __construct($isActive)
    // {
        
    //     $this->isActive = true;
    // }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"get", "post"})
     */
    private $username;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", length=255)
      * @Groups({"get", "post"})
     */
    private $password;

    /**
    * @ORM\Column(name="is_active", type="boolean")
    * @Groups({"get", "post"})
     */
    private $isActive;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Role", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"get", "post"})
     */
    private $owner;
    /**
     * @SerializedName("password")
     */

    private $plainPassword;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Partenaire", inversedBy="users")
     */
    private $partenaire;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Compte", mappedBy="user")
     */
    private $compte;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Depot", mappedBy="user")
     */
    private $depot;
    /**
* @ORM\Column(type="blob", nullable=true)
    */
    private $image;
                                                

    public function __construct()
    {
        $this->compte = new ArrayCollection();
        $this->depot = new ArrayCollection();
        $this->isActive = true;
    }
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }
    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->owner->getLibelle();
        // guarantee every user at least has ROLE_USER
        
      //  return json_decode($roles);

        return array($roles);
    }

    public function setRole(?Role $owner)
    {
        $this->owner = $owner;

        return $this;
    }


    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getOwner(): ?Role
    {
        return $this->owner;
    }

    public function setOwner(?Role $owner): self
    {
        $this->owner = $owner;

        return $this;
    }



    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

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
     * @return Collection|Compte[]
     */
    public function getCompte(): Collection
    {
        return $this->compte;
    }

    public function addCompte(Compte $compte): self
    {
        if (!$this->compte->contains($compte)) {
            $this->compte[] = $compte;
            $compte->setUser($this);
        }

        return $this;
    }

    public function removeCompte(Compte $compte): self
    {
        if ($this->compte->contains($compte)) {
            $this->compte->removeElement($compte);
            // set the owning side to null (unless already changed)
            if ($compte->getUser() === $this) {
                $compte->setUser(null);
            }
        }

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
            $depot->setUser($this);
        }

        return $this;
    }

    public function removeDepot(Depot $depot): self
    {
        if ($this->depot->contains($depot)) {
            $this->depot->removeElement($depot);
            // set the owning side to null (unless already changed)
            if ($depot->getUser() === $this) {
                $depot->setUser(null);
            }
        }

        return $this;
    }
}