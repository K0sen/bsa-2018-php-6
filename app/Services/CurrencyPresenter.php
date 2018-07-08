<?php

namespace App\Services;

class CurrencyPresenter
{
    /**
     * Returns currency as array with convenient field names
     *
     * @param Currency $currency
     * @return array
     */
    public static function present(Currency $currency): array
    {
        return [
            'id'                 => $currency->getId(),
            'name'               => $currency->getName(),
            'short_name'         => $currency->getName(),
            'actual_course'      => $currency->getActualCourse(),
            'actual_course_date' => $currency->getActualCourse(),
            'active'             => $currency->isActive()
        ];
    }
}
