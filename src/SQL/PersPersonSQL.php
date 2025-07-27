<?php

namespace App\SQL;

class PersPersonSQL
{
    static public function getAllInfo(): string
    {
        return '
            SELECT id, name, last_name, create_time 
            FROM public.pers_person 
            ORDER BY create_time DESC ;
        ';
    }
}