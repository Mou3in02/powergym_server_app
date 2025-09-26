<?php

namespace App\utils;

class UsedTables
{
    const TABLE_ACC_PERSON = 'acc_person';
    const TABLE_ACCESS_FIRST_IN_LAST_OUT = 'acc_firstin_lastout';
    const TABLE_PERS_PERSON = 'pers_person';

    static function all()
    {
        return [
            self::TABLE_ACC_PERSON,
            self::TABLE_ACCESS_FIRST_IN_LAST_OUT,
            self::TABLE_PERS_PERSON,
        ];
    }
}