<?php

namespace App\SQL;

class PersSessionSQL
{
    public static function getMonthlyChartBar(): string
    {
        return "
                SELECT TO_CHAR(created_at, 'Day') AS day_label,
                       TO_CHAR(created_at, 'YYYY-MM-DD') AS day_date,
                       COUNT(*) AS total
                FROM pers_session
                WHERE created_at BETWEEN :start AND :end
                GROUP BY day_label, day_date
                ORDER BY day_date
        ";
    }

    public static function getWeeklyChartBar(): string
    {
        return "
                SELECT 
                    TO_CHAR(created_at, 'MM') AS month_number,
                    TO_CHAR(created_at, 'TMMonth') AS month_name,
                    COUNT(*) AS total
                FROM pers_session
                GROUP BY TO_CHAR(created_at, 'MM'), TO_CHAR(created_at, 'TMMonth')
                ORDER BY TO_CHAR(created_at, 'MM')::int
        ";
    }

    public static function getTotalPriceChartBar(): string
    {
        return "
                SELECT
                TO_CHAR(created_at, 'MM') AS month_number,
                TO_CHAR(created_at, 'TMMonth') AS month_name,
                SUM(price) AS total_price
            FROM pers_session
            GROUP BY TO_CHAR(created_at, 'MM'), TO_CHAR(created_at, 'TMMonth')
            ORDER BY TO_CHAR(created_at, 'MM')::int
        ";
    }

}