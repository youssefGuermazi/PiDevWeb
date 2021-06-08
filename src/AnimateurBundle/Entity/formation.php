<?php

namespace AnimateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * formation
 *
 * @ORM\Table(name="formation")
 * @ORM\Entity(repositoryClass="AnimateurBundle\Repository\formationRepository")
 */
class formation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */

    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="dated", type="string", length=255)
     * @Assert\Date()
     */
    private $dated;

    /**
     * @var string
     *
     * @ORM\Column(name="datef", type="string", length=255)
     * @Assert\Date()
     */
    private $datef;

    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDated()
    {
        return $this->dated;
    }

    /**
     * @param string $dated
     */
    public function setDated($dated)
    {
        $this->dated = $dated;
    }

    /**
     * @return string
     */
    public function getDatef()
    {
        return $this->datef;
    }

    /**
     * @param string $datef
     */
    public function setDatef($datef)
    {
        $this->datef = $datef;
    }




}

