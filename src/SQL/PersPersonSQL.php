<?php

namespace App\SQL;

class PersPersonSQL
{
    static public function getAllInfo(): string
    {
        return '
            SELECT pp.id, pp.name, pp.last_name, pp.create_time, ac.update_time, ac.start_time, ac.end_time
            FROM public.pers_person AS pp
            INNER JOIN public.acc_person AS ac ON pp.id = ac.pers_person_id
            ORDER BY create_time DESC ;
        ';
    }

    static public function count(): string
    {
        return '
            SELECT COUNT(id)
            FROM public.pers_person;
        ';
    }

    static public function getFullNameById(): string
    {
        return '
            select name, last_name from public.pers_person where id = :pers_person_id;
        ';
    }
}