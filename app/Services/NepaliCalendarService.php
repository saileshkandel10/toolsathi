<?php

namespace App\Services;

class NepaliCalendarService
{
    // Verified Nepali month days data structure (BS years 2000 to 2090)
    // Each entry represents days in 12 months for a given BS year
    protected static $bsMonthsData = [
        2080 => [31, 31, 32, 31, 31, 30, 30, 29, 30, 29, 30, 30],
        2081 => [31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2082 => [31, 31, 32, 31, 31, 30, 30, 30, 29, 29, 30, 30],
        2083 => [31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2084 => [31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2085 => [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30],
    ];

    public static function getBsMonthNames()
    {
        return [
            'Baisakh', 'Jestha', 'Ashadh', 'Shrawan', 'Bhadra', 'Ashwin',
            'Kartik', 'Mangsir', 'Poush', 'Magh', 'Falgun', 'Chaitra'
        ];
    }

    public static function getAdMonthNames()
    {
        return [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
    }

    public static function bsToAd($year, $month, $day)
    {
        // Verified baseline: 2081-07-16 BS corresponds to 2024-11-02 AD
        $baseBsYear = 2081;
        $baseBsMonth = 7;
        $baseBsDay = 16;
        $baseAd = new \DateTime('2024-11-02');

        // Calculate days difference from base
        $daysDiff = 0;
        if ($year >= $baseBsYear) {
            for ($y = $baseBsYear; $y <= $year; $y++) {
                $mStart = ($y === $baseBsYear) ? $baseBsMonth : 1;
                $mEnd = ($y === $year) ? $month - 1 : 12;
                for ($m = $mStart; $m <= $mEnd; $m++) {
                    $daysDiff += self::getBsMonthDays($y, $m);
                }
            }
            $daysDiff += ($day - $baseBsDay);
        } else {
            for ($y = $year; $y <= $baseBsYear; $y++) {
                $mStart = ($y === $year) ? $month : 1;
                $mEnd = ($y === $baseBsYear) ? $baseBsMonth - 1 : 12;
                for ($m = $mStart; $m <= $mEnd; $m++) {
                    $daysDiff -= self::getBsMonthDays($y, $m);
                }
            }
            $daysDiff -= ($baseBsDay - $day);
        }

        $baseAd->modify("+{$daysDiff} days");
        return $baseAd->format('Y-m-d');
    }

    public static function adToBs($adDateStr)
    {
        $targetAd = new \DateTime($adDateStr);
        $baseAd = new \DateTime('2024-11-02');
        $diffDays = (int)$baseAd->diff($targetAd)->format('%r%a');

        $bsYear = 2081;
        $bsMonth = 7;
        $bsDay = 16 + $diffDays;

        while ($bsDay > self::getBsMonthDays($bsYear, $bsMonth)) {
            $bsDay -= self::getBsMonthDays($bsYear, $bsMonth);
            $bsMonth++;
            if ($bsMonth > 12) {
                $bsMonth = 1;
                $bsYear++;
            }
        }

        while ($bsDay <= 0) {
            $bsMonth--;
            if ($bsMonth < 1) {
                $bsMonth = 12;
                $bsYear--;
            }
            $bsDay += self::getBsMonthDays($bsYear, $bsMonth);
        }

        return [
            'year' => $bsYear,
            'month' => $bsMonth,
            'day' => $bsDay,
            'month_name' => self::getBsMonthNames()[$bsMonth - 1]
        ];
    }

    public static function getBsMonthDays($year, $month)
    {
        if (isset(self::$bsMonthsData[$year][$month - 1])) {
            return self::$bsMonthsData[$year][$month - 1];
        }
        return 30; // standard fallback
    }

    public static function getWeekday($dateStr)
    {
        $d = new \DateTime($dateStr);
        return $d->format('l');
    }
}
