<?php
/*********************************************************************************
 * Karbon Framework is a PHP5 Framework developed by Maxx Ng'ang'a
 * (C) 2016 Crysoft Dynamics Ltd
 * Karbon V 1.0
 * Maxx
 * 5/1/2017
 ********************************************************************************/

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProfileRepository")
 * @ORM\Table(name="profile")
 * @UniqueEntity(fields={"emailAddress"},message="You have already successfully updated your profile.")
 */
class Profile
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="string")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $firstName;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $middleName;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $lastName;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $ipn;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $memberNumber;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $prefix;
    /**
     * @ORM\Column(type="date",nullable=true)
     * @Assert\NotBlank()
     */
    private $dateOfBirth;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $stageName;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $nationality;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $language;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $maritalStatus;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $spouseName;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $idNumber;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $itaxPin;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $countryOfResidence;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $memberType;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $gender;
    /**
     * @ORM\Column(type="simple_array",nullable=true)
     */
    private $rights;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $registrationNumber;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $sourceOfData;
    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $registrationDate;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $status;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $physicalAddress;
    /**
     * @ORM\Column(type="string")
     */
    private $postalAddress;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $postalCode;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $city;
    /**
     * @ORM\Column(type="string")
     */
    private $country;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $phoneNumber;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $altPhoneNumber;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $faxNumber;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $emailAddress;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $website;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $nameOfPayee;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $paymentMpesaNumber;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $accountName;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $bank;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $bankBranch;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $accountNumber;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $currency;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $bankAccountType;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $bankPostalAddress;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $iban;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $swiftBic;

    /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $isPaid;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $mpesaConfirmationCode;
    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $mpesaPaymentDate;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $mpesaStatus;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $mpesaDescription;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $mpesaNumber;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $mpesaAmount;
    /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $isUrlvalid;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $profileStatus;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $statusDescription;
    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $createdAt;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $processedBy;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $processedAt;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $accountCreated;
    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User",mappedBy="myProfile")
     */
    private $whoseProfile;
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
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * @param mixed $middleName
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getIpn()
    {
        return $this->ipn;
    }

    /**
     * @param mixed $ipn
     */
    public function setIpn($ipn)
    {
        $this->ipn = $ipn;
    }

    /**
     * @return mixed
     */
    public function getMemberNumber()
    {
        return $this->memberNumber;
    }

    /**
     * @param mixed $memberNumber
     */
    public function setMemberNumber($memberNumber)
    {
        $this->memberNumber = $memberNumber;
    }

    /**
     * @return mixed
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param mixed $prefix
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * @return mixed
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @param mixed $dateOfBirth
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @return mixed
     */
    public function getStageName()
    {
        return $this->stageName;
    }

    /**
     * @param mixed $stageName
     */
    public function setStageName($stageName)
    {
        $this->stageName = $stageName;
    }

    /**
     * @return mixed
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * @param mixed $nationality
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;
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
    public function getMaritalStatus()
    {
        return $this->maritalStatus;
    }

    /**
     * @param mixed $maritalStatus
     */
    public function setMaritalStatus($maritalStatus)
    {
        $this->maritalStatus = $maritalStatus;
    }

    /**
     * @return mixed
     */
    public function getSpouseName()
    {
        return $this->spouseName;
    }

    /**
     * @param mixed $spouseName
     */
    public function setSpouseName($spouseName)
    {
        $this->spouseName = $spouseName;
    }

    /**
     * @return mixed
     */
    public function getIdNumber()
    {
        return $this->idNumber;
    }

    /**
     * @param mixed $idNumber
     */
    public function setIdNumber($idNumber)
    {
        $this->idNumber = $idNumber;
    }

    /**
     * @return mixed
     */
    public function getItaxPin()
    {
        return $this->itaxPin;
    }

    /**
     * @param mixed $itaxPin
     */
    public function setItaxPin($itaxPin)
    {
        $this->itaxPin = $itaxPin;
    }

    /**
     * @return mixed
     */
    public function getCountryOfResidence()
    {
        return $this->countryOfResidence;
    }

    /**
     * @param mixed $countryOfResidence
     */
    public function setCountryOfResidence($countryOfResidence)
    {
        $this->countryOfResidence = $countryOfResidence;
    }

    /**
     * @return mixed
     */
    public function getMemberType()
    {
        return $this->memberType;
    }

    /**
     * @param mixed $memberType
     */
    public function setMemberType($memberType)
    {
        $this->memberType = $memberType;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getRights()
    {
        return $this->rights;
    }

    /**
     * @param mixed $rights
     */
    public function setRights($rights)
    {
        $this->rights = $rights;
    }

    /**
     * @return mixed
     */
    public function getRegistrationNumber()
    {
        return $this->registrationNumber;
    }

    /**
     * @param mixed $registrationNumber
     */
    public function setRegistrationNumber($registrationNumber)
    {
        $this->registrationNumber = $registrationNumber;
    }

    /**
     * @return mixed
     */
    public function getSourceOfData()
    {
        return $this->sourceOfData;
    }

    /**
     * @param mixed $sourceOfData
     */
    public function setSourceOfData($sourceOfData)
    {
        $this->sourceOfData = $sourceOfData;
    }

    /**
     * @return mixed
     */
    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }

    /**
     * @param mixed $registrationDate
     */
    public function setRegistrationDate($registrationDate)
    {
        $this->registrationDate = $registrationDate;
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
     * @return mixed
     */
    public function getPhysicalAddress()
    {
        return $this->physicalAddress;
    }

    /**
     * @param mixed $physicalAddress
     */
    public function setPhysicalAddress($physicalAddress)
    {
        $this->physicalAddress = $physicalAddress;
    }

    /**
     * @return mixed
     */
    public function getPostalAddress()
    {
        return $this->postalAddress;
    }

    /**
     * @param mixed $postalAddress
     */
    public function setPostalAddress($postalAddress)
    {
        $this->postalAddress = $postalAddress;
    }

    /**
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param mixed $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param mixed $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getAltPhoneNumber()
    {
        return $this->altPhoneNumber;
    }

    /**
     * @param mixed $altPhoneNumber
     */
    public function setAltPhoneNumber($altPhoneNumber)
    {
        $this->altPhoneNumber = $altPhoneNumber;
    }

    /**
     * @return mixed
     */
    public function getFaxNumber()
    {
        return $this->faxNumber;
    }

    /**
     * @param mixed $faxNumber
     */
    public function setFaxNumber($faxNumber)
    {
        $this->faxNumber = $faxNumber;
    }

    /**
     * @return mixed
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @param mixed $emailAddress
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    /**
     * @return mixed
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param mixed $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * @return mixed
     */
    public function getNameOfPayee()
    {
        return $this->nameOfPayee;
    }

    /**
     * @param mixed $nameOfPayee
     */
    public function setNameOfPayee($nameOfPayee)
    {
        $this->nameOfPayee = $nameOfPayee;
    }

    /**
     * @return mixed
     */
    public function getAccountName()
    {
        return $this->accountName;
    }

    /**
     * @param mixed $accountName
     */
    public function setAccountName($accountName)
    {
        $this->accountName = $accountName;
    }

    /**
     * @return mixed
     */
    public function getBank()
    {
        return $this->bank;
    }

    /**
     * @param mixed $bank
     */
    public function setBank($bank)
    {
        $this->bank = $bank;
    }

    /**
     * @return mixed
     */
    public function getBankBranch()
    {
        return $this->bankBranch;
    }

    /**
     * @param mixed $bankBranch
     */
    public function setBankBranch($bankBranch)
    {
        $this->bankBranch = $bankBranch;
    }

    /**
     * @return mixed
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * @param mixed $accountNumber
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return mixed
     */
    public function getBankAccountType()
    {
        return $this->bankAccountType;
    }

    /**
     * @param mixed $bankAccountType
     */
    public function setBankAccountType($bankAccountType)
    {
        $this->bankAccountType = $bankAccountType;
    }

    /**
     * @return mixed
     */
    public function getBankPostalAddress()
    {
        return $this->bankPostalAddress;
    }

    /**
     * @param mixed $bankPostalAddress
     */
    public function setBankPostalAddress($bankPostalAddress)
    {
        $this->bankPostalAddress = $bankPostalAddress;
    }

    /**
     * @return mixed
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * @param mixed $iban
     */
    public function setIban($iban)
    {
        $this->iban = $iban;
    }

    /**
     * @return mixed
     */
    public function getSwiftBic()
    {
        return $this->swiftBic;
    }

    /**
     * @param mixed $swiftBic
     */
    public function setSwiftBic($swiftBic)
    {
        $this->swiftBic = $swiftBic;
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
    public function getIsPaid()
    {
        return $this->isPaid;
    }

    /**
     * @param mixed $isPaid
     */
    public function setIsPaid($isPaid)
    {
        $this->isPaid = $isPaid;
    }

    /**
     * @return mixed
     */
    public function getMpesaConfirmationCode()
    {
        return $this->mpesaConfirmationCode;
    }

    /**
     * @param mixed $mpesaConfirmationCode
     */
    public function setMpesaConfirmationCode($mpesaConfirmationCode)
    {
        $this->mpesaConfirmationCode = $mpesaConfirmationCode;
    }

    /**
     * @return mixed
     */
    public function getMpesaPaymentDate()
    {
        return $this->mpesaPaymentDate;
    }

    /**
     * @param mixed $mpesaPaymentDate
     */
    public function setMpesaPaymentDate($mpesaPaymentDate)
    {
        $this->mpesaPaymentDate = $mpesaPaymentDate;
    }

    /**
     * @return mixed
     */
    public function getMpesaStatus()
    {
        return $this->mpesaStatus;
    }

    /**
     * @param mixed $mpesaStatus
     */
    public function setMpesaStatus($mpesaStatus)
    {
        $this->mpesaStatus = $mpesaStatus;
    }

    /**
     * @return mixed
     */
    public function getMpesaDescription()
    {
        return $this->mpesaDescription;
    }

    /**
     * @param mixed $mpesaDescription
     */
    public function setMpesaDescription($mpesaDescription)
    {
        $this->mpesaDescription = $mpesaDescription;
    }

    /**
     * @return mixed
     */
    public function getMpesaNumber()
    {
        return $this->mpesaNumber;
    }

    /**
     * @param mixed $mpesaNumber
     */
    public function setMpesaNumber($mpesaNumber)
    {
        $this->mpesaNumber = $mpesaNumber;
    }

    /**
     * @return mixed
     */
    public function getMpesaAmount()
    {
        return $this->mpesaAmount;
    }

    /**
     * @param mixed $mpesaAmount
     */
    public function setMpesaAmount($mpesaAmount)
    {
        $this->mpesaAmount = $mpesaAmount;
    }

    /**
     * @return mixed
     */
    public function getIsUrlvalid()
    {
        return $this->isUrlvalid;
    }

    /**
     * @param mixed $isUrlvalid
     */
    public function setIsUrlvalid($isUrlvalid)
    {
        $this->isUrlvalid = $isUrlvalid;
    }

    /**
     * @return mixed
     */
    public function getProfileStatus()
    {
        return $this->profileStatus;
    }

    /**
     * @param mixed $profileStatus
     */
    public function setProfileStatus($profileStatus)
    {
        $this->profileStatus = $profileStatus;
    }

    /**
     * @return mixed
     */
    public function getStatusDescription()
    {
        return $this->statusDescription;
    }

    /**
     * @param mixed $statusDescription
     */
    public function setStatusDescription($statusDescription)
    {
        $this->statusDescription = $statusDescription;
    }

    public function __toString()
    {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }

    public function getFullName(){
        return trim($this->getFirstName() . ' ' . $this->getLastName());
    }

    /**
     * @return mixed
     */
    public function getProcessedBy()
    {
        return $this->processedBy;
    }

    /**
     * @param mixed $processedBy
     */
    public function setProcessedBy($processedBy)
    {
        $this->processedBy = $processedBy;
    }

    /**
     * @return mixed
     */
    public function getProcessedAt()
    {
        return $this->processedAt;
    }

    /**
     * @param mixed $processedAt
     */
    public function setProcessedAt($processedAt)
    {
        $this->processedAt = $processedAt;
    }

    /**
     * @return mixed
     */
    public function getAccountCreated()
    {
        return $this->accountCreated;
    }

    /**
     * @param mixed $accountCreated
     */
    public function setAccountCreated($accountCreated)
    {
        $this->accountCreated = $accountCreated;
    }

    /**
     * @return mixed
     */
    public function getWhoseProfile()
    {
        return $this->whoseProfile;
    }

    /**
     * @param mixed $whoseProfile
     */
    public function setWhoseProfile($whoseProfile)
    {
        $this->whoseProfile = $whoseProfile;
    }

    /**
     * @return mixed
     */
    public function getPaymentMpesaNumber()
    {
        return $this->paymentMpesaNumber;
    }

    /**
     * @param mixed $paymentMpesaNumber
     */
    public function setPaymentMpesaNumber($paymentMpesaNumber)
    {
        $this->paymentMpesaNumber = $paymentMpesaNumber;
    }

}