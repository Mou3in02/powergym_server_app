<?php

namespace App\SQL;

class PersAccessSQL
{
    const DEV_ALIAS_SORTIE = 'Sortie';
    const DEV_ALIAS_ENTREE = 'Entree';

    /**
     * @warning Do not use it in production
     */
    static public function getAllAccess(): string
    {
        return '
            SELECT id, create_time, update_time, event_time, name, last_name, dev_alias 
            FROM public.acc_transaction 
            ORDER BY create_time DESC ;
        ';
    }

    static public function getAccessByDate(): string
    {
        return '
            SELECT create_time, update_time, event_time, name, last_name, dev_alias 
            FROM public.acc_transaction 
            WHERE DATE(create_time) = :customDate
            ORDER BY create_time DESC;';
    }

    static public function getAccessByFilter(?string $eventTime, ?string $name): string
    {
        $baseQuery = '
            SELECT create_time, name, last_name, dev_alias 
            FROM public.acc_transaction
            ';

        $whereClauses = [];
        $whereClauses[] = 'DATE(create_time) = :customDate';
        if (!empty($eventTime) && in_array($eventTime, [self::DEV_ALIAS_ENTREE, self::DEV_ALIAS_SORTIE], true)) {
            $whereClauses[] = 'dev_alias = :eventTime';
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
}

