<?php

namespace App\SQL;

/**
 * @Info table "acc_firstin_lastout"
 */
class PersAccessFirstInLastOut
{
    const READER_NAME_IN_ENTREE_KEY = 'Entree-1-Hors';
    const READER_NAME_IN_SORTIE_KEY = 'Sortie-1-Hors';
    const READER_NAME_IN_ENTREE_VALUE = 'Entrée';
    const READER_NAME_IN_SORTIE_VALUE = 'Sortie';
    const READER_NAME_IN_lIST = [
        self::READER_NAME_IN_ENTREE_KEY => self::READER_NAME_IN_ENTREE_VALUE,
        self::READER_NAME_IN_SORTIE_KEY => self::READER_NAME_IN_SORTIE_VALUE,
    ];

    /**
     * @warning Do not use it in production
     */
    static public function getAllAccess(): string
    {
        return '
            SELECT id, create_time, update_time, first_in_time, last_out_time, reader_name_in, reader_name_out, pin, last_name, name
            FROM public.acc_firstin_lastout 
            ORDER BY create_time DESC
        ';
    }

    static public function getAccessByDate(): string
    {
        return '
            SELECT id, create_time, update_time, first_in_time, last_out_time, reader_name_in, reader_name_out, pin, last_name, name
            FROM public.acc_firstin_lastout
            WHERE DATE(create_time) = :customDate
            ORDER BY create_time DESC
        ';
    }

    static public function getAccessByFilter(?string $customDate, ?string $event, ?string $name): string
    {
        $baseQuery = '
            SELECT id, create_time, update_time, first_in_time, last_out_time, reader_name_in, reader_name_out, pin, last_name, name
            FROM public.acc_firstin_lastout
        ';

        $whereClauses = [];
        if (!empty($customDate)) {
            $whereClauses[] = 'DATE(create_time) = :customDate';
        }
//        if (!empty($event) && key_exists($event, self::READER_NAME_IN_lIST)) {
//            $whereClauses[] = 'reader_name_in = :event';
//        }
        if (!empty($name)) {
            $whereClauses[] = '(
                COALESCE(name, \'\') LIKE :name OR 
                COALESCE(last_name, \'\') LIKE :name OR 
                CONCAT(COALESCE(name, \'\'), \' \', COALESCE(last_name, \'\')) LIKE :name OR
                CONCAT(COALESCE(last_name, \'\'), \' \', COALESCE(name, \'\')) LIKE :name
            )';
        }

        if (!empty($whereClauses)) {
            $baseQuery .= ' WHERE ' . implode(' AND ', $whereClauses);
        }

        $baseQuery .= ' ORDER BY create_time DESC;';

        return $baseQuery;
    }
}