<?php
/*********************************************************************************
 * Developed by Maxx Ng'ang'a
 * (C) 2017 Crysoft Dynamics Ltd
 * Karbon V 2.1
 * User: Maxx
 * Date: 5/11/2017
 * Time: 5:21 PM
 ********************************************************************************/

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RecordingRepository")
 * @ORM\Table(name="recording")
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
 */
class Recording
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $isrc;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $skizaId;
    /**
     * @ORM\Column(type="string")
     */
    private $recordingTitle;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mainArtist;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $mainArtistCountry;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $featuredArtist;
    /**
     * @ORM\Column(type="string")
     */
    private $genre;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $language;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $countryOfRecording;
    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $countryFirstPublished;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $typeOfRecording;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $avWork;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $duration;
    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $dateOfPublication;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $recordingStudio1;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $recordingStudio2;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $comment;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $albumTitle;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $albumType;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $recordLabel;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $countryOfPublication;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $barCode;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $catalogueNr;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $dateOfFirstRelease;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $trackTitle;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $trackNr;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $sideNr;
    /**
     * @ORM\Column(type="string")
     */
    private $status;
    /**
     * @Vich\UploadableField(mapping="recording_mp3",fileNameProperty="recordingName",size="recordingFileSize")
     *
     * @var File $recordingFile
     */
    private $recordingFile;
    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $recordingName;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $recordingFileSize;
    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;
    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $createdBy;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $updatedBy;

    public function __construct()
    {
        // we set up "created"+"modified"
        $this->setCreatedAt(new \DateTime());
        if ($this->getUpdatedAt() == null) {
            $this->setUpdatedAt(new \DateTime());
        }

    }
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function updateModifiedDatetime()
    {
        // update the modified time
        $this->setUpdatedAt(new \DateTime());
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getIsrc()
    {
        return $this->isrc;
    }

    /**
     * @param mixed $isrc
     */
    public function setIsrc($isrc)
    {
        $this->isrc = $isrc;
    }

    /**
     * @return mixed
     */
    public function getSkizaId()
    {
        return $this->skizaId;
    }

    /**
     * @param mixed $skizaId
     */
    public function setSkizaId($skizaId)
    {
        $this->skizaId = $skizaId;
    }

    /**
     * @return mixed
     */
    public function getRecordingTitle()
    {
        return $this->recordingTitle;
    }

    /**
     * @param mixed $recordingTitle
     */
    public function setRecordingTitle($recordingTitle)
    {
        $this->recordingTitle = $recordingTitle;
    }

    /**
     * @return mixed
     */
    public function getMainArtist()
    {
        return $this->mainArtist;
    }

    /**
     * @param mixed $mainArtist
     */
    public function setMainArtist($mainArtist)
    {
        $this->mainArtist = $mainArtist;
    }

    /**
     * @return mixed
     */
    public function getMainArtistCountry()
    {
        return $this->mainArtistCountry;
    }

    /**
     * @param mixed $mainArtistCountry
     */
    public function setMainArtistCountry($mainArtistCountry)
    {
        $this->mainArtistCountry = $mainArtistCountry;
    }

    /**
     * @return mixed
     */
    public function getFeaturedArtist()
    {
        return $this->featuredArtist;
    }

    /**
     * @param mixed $featuredArtist
     */
    public function setFeaturedArtist($featuredArtist)
    {
        $this->featuredArtist = $featuredArtist;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return mixed
     */
    public function getCountryOfRecording()
    {
        return $this->countryOfRecording;
    }

    /**
     * @param mixed $countryOfRecording
     */
    public function setCountryOfRecording($countryOfRecording)
    {
        $this->countryOfRecording = $countryOfRecording;
    }

    /**
     * @return mixed
     */
    public function getCountryFirstPublished()
    {
        return $this->countryFirstPublished;
    }

    /**
     * @param mixed $countryFirstPublished
     */
    public function setCountryFirstPublished($countryFirstPublished)
    {
        $this->countryFirstPublished = $countryFirstPublished;
    }

    /**
     * @return mixed
     */
    public function getTypeOfRecording()
    {
        return $this->typeOfRecording;
    }

    /**
     * @param mixed $typeOfRecording
     */
    public function setTypeOfRecording($typeOfRecording)
    {
        $this->typeOfRecording = $typeOfRecording;
    }

    /**
     * @return mixed
     */
    public function getAvWork()
    {
        return $this->avWork;
    }

    /**
     * @param mixed $avWork
     */
    public function setAvWork($avWork)
    {
        $this->avWork = $avWork;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return mixed
     */
    public function getDateOfPublication()
    {
        return $this->dateOfPublication;
    }

    /**
     * @param mixed $dateOfPublication
     */
    public function setDateOfPublication($dateOfPublication)
    {
        $this->dateOfPublication = $dateOfPublication;
    }

    /**
     * @return mixed
     */
    public function getRecordingStudio1()
    {
        return $this->recordingStudio1;
    }

    /**
     * @param mixed $recodingStudio1
     */
    public function setRecordingStudio1($recordingStudio1)
    {
        $this->recordingStudio1 = $recordingStudio1;
    }

    /**
     * @return mixed
     */
    public function getRecordingStudio2()
    {
        return $this->recordingStudio2;
    }

    /**
     * @param mixed $recordingStudio2
     */
    public function setRecordingStudio2($recordingStudio2)
    {
        $this->recordingStudio2 = $recordingStudio2;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getAlbumTitle()
    {
        return $this->albumTitle;
    }

    /**
     * @param mixed $albumTitle
     */
    public function setAlbumTitle($albumTitle)
    {
        $this->albumTitle = $albumTitle;
    }

    /**
     * @return mixed
     */
    public function getAlbumType()
    {
        return $this->albumType;
    }

    /**
     * @param mixed $albumType
     */
    public function setAlbumType($albumType)
    {
        $this->albumType = $albumType;
    }

    /**
     * @return mixed
     */
    public function getRecordLabel()
    {
        return $this->recordLabel;
    }

    /**
     * @param mixed $recordLabel
     */
    public function setRecordLabel($recordLabel)
    {
        $this->recordLabel = $recordLabel;
    }

    /**
     * @return mixed
     */
    public function getCountryOfPublication()
    {
        return $this->countryOfPublication;
    }

    /**
     * @param mixed $countryOfPublication
     */
    public function setCountryOfPublication($countryOfPublication)
    {
        $this->countryOfPublication = $countryOfPublication;
    }

    /**
     * @return mixed
     */
    public function getBarCode()
    {
        return $this->barCode;
    }

    /**
     * @param mixed $barCode
     */
    public function setBarCode($barCode)
    {
        $this->barCode = $barCode;
    }

    /**
     * @return mixed
     */
    public function getCatalogueNr()
    {
        return $this->catalogueNr;
    }

    /**
     * @param mixed $catalogueNr
     */
    public function setCatalogueNr($catalogueNr)
    {
        $this->catalogueNr = $catalogueNr;
    }

    /**
     * @return mixed
     */
    public function getDateOfFirstRelease()
    {
        return $this->dateOfFirstRelease;
    }

    /**
     * @param mixed $dateOfFirstRelease
     */
    public function setDateOfFirstRelease($dateOfFirstRelease)
    {
        $this->dateOfFirstRelease = $dateOfFirstRelease;
    }

    /**
     * @return mixed
     */
    public function getTrackTitle()
    {
        return $this->trackTitle;
    }

    /**
     * @param mixed $trackTitle
     */
    public function setTrackTitle($trackTitle)
    {
        $this->trackTitle = $trackTitle;
    }

    /**
     * @return mixed
     */
    public function getTrackNr()
    {
        return $this->trackNr;
    }

    /**
     * @param mixed $trackNr
     */
    public function setTrackNr($trackNr)
    {
        $this->trackNr = $trackNr;
    }

    /**
     * @return mixed
     */
    public function getSideNr()
    {
        return $this->sideNr;
    }

    /**
     * @param mixed $sideNr
     */
    public function setSideNr($sideNr)
    {
        $this->sideNr = $sideNr;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param mixed $createdBy
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return mixed
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * @param mixed $updatedBy
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return File|null
     */
    public function getRecordingFile()
    {
        return $this->recordingFile;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $recordingFile
     * @return Recording
     */
    public function setRecordingFile(File $recordingFile=null)
    {
        $this->recordingFile = $recordingFile;

        if ($recordingFile){
            //Change at least one field to force the event listeners to fire
            $this->updatedAt= new \DateTimeImmutable();
        }
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRecordingName()
    {
        return $this->recordingName;
    }

    /**
     * @param string $recordingName
     * @return Recording
     */
    public function setRecordingName($recordingName)
    {
        $this->recordingName = $recordingName;
        return $this;
    }

    /**
     * @return integer|null
     */
    public function getRecordingFileSize()
    {
        return $this->recordingFileSize;
    }

    /**
     * @param integer $recordingFileSize
     *
     * @return Recording
     */
    public function setRecordingFileSize($recordingFileSize)
    {
        $this->recordingFileSize = $recordingFileSize;

        return $this;
    }

    /**
     * @Assert\Callback
     * @param ExecutionContextInterface $context
     * @param $payload
     */
    public function validate(ExecutionContextInterface $context,$payload){
        if (!$this->recordingFile){
            return;
        }
        if (!in_array($this->recordingFile->getMimeType(),array(
            'audio/mpeg',
            'audio/mp3'
        ))){
            $context
                ->buildViolation("Invalid File type (only mp3 files allowed)")
                ->atPath('recordingName')
                ->addViolation();
        }
    }



}