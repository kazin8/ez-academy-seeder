<?php

namespace App\Data\Members;

use App\Data\Base;
use Zend\Stdlib\ArrayUtils;

class Member extends Base
{
    protected $courses;
    protected $packages;
    protected $academy;
    protected $type = 'members';

    protected $firstnameField;
    protected $lastnameField;
    protected $emailField;
    protected $isNotificationField;
    protected $passwordField;

    protected function getAttributesData() : array
    {
        return [
            'firstname' => $this->getFirstnameField(),
            'lastname' => $this->getLastnameField(),
            'email' => $this->getEmailField(),
            'password' => $this->getPasswordField(),
            'is-notification' => $this->getisNotificationField()
        ];
    }

    protected function getRelationshipsData() : array
    {
        $result = [];

        if ($academy = $this->getAcademy()) {
            $result = ArrayUtils::merge($result, $academy);
        }

        if ($courses = $this->getCourses()) {
            $result = ArrayUtils::merge($result, $courses);
        }

        if ($packages = $this->getPackages()) {
            $result = ArrayUtils::merge($result, $packages);
        }

        return $result;
    }

    /**
     * @return mixed
     */
    public function getCourses()
    {
        return $this->courses;
    }

    /**
     * @param string $type
     * @param array $ids
     */
    public function setCourses(string $type, array $ids): void
    {
        $this->courses = $this->setManyRelation($type, $ids);
    }

    /**
     * @return mixed
     */
    public function getPackages()
    {
        return $this->packages;
    }

    /**
     * @param string $type
     * @param array $ids
     */
    public function setPackages(string $type, array $ids): void
    {
        $this->packages = $this->setManyRelation($type, $ids);
    }

    /**
     * @return mixed
     */
    public function getAcademy()
    {
        return $this->academy;
    }

    /**
     * @param string $type
     * @param string $id
     * @return self
     */
    public function setAcademy(string $type, string $id): self
    {
        $this->academy = $this->setOneRelation($type, $id);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstnameField()
    {
        return $this->firstnameField ?? $this->faker->firstName();
    }

    /**
     * @param mixed $firstnameField
     * @return self
     */
    public function setFirstnameField($firstnameField): self
    {
        $this->firstnameField = $firstnameField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastnameField()
    {
        return $this->lastnameField ?? $this->faker->lastName;
    }

    /**
     * @param mixed $lastnameField
     * @return self
     */
    public function setLastnameField($lastnameField): self
    {
        $this->lastnameField = $lastnameField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmailField()
    {
        return $this->emailField ?? $this->faker->unique()->email;
    }

    /**
     * @param mixed $emailField
     * @return self
     */
    public function setEmailField($emailField): self
    {
        $this->emailField = $emailField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getisNotificationField()
    {
        return (int) ($this->isNotificationField ?? $this->faker->boolean());
    }

    /**
     * @param mixed $isNotificationField
     * @return self
     */
    public function setIsNotificationField($isNotificationField): self
    {
        $this->isNotificationField = $isNotificationField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPasswordField()
    {
        return $this->passwordField ?? $this->faker->password();
    }

    /**
     * @param mixed $passwordField
     * @return self
     */
    public function setPasswordField($passwordField): self
    {
        $this->passwordField = $passwordField;

        return $this;
    }




}