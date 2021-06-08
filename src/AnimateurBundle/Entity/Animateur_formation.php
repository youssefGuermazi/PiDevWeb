<?php

namespace AnimateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Animateur_formation
 *
 * @ORM\Table(name="animateur_formation")
 * @ORM\Entity(repositoryClass="AnimateurBundle\Repository\Animateur_formationRepository")
 */
class Animateur_formation
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
     * @var \AnimateurBundle\Entity\formation
     *
     * @ORM\ManyToOne(targetEntity="AnimateurBundle\Entity\formation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idformateur", referencedColumnName="id" ,onDelete="CASCADE")
     * })
     */
    private $idformateur;

    /**
     * @var \AnimateurBundle\Entity\Animateur
     *
     * @ORM\ManyToOne(targetEntity="AnimateurBundle\Entity\Animateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idAnimateur", referencedColumnName="cin")
     * })
     */
    private $idAnimateur;

    /**
     * @return formation
     */
    public function getIdformateur()
    {
        return $this->idformateur;
    }

    /**
     * @param formation $idformateur
     */
    public function setIdformateur($idformateur)
    {
        $this->idformateur = $idformateur;
    }

    /**
     * @return Animateur
     */
    public function getIdAnimateur()
    {
        return $this->idAnimateur;
    }

    /**
     * @param Animateur $idAnimateur
     */
    public function setIdAnimateur($idAnimateur)
    {
        $this->idAnimateur = $idAnimateur;
    }






}

