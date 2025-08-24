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

    static public function getAccessByFilter(?string $customDate, ?string $name): string
    {
        $baseQuery = '
            SELECT id, create_time, update_time, first_in_time, last_out_time, reader_name_in, reader_name_out, pin, last_name, name
            FROM public.acc_firstin_lastout
        ';

        $whereClauses = [];
        if (!empty($customDate)) {
            $whereClauses[] = 'DATE(create_time) = :customDate';
        }
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

    static public function getPersonList(): string
    {
        return "
            SELECT DISTINCT TRIM(name) || ' ' || TRIM(last_name) AS full_name, pin
            FROM public.acc_firstin_lastout
        ";
    }

    static public function getYearlyAccessStatsByPin(): string
    {
        return "
            SELECT TO_CHAR(create_time, 'MM') AS month_num, COUNT(*) AS total
            FROM public.acc_firstin_lastout
            WHERE pin = :pin AND EXTRACT(YEAR FROM create_time) = :currentYear
            GROUP BY TO_CHAR(create_time, 'MM')
            ORDER BY TO_CHAR(create_time, 'MM')
        ";
    }

    static public function getWeeklyAccessStats(): string
    {
        return "
            SELECT create_time::date AS day_date, COUNT(*) AS total
            FROM public.acc_firstin_lastout
            WHERE create_time::date BETWEEN :monday AND :sunday
            GROUP BY create_time::date
            ORDER BY create_time::date
        ";
    }

    static  public function getMonthlyAccessStatsByYear(): string
    {
        return "
            SELECT TO_CHAR(create_time, 'MM') AS month_num, COUNT(*) AS total
            FROM public.acc_firstin_lastout
            WHERE EXTRACT(YEAR FROM create_time) = :selectedYear
            GROUP BY TO_CHAR(create_time, 'MM')
            ORDER BY TO_CHAR(create_time, 'MM')
        ";
    }

    static public function countAccessByDate(): string
    {
        return '
            SELECT COUNT(id)
            FROM public.acc_firstin_lastout
            WHERE DATE(create_time) = :customDate
        ';
    }
}