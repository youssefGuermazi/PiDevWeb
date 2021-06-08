<?php

namespace GarderieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToOne;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Responsable
 *
 * @ORM\Table(name="responsable")
 * @ORM\Entity(repositoryClass="GarderieBundle\Repository\ResponsableRepository")
 */
class Responsable
{
    /**
     * @var int
     *
     * @ORM\Column(name="cin", type="integer")
     * @ORM\Id

     * @Assert\Length(
     * min=8,
     * max=8,

     * maxMessage="verifier cin svp"
     * )

     */
    private $cin;

    /**
     *@ORM\OneToOne(targetEntity="GarderieBundle\Entity\Garderie")
     *@ORM\JoinColumn(name="garderie_id",referencedColumnName="numGard")


     */
    private $numero_garderie;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @return int
     *
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * @param int $cin
     *
     */
    public function setCin($cin)
    {
        $this->cin = $cin;


    }

    /**
     * @return string
     */
    public function getNumeroGarderie()
    {
        return $this->numero_garderie;
    }

    /**
     * @param string $numero_garderie
     */
    public function setNumeroGarderie($numero_garderie)
    {
        $this->numero_garderie = $numero_garderie;
    }




    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Responsable
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Responsable
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }
}


