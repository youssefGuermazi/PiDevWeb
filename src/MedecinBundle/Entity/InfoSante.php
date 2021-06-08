<?php

namespace MedecinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * InfoSante
 *
 * @ORM\Table(name="info_sante")
 * @ORM\Entity(repositoryClass="MedecinBundle\Repository\InfoSanteRepository")
 */
class InfoSante
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
     * @var string
     *
     * @ORM\Column(name="info", type="string", length=255)
     */
    private $info;

    /**
     * @var string
     *
     * @ORM\Column(name="datevaccin", type="string", length=255)
     *
     * @Assert\DateTime()
     */
    private $datevaccin;


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
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @param string $info
     */
    public function setInfo($info)
    {
        $this->info = $info;
    }

    /**
     * @return string
     */
    public function getDatevaccin()
    {
        return $this->datevaccin;
    }

    /**
     * @param string $datevaccin
     */
    public function setDatevaccin($datevaccin)
    {
        $this->datevaccin = $datevaccin;
    }

    /**
     * @var \MedecinBundle\Entity\Medecin
     *
     * @ORM\ManyToOne(targetEntity="\MedecinBundle\Entity\Medecin")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_medecin", referencedColumnName="cin")
     * })
     */
    private $idmedecin;

    /**
     * @return Medecin
     */
    public function getIdmedecin()
    {
        return $this->idmedecin;
    }

    /**
     * @param Medecin $idmedecin
     */
    public function setIdmedecin($idmedecin)
    {
        $this->idmedecin = $idmedecin;
    }


}

