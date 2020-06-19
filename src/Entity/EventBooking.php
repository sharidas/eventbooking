<?php

namespace App\Entity;

use App\Repository\EventBookingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EventBookingRepository::class)
 */
class EventBooking
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $participation_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $employee_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $employee_mail;

    /**
     * @ORM\Column(type="bigint")
     */
    private $event_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $event_name;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $participation_fee;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $event_date;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $version;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParticipationId(): ?string
    {
        return $this->participation_id;
    }

    public function setParticipationId(string $participation_id): self
    {
        $this->participation_id = $participation_id;

        return $this;
    }

    public function getEmployeeName(): ?string
    {
        return $this->employee_name;
    }

    public function setEmployeeName(string $employee_name): self
    {
        $this->employee_name = $employee_name;

        return $this;
    }

    public function getEmployeeMail(): ?string
    {
        return $this->employee_mail;
    }

    public function setEmployeeMail(string $employee_mail): self
    {
        $this->employee_mail = $employee_mail;

        return $this;
    }

    public function getEventId(): ?string
    {
        return $this->event_id;
    }

    public function setEventId(string $event_id): self
    {
        $this->event_id = $event_id;

        return $this;
    }

    public function getEventName(): ?string
    {
        return $this->event_name;
    }

    public function setEventName(string $event_name): self
    {
        $this->event_name = $event_name;

        return $this;
    }

    public function getParticipationFee(): ?string
    {
        return $this->participation_fee;
    }

    public function setParticipationFee(string $participation_fee): self
    {
        $this->participation_fee = $participation_fee;

        return $this;
    }

    public function getEventDate(): ?\DateTimeInterface
    {
        return $this->event_date;
    }

    public function setEventDate(\DateTimeInterface $event_date): self
    {
        $this->event_date = $event_date;

        return $this;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }
}
