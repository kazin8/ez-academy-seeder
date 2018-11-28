<?php

namespace App\Data\Actions;

use App\Data\Base;
use Zend\Stdlib\ArrayUtils;

class Action extends Base
{
    const ACTION_TYPE_KLICK_TIPP      = 'KLT';
    const ACTION_TYPE_MAIL_CHIMP      = 'MCH';
    const ACTION_TYPE_GET_RESPONSE    = 'GRE';
    const ACTION_TYPE_ACTIVE_CAMPAGIN = 'ACA';
    const ACTION_TYPE_QUENTIN         = 'QNT';
    const ACTION_TYPE_AWEBER          = 'AWE';
    const ACTION_TYPE_WEBINAR         = 'WEB';
    const ACTION_TYPE_EMAIL           = 'EML';

    const TRIGGER_REGISTRATION = 'REG';
    const TRIGGER_PURCHASE = 'PUR';
    const TRIGGER_FINISH_COURSE = 'FCO';
    const TRIGGER_FINISH_MODULE = 'FMO';
    const TRIGGER_FINISH_LESSON = 'FLE';

    protected $actionTypeField;
    protected $triggerField;
    protected $isActiveField;
    protected $smtpIdField;
    protected $isAllPaidCoursesField;
    protected $isAllFreeCourses;
    protected $accountIdField;
    protected $listIdField;
    protected $templateIdField;
    protected $funnelIdField;
    protected $subjectField;
    protected $ccField;
    protected $bcField;
    protected $isDoiField;
    protected $dayOfCycleField;

    protected $academy;
    protected $courses;
    protected $lessons;
    protected $modules;

    protected $type = 'actions';

    protected function getRelationshipsData() : array
    {
        $result = [];

        if ($academy = $this->getAcademy()) {
            $result = ArrayUtils::merge($result, $academy);
        }

        if ($courses = $this->getCourses()) {
            $result = ArrayUtils::merge($result, $courses);
        }

        if ($lessons = $this->getLessons()) {
            $result = ArrayUtils::merge($result, $lessons);
        }

        if ($modules = $this->getModules()) {
            $result = ArrayUtils::merge($result, $modules);
        }

        return $result;
    }

