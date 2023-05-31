<?php

namespace App\Entity;

use App\Repository\WeatherResultRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WeatherResultRepository::class)
 */
class WeatherResult
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $checkTime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="float")
     */
    private $averageTemperature;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCheckTime(): ?\DateTimeInterface
    {
        return $this->checkTime;
    }

    public function setCheckTime(\DateTimeInterface $checkTime): self
    {
        $this->checkTime = $checkTime;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAverageTemperature(): ?float
    {
        return $this->averageTemperature;
    }

    public function setAverageTemperature(float $averageTemperature): self
    {
        $this->averageTemperature = $averageTemperature;

        return $this;
    }
}
