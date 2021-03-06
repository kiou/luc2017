<?php

namespace ProjetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;

/**
 * Projet
 *
 * @ORM\Table(name="projet")
 * @ORM\Entity(repositoryClass="ProjetBundle\Repository\ProjetRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Projet
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
     * @ORM\Column(name="lien", type="string", length=255)
     * @Assert\NotBlank(message="Compléter le champ lien")
     * @Assert\Url(message="Le lien doit être au format URL")
     */
    private $lien;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     * @Assert\NotBlank(message="Compléter le champ contenu")
     */
    private $contenu;

    /**
     * @var bool
     *
     * @ORM\Column(name="isActive", type="boolean")
     */
    private $isActive;

    /**
     * @var int
     *
     * @ORM\Column(name="poid", type="integer")
     */
    private $poid;

    /**
     * @var bool
     *
     * @ORM\Column(name="avant", type="boolean")
     */
    private $avant;

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
     * @Assert\Image(
        minWidth = 300,
        minHeight = 300,
        mimeTypes = {"image/jpeg", "image/png"}),
        maxSize = "3M"
     */
    private $fileimageavant;

    /**
     * @var string
     *
     * @ORM\Column(name="imageavant", type="string", length=32, nullable=true)
     */
    private $imageavant;

    /**
     * @ORM\ManyToOne(targetEntity="ProjetBundle\Entity\Categorie")
     * @Assert\NotBlank(message="Compléter le champ catégorie")
     */
    private $categorie;

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
     * @return Projet
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
     * @return Projet
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
     * @return Projet
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
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Projet
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
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Projet
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
     * Set poid
     *
     * @param integer $poid
     *
     * @return Projet
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
     * Set avant
     *
     * @param boolean $avant
     *
     * @return Projet
     */
    public function setAvant($avant)
    {
        $this->avant = $avant;

        return $this;
    }

    /**
     * Get avant
     *
     * @return bool
     */
    public function getAvant()
    {
        return $this->avant;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Projet
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

        /* Miniature liste */
        $size = new Box(530,270);
        $imagine->open($this->fileimage)
            ->thumbnail($size, 'outbound')
            ->save($this->getUploadRootDir().'liste/'.$this->image, array('jpeg_quality' => 100));

    }

    /**
     * On retourne le chemin relatif vers le slider pour notre code PHP
     */
    public function getUploadRootDir()
    {
        return __DIR__.'/../../../web/img/projet/';
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
     * Set categorie
     *
     * @param \ProjetBundle\Entity\Categorie $categorie
     *
     * @return Projet
     */
    public function setCategorie(\ProjetBundle\Entity\Categorie $categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \ProjetBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set lien
     *
     * @param string $lien
     *
     * @return Projet
     */
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * Set imageavant
     *
     * @param string $imageavant
     *
     * @return Projet
     */
    public function setImageavant($imageavant)
    {
        $this->imageavant = $imageavant;

        return $this;
    }

    /**
     * Get imageavant
     *
     * @return string
     */
    public function getImageavant()
    {
        return $this->imageavant;
    }

    public function getFileimageavant()
    {
        return $this->fileimageavant;
    }

    public function setFileimageavant(UploadedFile $fileimageavant = null)
    {
        $this->fileimageavant = $fileimageavant;
        if (null !== $this->imageavant){
            $this->imageavant = null;
        }
    }

    public function uploadImageavant()
    {
        // Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
        if (null === $this->fileimageavant) {
            return;
        }

        $this->imageavant = uniqid().'.'.strtolower(pathinfo($this->fileimageavant->getClientOriginalName(), PATHINFO_EXTENSION));

        $imagine = new Imagine();

        /* Miniature accueil */
        $size = new Box(475,475);
        $imagine->open($this->fileimageavant)
                ->thumbnail($size, 'outbound')
                ->save($this->getUploadRootDir().'avant/'.$this->imageavant, array('jpeg_quality' => 100));


    }
}
