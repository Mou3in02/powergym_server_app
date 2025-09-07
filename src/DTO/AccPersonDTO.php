<?php

namespace App\DTO;

readonly class AccPersonDTO
{
    public function __construct(
        public string  $id,
        public string  $createTime,
        public string  $createrCode,
        public string  $createrId,
        public string  $createrName,
        public int     $opVersion,
        public string  $updateTime,
        public string  $updaterCode,
        public string  $updaterId,
        public string  $updaterName,
        public bool    $delayPassage,
        public bool    $disabled,
        public bool    $isSetValidTime,
        public string  $persPersonId,
        public int     $privilege,
        public int     $superAuth,
        public ?string $endTime,
        public ?string $startTime,
        public ?string $appId = null,
        public ?string $bioTblId = null,
        public ?string $companyId = null,
    )
    {
    }

    /**
     * Create DTO from array data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            appId: $data['app_id'],
            bioTblId: $data['bio_tbl_id'],
            companyId: $data['company_id'],
            createTime: $data['create_time'],
            createrCode: $data['creater_code'],
            createrId: $data['creater_id'],
            createrName: $data['creater_name'],
            opVersion: (int)$data['op_version'],
            updateTime: $data['update_time'],
            updaterCode: $data['updater_code'],
            updaterId: $data['updater_id'],
            updaterName: $data['updater_name'],
            delayPassage: self::convertToBoolean($data['delay_passage']),
            disabled: self::convertToBoolean($data['disabled']),
            endTime: $data['end_time'],
            isSetValidTime: self::convertToBoolean($data['is_set_valid_time']),
            persPersonId: $data['pers_person_id'],
            privilege: (int)$data['privilege'],
            startTime: $data['start_time'],
            superAuth: (int)$data['super_auth']
        );
    }

    /**
     * Convert various input types to proper boolean values
     */
    private static function convertToBoolean($value): bool
    {
        // Handle empty strings, null, and other falsy values
        if ($value === '' || $value === null || $value === 'false' || $value === '0') {
            return false;
        }

        // Handle truthy string values
        if ($value === 'true' || $value === '1' || $value === 1) {
            return true;
        }

        // Default boolean conversion for other types
        return (bool)$value;
    }

}