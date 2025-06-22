<?php
namespace App\Entity\ZKT;

use App\Repository\PersPersonRepository;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

//#[ORM\Entity(repositoryClass: PersPersonRepository::class)]
//#[ORM\Table(name: 'pers_person')]
class PersPerson
{
    #[ORM\Id]
    #[ORM\Column(type: Types::STRING, length: 50)]
    private string $id;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $appId = null;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $bioTblId = null;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $companyId = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTime $createTime = null;

    #[ORM\Column(type: Types::STRING, length: 100, nullable: true)]
    private ?string $createrCode = null;

    #[ORM\Column(type: Types::STRING, length: 50, nullable: true)]
    private ?string $createrId = null;

    #[ORM\Column(type: Types::STRING, length: 100, nullable: true)]
    private ?string $createrName = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $opVersion = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTime $updateTime = null;

    #[ORM\Column(type: Types::STRING, length: 100, nullable: true)]
    private ?string $updaterCode = null;

    #[ORM\Column(type: Types::STRING, length: 100, nullable: true)]
    private ?string $updaterId = null;

    #[ORM\Column(type: Types::STRING, length: 100, nullable: true)]
    private ?string $updaterName = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $birthday = null;

    #[ORM\Column(type: Types::STRING, length: 20, nullable: true)]
    private ?string $carPlate = null;

    #[ORM\Column(type: Types::STRING, length: 50)]
    private string $authDeptId;

    #[ORM\Column(type: Types::STRING, length: 250, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $exceptionFlag = null;

    #[ORM\Column(type: Types::STRING, length: 1, nullable: true)]
    private ?string $gender = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $hireDate = null;

    #[ORM\Column(type: Types::STRING, length: 250, nullable: true)]
    private ?string $idCard = null;

    #[ORM\Column(type: Types::STRING, length: 250, nullable: true)]
    private ?string $idCardPhysicalNo = null;

    #[ORM\Column(type: Types::STRING, length: 100, nullable: true)]
    private ?string $isFrom = null;

    #[ORM\Column(type: Types::BOOLEAN, nullable: true)]
    private ?bool $isSendmail = null;

    #[ORM\Column(type: Types::STRING, length: 50, nullable: true)]
    private ?string $lastName = null;

    #[ORM\Column(type: Types::STRING, length: 250, nullable: true)]
    private ?string $mobilePhone = null;

    #[ORM\Column(type: Types::STRING, length: 50, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(type: Types::STRING, length: 420, nullable: true)]
    private ?string $nameSpell = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $numberPin = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $persLoginLimit = null;

    #[ORM\Column(type: Types::STRING, length: 250, nullable: true)]
    private ?string $personPwd = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $personType = null;

    #[ORM\Column(type: Types::STRING, length: 200, nullable: true)]
    private ?string $photoPath = null;

    #[ORM\Column(type: Types::STRING, length: 30)]
    private string $pin;

    #[ORM\Column(type: Types::BOOLEAN, nullable: true)]
    private ?bool $pinLetter = null;

    #[ORM\Column(type: Types::STRING, length: 250, nullable: true)]
    private ?string $selfPwd = null;

    #[ORM\Column(type: Types::BOOLEAN, nullable: true)]
    private ?bool $sendSms = null;

    #[ORM\Column(type: Types::STRING, length: 20, nullable: true)]
    private ?string $ssn = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $status = null;

    #[ORM\Column(type: Types::STRING, length: 50, nullable: true)]
    private ?string $positionId = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getAppId(): ?string
    {
        return $this->appId;
    }

    public function setAppId(?string $appId): static
    {
        $this->appId = $appId;

        return $this;
    }

    public function getBioTblId(): ?string
    {
        return $this->bioTblId;
    }

    public function setBioTblId(?string $bioTblId): static
    {
        $this->bioTblId = $bioTblId;

        return $this;
    }

    public function getCompanyId(): ?string
    {
        return $this->companyId;
    }

    public function setCompanyId(?string $companyId): static
    {
        $this->companyId = $companyId;

        return $this;
    }

    public function getCreateTime(): ?\DateTime
    {
        return $this->createTime;
    }

    public function setCreateTime(?\DateTime $createTime): static
    {
        $this->createTime = $createTime;

        return $this;
    }

    public function getCreaterCode(): ?string
    {
        return $this->createrCode;
    }

    public function setCreaterCode(?string $createrCode): static
    {
        $this->createrCode = $createrCode;

        return $this;
    }

    public function getCreaterId(): ?string
    {
        return $this->createrId;
    }

    public function setCreaterId(?string $createrId): static
    {
        $this->createrId = $createrId;

        return $this;
    }

    public function getCreaterName(): ?string
    {
        return $this->createrName;
    }

    public function setCreaterName(?string $createrName): static
    {
        $this->createrName = $createrName;

        return $this;
    }

    public function getOpVersion(): ?int
    {
        return $this->opVersion;
    }

    public function setOpVersion(?int $opVersion): static
    {
        $this->opVersion = $opVersion;

        return $this;
    }

    public function getUpdateTime(): ?\DateTime
    {
        return $this->updateTime;
    }

