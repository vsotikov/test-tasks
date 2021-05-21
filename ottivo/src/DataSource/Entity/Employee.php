<?php
declare(strict_types = 1);

/**
 * Employee
 */
class Employee
{
    private ?string $name = null;
    private ?DateTimeInterface $birthDate = null;
    private ?DateTimeInterface $contractStart = null;
    private ?float $contractSpecialVacationDays = null;

    public function setFromArray(array $data): self
    {
        if (isset($data['name'])) {
            $this->setName((string)$data['name']);
        }

        if (isset($data['birth_date'])) {
            try {
                $this->setBirthDate(new DateTimeImmutable($data['birth_date']));
            } catch (Throwable $e) {
                // Handle (log) invalid date value
                // Leave value unset
            }
        }

        if (isset($data['contract_start_date'])) {
            try {
                $this->setContractStart(new DateTimeImmutable($data['contract_start_date']));
            } catch (Throwable $e) {
                // Handle (log) invalid date value
                // Leave value unset
            }
        }

        if (isset($data['contract_special_vacation_days'])) {
            $this->setContractSpecialVacationDays((float)$data['contract_special_vacation_days']);
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Employee
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getBirthDate(): ?DateTimeInterface
    {
        return $this->birthDate;
    }

    /**
     * @param DateTimeInterface|null $birthDate
     * @return Employee
     */
    public function setBirthDate(?DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getContractStart(): ?DateTimeInterface
    {
        return $this->contractStart;
    }

    /**
     * @param DateTimeInterface|null $contractStart
     * @return Employee
     */
    public function setContractStart(?DateTimeInterface $contractStart): self
    {
        $this->contractStart = $contractStart;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getContractSpecialVacationDays(): ?float
    {
        return $this->contractSpecialVacationDays;
    }

    /**
     * @param float|null $contractSpecialVacationDays
     * @return Employee
     */
    public function setContractSpecialVacationDays(?float $contractSpecialVacationDays): self
    {
        $this->contractSpecialVacationDays = $contractSpecialVacationDays;

        return $this;
    }
}