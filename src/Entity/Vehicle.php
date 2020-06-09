<?php
declare(strict_types=1);

namespace App\Entity;

use DateTimeInterface;

class Vehicle
{
    private ?int $id = null;
    private ?string $build = null;
    private ?DateTimeInterface $issueDate = null;
    private ?int $mileage = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getBuild(): ?string
    {
        return $this->build;
    }

    /**
     * @param string|null $build
     * @return Vehicle
     */
    public function setBuild(?string $build): Vehicle
    {
        $this->build = $build;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getIssueDate(): ?DateTimeInterface
    {
        return $this->issueDate;
    }

    /**
     * @param DateTimeInterface|null $issueDate
     * @return Vehicle
     */
    public function setIssueDate(?DateTimeInterface $issueDate): Vehicle
    {
        $this->issueDate = $issueDate;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMileage(): ?int
    {
        return $this->mileage;
    }

    /**
     * @param int|null $mileage
     * @return Vehicle
     */
    public function setMileage(?int $mileage): Vehicle
    {
        $this->mileage = $mileage;
        return $this;
    }

}