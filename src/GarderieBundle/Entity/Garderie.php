<?php

namespace GarderieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToOne;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Garderie
 *
 * @ORM\Table(name="garderie")
 * @ORM\Entity(repositoryClass="GarderieBundle\Repository\GarderieRepository")
 */
class Garderie
{

    /**
     * @var int
     *
     * @ORM\Column(name="numGard", type="integer")
     * @ORM\Id

     */
    private $numGard;
    /**
     *@ORM\OneToOne(targetEntity="UserBundle\Entity\User")
     *@ORM\JoinColumn(name="resp_id",referencedColumnName="id")
     */
    private $cin_resp;
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)

     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255)
     */
    private $telephone;

    /**
     * * @var string
     * @ORM\Column(name="image", type="string", length=255)
     * @Assert\NotBlank(message="insert img plz")
     * @Assert\Image()
     */
    private $image;
    /**
     * @return int
     */
    public function getNumGard()
    {
        return $this->numGard;
    }

    /**
     * @param int $numGard
     */
    public function setNumGard($numGard)
    {
        $this->numGard = $numGard;
    }

    /**
     * @return string
     */
    public function getCinResp()
    {
        return $this->cin_resp;
    }

    /**
     * @param string $cin_resp
     */
    public function setCinResp($cin_resp)
    {
        $this->cin_resp = $cin_resp;
    }



    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Garderie
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
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Garderie
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Garderie
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

}

