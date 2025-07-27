<?php

namespace App\SQL;

class PersAccessSQL
{
    /**
     * @info Do not use it in production
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
            SELECT id, create_time, update_time, event_time, name, last_name, dev_alias 
            FROM public.acc_transaction 
            WHERE DATE(create_time) = :customDate
            ORDER BY create_time DESC;'
        ;
    }

}

