<?php

namespace AnimateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;


// src/AppBundle/Entity/MyEntity.php




/**
 * @ORM\Entity


 * Animateur
 *
 * @ORM\Table(name="animateur")
 * @ORM\Entity(repositoryClass="AnimateurBundle\Repository\AnimateurRepository")
 */
class Animateur

{
    /**
     * @var string
     *
     * @ORM\Column(name="cin", type="integer")
     * @ORM\Id
     * * @Assert\Length(max=8,min=8)
     */
    private $cin;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     * @Assert\Length(max=8,min=3)
     */

    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     * @Assert\Length(max=8,min=3)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="activiter", type="string", length=255)
     */
    private $activiter;


    /**
     *
     * @ORM\Column(name="rate", type="float", nullable=true)
     */
    private $rate;

    /**
     *
     * @ORM\Column(name="vote", type="integer", nullable=true)
     */
    private $vote;

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
     * @return animateur
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
     * @return animateur
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
     * Set activiter
     *
     * @param string $activiter
     *
     * @return animateur
     */
    public function setActiviter($activiter)
    {
        $this->activiter = $activiter;

        return $this;
    }

    /**
     * Get activiter
     *
     * @return string
     */
    public function getActiviter()
    {
        return $this->activiter;
    }

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
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

    /**
     * @return mixed
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @param mixed $rate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    }

    /**
     * @return mixed
     */
    public function getVote()
    {
        return $this->vote;
    }

    /**
     * @param mixed $vote
     */
    public function setVote($vote)
    {
        $this->vote = $vote;
    }


}