    protected function getAttributesData() : array
    {
        return [
            'action-type' => $this->getActionTypeField(),
            'trigger' => $this->getTriggerField(),
            'is-active' => $this->getIsActiveField(),
            'smtp-id' => $this->getSmtpIdField(),
            'is-all-paid-courses' => $this->getIsAllPaidCoursesField(),
            'is-all-free-courses' => $this->getIsAllFreeCourses(),
            'account-id' => $this->getAccountIdField(),
            'list-id' => $this->getListIdField(),
            'template-id' => $this->getTemplateIdField(),
            'funnel-id' => $this->getFunnelIdField(),
            'subject' => $this->getSubjectField(),
            'cc' => $this->getCcField(),
            'bc' => $this->getBcField(),
            'is-doi' => $this->getIsDoiField(),
            'day-of-cycle' => $this->getDayOfCycleField()
        ];
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
    public function getCourses()
    {
        return $this->courses;
    }

    /**
     * @param string $type
     * @param array $ids
     * @return self
     */
    public function setCourses(string $type, array $ids): self
    {
        $this->courses = $this->setManyRelation($type, $ids);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLessons()
    {
        return $this->lessons;
    }

    /**
     * @param string $type
     * @param array $ids
     * @return self
     */
    public function setLessons(string $type, array $ids): self
    {
        $this->lessons = $this->setManyRelation($type, $ids);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getModules()
    {
        return $this->modules;
    }

    /**
     * @param string $type
     * @param array $ids
     * @return self
     */
    public function setModules(string $type, array $ids): self
    {
        $this->modules = $this->setManyRelation($type, $ids);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getActionTypeField()
    {
        return $this->actionTypeField ?? $this->faker->randomElement([
                self::ACTION_TYPE_ACTIVE_CAMPAGIN,
                self::ACTION_TYPE_AWEBER,
                self::ACTION_TYPE_MAIL_CHIMP,
                self::ACTION_TYPE_EMAIL,
                self::ACTION_TYPE_GET_RESPONSE,
                self::ACTION_TYPE_KLICK_TIPP,
                self::ACTION_TYPE_QUENTIN,
                self::ACTION_TYPE_WEBINAR
            ]);
    }

    /**
     * @param mixed $actionTypeField
     * @return self
     */
    public function setActionTypeField($actionTypeField): self
    {
        $this->actionTypeField = $actionTypeField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTriggerField()
    {
        return $this->triggerField ?? $this->faker->randomElement([
                self::TRIGGER_FINISH_COURSE,
                self::TRIGGER_FINISH_LESSON,
                self::TRIGGER_FINISH_MODULE,
                self::TRIGGER_PURCHASE,
                self::TRIGGER_REGISTRATION
            ]);
    }

    /**
     * @param mixed $triggerField
     * @return self
     */
    public function setTriggerField($triggerField): self
    {
        $this->triggerField = $triggerField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsActiveField()
    {
        return (int) ($this->isActiveField ?? $this->faker->boolean());
    }

    /**
     * @param mixed $isActiveField
     * @return self
     */
    public function setIsActiveField($isActiveField): self
    {
        $this->isActiveField = $isActiveField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSmtpIdField()
    {
        return $this->smtpIdField ?? $this->faker->uuid;
    }

    /**
     * @param mixed $smtpIdField
     * @return self
     */
    public function setSmtpIdField($smtpIdField): self
    {
        $this->smtpIdField = $smtpIdField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsAllPaidCoursesField()
    {
        return (int) ($this->isAllPaidCoursesField ?? $this->faker->boolean());
    }

    /**
     * @param mixed $isAllPaidCoursesField
     * @return self
     */
    public function setIsAllPaidCoursesField($isAllPaidCoursesField): self
    {
        $this->isAllPaidCoursesField = $isAllPaidCoursesField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsAllFreeCourses()
    {
        return (int) $this->isAllFreeCourses ?? $this->faker->boolean();
    }

    /**
     * @param mixed $isAllFreeCourses
     * @return self
     */
    public function setIsAllFreeCourses($isAllFreeCourses): self
    {
        $this->isAllFreeCourses = $isAllFreeCourses;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAccountIdField()
    {
        return $this->accountIdField ?? $this->faker->uuid;
    }

    /**
     * @param mixed $accountIdField
     * @return self
     */
    public function setAccountIdField($accountIdField): self
    {
        $this->accountIdField = $accountIdField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getListIdField()
    {
        return $this->listIdField ?? $this->faker->uuid;
    }

    /**
     * @param mixed $listIdField
     * @return self
     */
    public function setListIdField($listIdField): self
    {
        $this->listIdField = $listIdField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTemplateIdField()
    {
        return $this->templateIdField ?? $this->faker->uuid;
    }

    /**
     * @param mixed $templateIdField
     * @return self
     */
    public function setTemplateIdField($templateIdField): self
    {
        $this->templateIdField = $templateIdField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFunnelIdField()
    {
        return $this->funnelIdField ?? $this->faker->uuid;
    }

    /**
     * @param mixed $funnelIdField
     * @return self
     */
    public function setFunnelIdField($funnelIdField): self
    {
        $this->funnelIdField = $funnelIdField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubjectField()
    {
        return $this->subjectField ?? $this->faker->sentence();
    }

    /**
     * @param mixed $subjectField
     * @return self
     */
    public function setSubjectField($subjectField): self
    {
        $this->subjectField = $subjectField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCcField()
    {
        return $this->ccField ?? $this->faker->email;
    }

    /**
     * @param mixed $ccField
     * @return self
     */
    public function setCcField($ccField): self
    {
        $this->ccField = $ccField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBcField()
    {
        return $this->bcField ?? $this->faker->email;
    }

    /**
     * @param mixed $bcField
     * @return self
     */
    public function setBcField($bcField): self
    {
        $this->bcField = $bcField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsDoiField()
    {
        return (int) ($this->isDoiField ?? $this->faker->boolean());
    }

    /**
     * @param mixed $isDoiField
     * @return self
     */
    public function setIsDoiField($isDoiField): self
    {
        $this->isDoiField = $isDoiField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDayOfCycleField()
    {
        return $this->dayOfCycleField ?? $this->faker->numberBetween(0, 100);
    }

    /**
     * @param mixed $dayOfCycleField
     * @return self
     */
    public function setDayOfCycleField($dayOfCycleField): self
    {
        $this->dayOfCycleField = $dayOfCycleField;

        return $this;
    }
}