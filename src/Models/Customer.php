<?php
namespace Models;

class Customer {

    private $dateOfBirth;
    public $gender;
    const  CUSTOMER_MALE = 'male';
    const  CUSTOMER_FEMALE = 'female';
    const  CUSTOMER_SENIOR_MALE_AGE = 63;
    const  CUSTOMER_SENIOR_FEMALE_AGE = 58;


    public function __construct($dateOfBirth, $gender) {
        $this->setDateOfBirth($dateOfBirth);
        $this->setGender($gender);
    }

    public function setDateOfBirth(string $dateOfBirth) {
        $dateTime = \DateTime::createFromFormat('Y-m-d', $dateOfBirth);
        if ($dateTime === false) {
            throw new \InvalidArgumentException("Неверный формат даты рождения. Ожидается 'Y-m-d'.");
        }
        $this->dateOfBirth = $dateOfBirth;
    }
    public function setGender(string $gender)  {
        if ($gender !== self::CUSTOMER_MALE && $gender !== self::CUSTOMER_FEMALE) {
            throw new \InvalidArgumentException("Пол должен быть 'male' или 'female'.");
        }
        $this->gender = $gender;
    }

    private function getAge(): int
    {
        $dateOfBirthTime = new \DateTime($this->dateOfBirth);
        $now = new \DateTime();
        return $now->diff($dateOfBirthTime)->y;
    }

    public function isSenior(): bool
    {
        $age = $this->getAge();

        return ($this->gender === Customer::CUSTOMER_MALE && $age >= Customer::CUSTOMER_SENIOR_MALE_AGE) ||
            ($this->gender === Customer::CUSTOMER_FEMALE && $age >= Customer::CUSTOMER_SENIOR_FEMALE_AGE);
    }
}
