<?php
declare(strict_types=1);

namespace App\Entity;

use DateTimeInterface;

class Vehicle
{
    private ?int $id = null;
    private ?string $manufacturer = null;
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
    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    /**
     * @param string|null $manufacturer
     * @return Vehicle
     */
    public function setManufacturer(?string $manufacturer): Vehicle
    {
        $this->manufacturer = $manufacturer;
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