<?php

namespace MedecinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Medecin
 *
 * @ORM\Table(name="medecin")
 * @ORM\Entity(repositoryClass="MedecinBundle\Repository\MedecinRepository")
 */
class Medecin
{
    /**
     * @var string
     *
     * @ORM\Column(name="cin", type="string")
     * @ORM\Id
     *  @Assert\Length(min=8,max=8)
     */
    private $cin;

    /**
     * @var string
     *
     * @ORM\Column(name="specialite", type="string")
     */
    private $specialite;

    /**
     * @return string
     */
    public function getSpecialite()
    {
        return $this->specialite;
    }

    /**
     * @param string $specialite
     */
    public function setSpecialite($specialite)
    {
        $this->specialite = $specialite;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     *
     * @Assert\Length(max=8)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     *
     * @Assert\Length(max=10)
     */
    private $prenom;

    /**
     * @return string
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * @param string $cin
     */
    public function setCin($cin)
    {
        $this->cin = $cin;
    }




    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return medecin
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
     * @return medecin
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

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Assert\Valid()
     */
    public $nomfile;


    /**
     * @Assert\File(maxSize="500000000k")
     */
    public  $file;

    public function getWebpath(){


        return null === $this->nomfile ? null : $this->getUploadDir.'/'.$this->nomfile;
    }
    protected  function  getUploadRootDir(){

        return __DIR__.'/../../../web/Upload'.$this->getUploadDir();
    }
    protected function getUploadDir(){

        return'';
    }
    public function getUploadFile(){
        if (null === $this->getFile()) {
            $this->nomfile = "3.jpg";
            return;
        }


        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->getFile()->getClientOriginalName()

        );

        // set the path property to the filename where you've saved the file
        $this->nomfile = $this->getFile()->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }

    /**
     * @return mixed
     */
    public function getNomfile()
    {
        return $this->nomfile;
    }

    /**
     * @param mixed $nomfile
     */
    public function setNomfile($nomfile)
    {
        $this->nomfile = $nomfile;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }





}