    public function setUpdateTime(?\DateTime $updateTime): static
    {
        $this->updateTime = $updateTime;

        return $this;
    }

    public function getUpdaterCode(): ?string
    {
        return $this->updaterCode;
    }

    public function setUpdaterCode(?string $updaterCode): static
    {
        $this->updaterCode = $updaterCode;

        return $this;
    }

    public function getUpdaterId(): ?string
    {
        return $this->updaterId;
    }

    public function setUpdaterId(?string $updaterId): static
    {
        $this->updaterId = $updaterId;

        return $this;
    }

    public function getUpdaterName(): ?string
    {
        return $this->updaterName;
    }

    public function setUpdaterName(?string $updaterName): static
    {
        $this->updaterName = $updaterName;

        return $this;
    }

    public function getBirthday(): ?\DateTime
    {
        return $this->birthday;
    }

    public function setBirthday(?\DateTime $birthday): static
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getCarPlate(): ?string
    {
        return $this->carPlate;
    }

    public function setCarPlate(?string $carPlate): static
    {
        $this->carPlate = $carPlate;

        return $this;
    }

    public function getAuthDeptId(): ?string
    {
        return $this->authDeptId;
    }

    public function setAuthDeptId(string $authDeptId): static
    {
        $this->authDeptId = $authDeptId;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getExceptionFlag(): ?int
    {
        return $this->exceptionFlag;
    }

    public function setExceptionFlag(?int $exceptionFlag): static
    {
        $this->exceptionFlag = $exceptionFlag;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getHireDate(): ?\DateTime
    {
        return $this->hireDate;
    }

    public function setHireDate(?\DateTime $hireDate): static
    {
        $this->hireDate = $hireDate;

        return $this;
    }

    public function getIdCard(): ?string
    {
        return $this->idCard;
    }

    public function setIdCard(?string $idCard): static
    {
        $this->idCard = $idCard;

        return $this;
    }

    public function getIdCardPhysicalNo(): ?string
    {
        return $this->idCardPhysicalNo;
    }

    public function setIdCardPhysicalNo(?string $idCardPhysicalNo): static
    {
        $this->idCardPhysicalNo = $idCardPhysicalNo;

        return $this;
    }

    public function getIsFrom(): ?string
    {
        return $this->isFrom;
    }

    public function setIsFrom(?string $isFrom): static
    {
        $this->isFrom = $isFrom;

        return $this;
    }

    public function isSendmail(): ?bool
    {
        return $this->isSendmail;
    }

    public function setIsSendmail(?bool $isSendmail): static
    {
        $this->isSendmail = $isSendmail;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getMobilePhone(): ?string
    {
        return $this->mobilePhone;
    }

    public function setMobilePhone(?string $mobilePhone): static
    {
        $this->mobilePhone = $mobilePhone;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getNameSpell(): ?string
    {
        return $this->nameSpell;
    }

    public function setNameSpell(?string $nameSpell): static
    {
        $this->nameSpell = $nameSpell;

        return $this;
    }

    public function getNumberPin(): ?string
    {
        return $this->numberPin;
    }

    public function setNumberPin(?string $numberPin): static
    {
        $this->numberPin = $numberPin;

        return $this;
    }

    public function getPersLoginLimit(): ?int
    {
        return $this->persLoginLimit;
    }

    public function setPersLoginLimit(?int $persLoginLimit): static
    {
        $this->persLoginLimit = $persLoginLimit;

        return $this;
    }

    public function getPersonPwd(): ?string
    {
        return $this->personPwd;
    }

    public function setPersonPwd(?string $personPwd): static
    {
        $this->personPwd = $personPwd;

        return $this;
    }

    public function getPersonType(): ?int
    {
        return $this->personType;
    }

    public function setPersonType(?int $personType): static
    {
        $this->personType = $personType;

        return $this;
    }

    public function getPhotoPath(): ?string
    {
        return $this->photoPath;
    }

    public function setPhotoPath(?string $photoPath): static
    {
        $this->photoPath = $photoPath;

        return $this;
    }

    public function getPin(): ?string
    {
        return $this->pin;
    }

    public function setPin(string $pin): static
    {
        $this->pin = $pin;

        return $this;
    }

    public function isPinLetter(): ?bool
    {
        return $this->pinLetter;
    }

    public function setPinLetter(?bool $pinLetter): static
    {
        $this->pinLetter = $pinLetter;

        return $this;
    }

    public function getSelfPwd(): ?string
    {
        return $this->selfPwd;
    }

    public function setSelfPwd(?string $selfPwd): static
    {
        $this->selfPwd = $selfPwd;

        return $this;
    }

    public function isSendSms(): ?bool
    {
        return $this->sendSms;
    }

    public function setSendSms(?bool $sendSms): static
    {
        $this->sendSms = $sendSms;

        return $this;
    }

    public function getSsn(): ?string
    {
        return $this->ssn;
    }

    public function setSsn(?string $ssn): static
    {
        $this->ssn = $ssn;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getPositionId(): ?string
    {
        return $this->positionId;
    }

    public function setPositionId(?string $positionId): static
    {
        $this->positionId = $positionId;

        return $this;
    }

}