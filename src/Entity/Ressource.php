<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RessourceRepository")
 */
class Ressource
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $descriptif;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateAjout;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $urlRessource;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $urlVignette;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeRessource", inversedBy="ressources", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeRessource;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Module", inversedBy="ressources")
     */
    private $modules;

    public function __construct()
    {
        $this->modules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(string $descriptif): self
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    public function getDateAjout(): ?\DateTimeInterface
    {
        return $this->dateAjout;
    }

    public function setDateAjout(\DateTimeInterface $dateAjout): self
    {
        $this->dateAjout = $dateAjout;

        return $this;
    }

    public function getUrlRessource(): ?string
    {
        return $this->urlRessource;
    }

    public function setUrlRessource(string $urlRessource): self
    {
        $this->urlRessource = $urlRessource;

        return $this;
    }

    public function getUrlVignette(): ?string
    {
        return $this->urlVignette;
    }

    public function setUrlVignette(string $urlVignette): self
    {
        $this->urlVignette = $urlVignette;

        return $this;
    }

    public function getTypeRessource(): ?TypeRessource
    {
        return $this->typeRessource;
    }

    public function setTypeRessource(?TypeRessource $typeRessource): self
    {
        $this->typeRessource = $typeRessource;

        return $this;
    }

    /**
     * @return Collection|Module[]
     */
    public function getModules(): Collection
    {
        return $this->modules;
    }

    public function addModule(Module $module): self
    {
        if (!$this->modules->contains($module)) {
            $this->modules[] = $module;
        }

        return $this;
    }

    public function removeModule(Module $module): self
    {
        if ($this->modules->contains($module)) {
            $this->modules->removeElement($module);
        }

        return $this;
    }
}
