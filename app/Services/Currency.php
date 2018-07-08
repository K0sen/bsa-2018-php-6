<?php

namespace App\Services;

class Currency
{
    protected $id;
    protected $name;
    protected $shortName;
    protected $actualCourse;
    protected $actualCourseDate;
    protected $active;

    public function __construct(
        int $id,
        string $name,
        string $shortName,
        float $actualCourse,
        \DateTime $actualCourseDate,
        bool $active
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->shortName = $shortName;
        $this->actualCourse = $actualCourse;
        $this->actualCourseDate = $actualCourseDate;
        $this->active = $active;
    }

    /**
     * Gets Id.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Gets Name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Gets ShortName.
     *
     * @return string
     */
    public function getShortName(): string
    {
        return $this->shortName;
    }

    /**
     * Gets ActualCourse.
     *
     * @return float
     */
    public function getActualCourse(): float
    {
        return $this->actualCourse;
    }

    /**
     * Gets ActualCourseDate.
     *
     * @return \DateTime
     */
    public function getActualCourseDate(): \DateTime
    {
        return $this->actualCourseDate;
    }

    /**
     * Gets Active.
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }
}
