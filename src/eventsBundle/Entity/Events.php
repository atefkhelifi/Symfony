<?php

namespace eventsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Tests\StringableObject;

/**
 * Events
 *
 * @ORM\Table(name="events")
 * @ORM\Entity
 */
class Events
{

    /**
     * @ORM\ManyToOne(targetEntity="category", inversedBy="Events")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="InscriptionE", mappedBy="event")
     */
    private $inscriptions;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();

    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return  $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
         $this->category = $category;
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_event", type="string", length=255, nullable=false)
     */
    private $nomEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="localisation_event", type="string", length=255, nullable=false)
     */
    private $localisationEvent;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix_event", type="integer", nullable=false)
     */
    private $prixEvent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_event", type="date", nullable=false)
     */
    private $dateEvent;

    /**
     * @var integer
     *
     * @ORM\Column(name="place_dispo", type="integer", nullable=false)
     */
    private $placeDispo;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @return string
     */
    public function getNomEvent()
    {
        return $this->nomEvent;
    }

    /**
     * @param string $nomEvent
     */
    public function setNomEvent($nomEvent)
    {
        $this->nomEvent = $nomEvent;
    }

    /**
     * @return string
     */
    public function getLocalisationEvent()
    {
        return $this->localisationEvent;
    }

    /**
     * @param string $localisationEvent
     */
    public function setLocalisationEvent($localisationEvent)
    {
        $this->localisationEvent = $localisationEvent;
    }

    /**
     * @return int
     */
    public function getPrixEvent()
    {
        return $this->prixEvent;
    }

    /**
     * @param int $prixEvent
     */
    public function setPrixEvent($prixEvent)
    {
        $this->prixEvent = $prixEvent;
    }

    /**
     * @return \DateTime
     */
    public function getDateEvent()
    {
        return $this->dateEvent;
    }

    /**
     * @param \DateTime $dateEvent
     */
    public function setDateEvent($dateEvent)
    {
        $this->dateEvent = $dateEvent;
    }

    /**
     * @return int
     */
    public function getPlaceDispo()
    {
        return $this->placeDispo;
    }

    /**
     * @param int $placeDispo
     */
    public function setPlaceDispo($placeDispo)
    {
        $this->placeDispo = $placeDispo;
    }

    /**
     * @return ArrayCollection
     */
    public function getInscriptions()
    {
        return $this->inscriptions;
    }

    /**
     * @param ArrayCollection $inscriptions
     */
    public function setInscriptions($inscriptions)
    {
        $this->inscriptions = $inscriptions;
    }


}

