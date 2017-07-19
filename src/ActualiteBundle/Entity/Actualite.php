<?php

namespace ActualiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Cocur\Slugify\Slugify;


/**
 * Actualite
 *
 * @ORM\Table(name="actualite")
 * @ORM\Entity(repositoryClass="ActualiteBundle\Repository\ActualiteRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Actualite
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
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetimetz")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="changed", type="datetimetz", nullable=true)
     */
    private $changed;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     * @Assert\NotBlank(message="Compléter le champ titre")
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="resume", type="text")
     * @Assert\NotBlank(message="Compléter le champ résumé")
     */
    private $resume;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     * @Assert\NotBlank(message="Compléter le champ contenu")
     */
    private $contenu;

    /**
     * @var string
     *
     * @ORM\Column(name="metatitle", type="string", length=255)
     * @Assert\NotBlank(message="Compléter le champ méta title")
     */
    private $metatitle;

    /**
     * @var string
     *
     * @ORM\Column(name="metadescription", type="string", length=255)
     * @Assert\NotBlank(message="Compléter le champ méta description")
     */
    private $metadescription;

    /**
     * @Assert\Image(
        minWidth = 640,
        minHeight = 480,
        mimeTypes = {"image/jpeg", "image/png"}),
        maxSize = "3M"
     */
    private $fileimage;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=32)
     */
    private $image;

    /**
     * @var int
     *
     * @ORM\Column(name="poid", type="integer")
     */
    private $poid;

    /**
     * @var bool
     *
     * @ORM\Column(name="isActive", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\ManyToOne(targetEntity="ActualiteBundle\Entity\Categorie")
     */
    private $categorie;

    /**
     * @var bool
     *
     * @ORM\Column(name="avant", type="boolean")
     */
    private $avant;

    public function __construct()
    {
        $this->isActive = true;
        $this->created = new \DateTime();
        $this->poid = 1;
        $this->avant = true;
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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Actualite
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set changed
     *
     * @param \DateTime $changed
     *
     * @return Actualite
     */
    public function setChanged($changed)
    {
        $this->changed = $changed;

        return $this;
    }

    /**
     * Get changed
     *
     * @return \DateTime
     */
    public function getChanged()
    {
        return $this->changed;
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preChanged()
    {
        $this->changed = new \DateTime();
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Actualite
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Actualite
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preSlug()
    {
        $slugify = new Slugify();
        $this->slug = $slugify->slugify($this->titre);
    }

    /**
     * Set resume
     *
     * @param string $resume
     *
     * @return Actualite
     */
    public function setResume($resume)
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * Get resume
     *
     * @return string
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Actualite
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Actualite
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    public function getFileimage()
    {
        return $this->fileimage;
    }

    public function setFileimage(UploadedFile $fileimage = null)
    {
        $this->fileimage = $fileimage;
        if (null !== $this->image){
            $this->image = null;
        }
    }

    public function uploadImage()
    {
        // Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
        if (null === $this->fileimage) {
            return;
        }

        $this->image = uniqid().'.'.strtolower(pathinfo($this->fileimage->getClientOriginalName(), PATHINFO_EXTENSION));

        $imagine = new Imagine();

        /* Tmp */
        $size = new Box(1920,1080);
        $imagine->open($this->fileimage)
                ->thumbnail($size, 'inset')
                ->save($this->getUploadRootDir().'tmp/'.$this->image);

        /* Miniature */
        $size = new Box(630,390);
        $imagine->open($this->fileimage)
            ->thumbnail($size, 'outbound')
            ->save($this->getUploadRootDir().'miniature/'.$this->image);


    }

    /**
     * On retourne le chemin relatif vers le slider pour notre code PHP
     */
    public function getUploadRootDir()
    {
        return __DIR__.'/../../../web/img/actualite/';
    }

    /**
     * @Assert\Callback
     */
    public function isFileimageValid(ExecutionContextInterface $context)
    {

        if(empty($this->id)){
            if(empty($this->fileimage)) $context->buildViolation('Complétez le champ image')->atPath('fileimage')->addViolation();
        }

    }

    /**
     * Set poid
     *
     * @param integer $poid
     *
     * @return Actualite
     */
    public function setPoid($poid)
    {
        $this->poid = $poid;

        return $this;
    }

    /**
     * Get poid
     *
     * @return int
     */
    public function getPoid()
    {
        return $this->poid;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Actualite
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return bool
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Retourne 1 si actif 0 si pas actif
     */
    public function reverseState()
    {
        $etat = $this->getIsActive();

        return !$etat;
    }

    /**
     * Set metatitle
     *
     * @param string $metatitle
     *
     * @return Actualite
     */
    public function setMetatitle($metatitle)
    {
        $this->metatitle = $metatitle;

        return $this;
    }

    /**
     * Get metatitle
     *
     * @return string
     */
    public function getMetatitle()
    {
        return $this->metatitle;
    }

    /**
     * Set metadescription
     *
     * @param string $metadescription
     *
     * @return Actualite
     */
    public function setMetadescription($metadescription)
    {
        $this->metadescription = $metadescription;

        return $this;
    }

    /**
     * Get metadescription
     *
     * @return string
     */
    public function getMetadescription()
    {
        return $this->metadescription;
    }

    /**
     * Set categorie
     *
     * @param \ActualiteBundle\Entity\Categorie $categorie
     *
     * @return Actualite
     */
    public function setCategorie(\ActualiteBundle\Entity\Categorie $categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \ActualiteBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set avant
     *
     * @param boolean $avant
     *
     * @return Actualite
     */
    public function setAvant($avant)
    {
        $this->avant = $avant;

        return $this;
    }

    /**
     * Get avant
     *
     * @return boolean
     */
    public function getAvant()
    {
        return $this->avant;
    }
}
