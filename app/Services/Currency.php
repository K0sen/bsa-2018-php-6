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

    /**
     * Sets Name.
     *
     * @param string $name
     *
     * @return Currency
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Sets ShortName.
     *
     * @param string $shortName
     *
     * @return Currency
     */
    public function setShortName(string $shortName): self
    {
        $this->shortName = $shortName;
        return $this;
    }

    /**
     * Sets ActualCourse.
     *
     * @param float $actualCourse
     *
     * @return Currency
     */
    public function setActualCourse(float $actualCourse): self
    {
        $this->actualCourse = $actualCourse;
        return $this;
    }

    /**
     * Sets ActualCourseDate.
     *
     * @param \DateTime $actualCourseDate
     *
     * @return Currency
     */
    public function setActualCourseDate(\DateTime $actualCourseDate): self
    {
        $this->actualCourseDate = $actualCourseDate;
        return $this;
    }

    /**
     * Sets Active.
     *
     * @param bool $active
     *
     * @return Currency
     */
    public function setActive(bool $active): self
    {
        $this->active = $active;
        return $this;
    }
}
