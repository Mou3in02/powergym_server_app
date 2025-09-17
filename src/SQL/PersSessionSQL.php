<?php

namespace App\SQL;

class PersSessionSQL
{
    // 📊 Nombre de clients par semaine (groupé par jour)
    public static function getWeeklyChartBar(): string
    {
        return "
            SELECT 
                TRIM(TO_CHAR(ps.created_at, 'Day')) AS day_label,
                COUNT(ps.id) AS total
            FROM app_pers_session ps
            WHERE ps.is_deleted = false
              AND ps.created_at BETWEEN :start AND :end
            GROUP BY day_label
        ";
    }

    // 📊 Nombre de clients par mois
    public static function getMonthlyChartBar(): string
    {
        return "
            SELECT 
                TO_CHAR(ps.created_at, 'MM') AS month_number,
                COUNT(ps.id) AS total
            FROM app_pers_session ps
            WHERE ps.is_deleted = false
            GROUP BY TO_CHAR(ps.created_at, 'MM')
            ORDER BY TO_CHAR(ps.created_at, 'MM')::int
        ";
    }

    // 📊 Somme totale des prix par mois
    public static function getTotalPriceChartBar(): string
    {
        return "
            SELECT 
                TO_CHAR(ps.created_at, 'MM') AS month_number,
                SUM(ps.price) AS total_price
            FROM app_pers_session ps
            WHERE ps.is_deleted = false
            GROUP BY TO_CHAR(ps.created_at, 'MM')
            ORDER BY TO_CHAR(ps.created_at, 'MM')::int
        ";
    }
}
