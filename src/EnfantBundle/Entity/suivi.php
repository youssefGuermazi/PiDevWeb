<?php

namespace EnfantBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * suivi
 *
 * @ORM\Table(name="suivi")
 * @ORM\Entity(repositoryClass="EnfantBundle\Repository\suiviRepository")
 */
class suivi
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
     * @var int
     *
     * @ORM\Column(name="note_francais", type="integer")
     */
    private $noteFrancais;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */

    private $date;

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }
    /**
     * @var int
     *
     * @ORM\Column(name="note_anglais", type="integer")
     */
    private $noteAnglais;

    /**
     * @var int
     *
     * @ORM\Column(name="note_info", type="integer")
     */
    private $noteInfo;

    /**
     * @var string
     *
     * @ORM\Column(name="evaluation", type="string", length=255)
     */
    private $evaluation;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="enfant")
     * @ORM\JoinColumn(name="enfant_id",referencedColumnName="id",onDelete="CASCADE")
     */
    private $enfant;

    /**
     * @return mixed
     */
    public function getEnfant()
    {
        return $this->enfant;
    }

    /**
     * @param mixed $enfant
     */
    public function setEnfant($enfant)
    {
        $this->enfant = $enfant;
    }
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
     * Set noteFrancais
     *
     * @param integer $noteFrancais
     *
     * @return suivi
     */
    public function setNoteFrancais($noteFrancais)
    {
        $this->noteFrancais = $noteFrancais;

        return $this;
    }

    /**
     * Get noteFrancais
     *
     * @return int
     */
    public function getNoteFrancais()
    {
        return $this->noteFrancais;
    }

    /**
     * Set noteAnglais
     *
     * @param integer $noteAnglais
     *
     * @return suivi
     */
    public function setNoteAnglais($noteAnglais)
    {
        $this->noteAnglais = $noteAnglais;

        return $this;
    }

    /**
     * Get noteAnglais
     *
     * @return int
     */
    public function getNoteAnglais()
    {
        return $this->noteAnglais;
    }

    /**
     * Set noteInfo
     *
     * @param integer $noteInfo
     *
     * @return suivi
     */
    public function setNoteInfo($noteInfo)
    {
        $this->noteInfo = $noteInfo;

        return $this;
    }

    /**
     * Get noteInfo
     *
     * @return int
     */
    public function getNoteInfo()
    {
        return $this->noteInfo;
    }

    /**
     * Set evaluation
     *
     * @param string $evaluation
     *
     * @return suivi
     */
    public function setEvaluation($evaluation)
    {
        $this->evaluation = $evaluation;

        return $this;
    }

    /**
     * Get evaluation
     *
     * @return string
     */
    public function getEvaluation()
    {
        return $this->evaluation;
    }
    public function __toString()
    {
        return (string) $this->getEnfant();
    }
}

