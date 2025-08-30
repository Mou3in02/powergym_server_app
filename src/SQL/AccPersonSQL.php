<?php

namespace App\SQL;

/**
 * @Info table "public.acc_person"
 */
class AccPersonSQL
{
    static public function getAllAccPerson(): string
    {
        return "SELECT * FROM public.acc_person";
    }

    static public function getAccPersonIds(): string
    {
        return "SELECT id FROM public.acc_person";
    }

    static public function getAccPersonIdAndDates(): string
    {
        return "SELECT id, start_time, end_time FROM public.acc_person";
    }

    public static function insertNewAccPerson(): string
    {
        return "
            INSERT INTO public.acc_person (
                id,
                app_id,
                bio_tbl_id,
                company_id,
                create_time,
                creater_code,
                creater_id,
                creater_name,
                op_version,
                update_time,
                updater_code,
                updater_id,
                updater_name,
                delay_passage,
                disabled,
                end_time,
                is_set_valid_time,
                pers_person_id,
                privilege,
                start_time,
                super_auth
            ) VALUES (
                :id,
                :app_id,
                :bio_tbl_id,
                :company_id,
                :create_time,
                :creater_code,
                :creater_id,
                :creater_name,
                :op_version,
                :update_time,
                :updater_code,
                :updater_id,
                :updater_name,
                :delay_passage,
                :disabled,
                :end_time,
                :is_set_valid_time,
                :pers_person_id,
                :privilege,
                :start_time,
                :super_auth
            )
        ";
    }

    public static function updateAccPerson(): string
    {
        return "
            UPDATE public.acc_person 
            SET 
                app_id = :app_id,
                bio_tbl_id = :bio_tbl_id,
                company_id = :company_id,
                create_time = :create_time,
                creater_code = :creater_code,
                creater_id = :creater_id,
                creater_name = :creater_name,
                op_version = :op_version,
                update_time = :update_time,
                updater_code = :updater_code,
                updater_id = :updater_id,
                updater_name = :updater_name,
                delay_passage = :delay_passage,
                disabled = :disabled,
                end_time = :end_time,
                is_set_valid_time = :is_set_valid_time,
                pers_person_id = :pers_person_id,
                privilege = :privilege,
                start_time = :start_time,
                super_auth = :super_auth
            WHERE id = :id
        ";
    }

}