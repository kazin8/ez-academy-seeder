<?php

namespace App\Data\Quizzes;

use App\Data\Base;
use Zend\Stdlib\ArrayUtils;

class Quiz extends Base
{
    protected $lesson;

    protected $type = 'quizzes';

    protected $nameField;
    protected $tresholdField;
    protected $certField;
    protected $fullTextField;
    protected $retakeField;

    protected function getAttributesData() : array
    {
        return [
            'name' => $this->getNameField(),
            'threshold' => $this->getTresholdField(),
            'cert' => $this->getCertField(),
            'retake' => $this->getRetakeField(),
            'full-text' => $this->getFullTextField()
        ];
    }

    protected function getRelationshipsData() : array
    {
        $result = [];

        if ($lesson = $this->getLesson()) {
            $result = ArrayUtils::merge($result, $lesson);
        }

        return $result;
    }

    /**
     * @return mixed
     */
    public function getLesson()
    {
        return $this->lesson;
    }

    /**
     * @param string $type
     * @param string $id
     * @return self
     */
    public function setLesson(string $type, string $id): self
    {
        $this->lesson = $this->setOneRelation($type, $id);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNameField()
    {
        return $this->nameField ?? $this->faker->sentence($this->faker->numberBetween(1, 10));
    }

    /**
     * @param mixed $nameField
     * @return self
     */
    public function setNameField($nameField): self
    {
        $this->nameField = $nameField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFullTextField()
    {
        return $this->fullTextField ?? $this->faker->realText(300);
    }

    /**
     * @param mixed $fullTextField
     * 2@return self
     */
    public function setFullTextField($fullTextField): self
    {
        $this->fullTextField = $fullTextField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTresholdField()
    {
        return (int) ($this->tresholdField ?? $this->faker->boolean());
    }

    /**
     * @param mixed $tresholdField
     * @return self
     */
    public function setTresholdField($tresholdField): self
    {
        $this->tresholdField = $tresholdField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCertField()
    {
        return $this->certField ?? $this->faker->uuid;
    }

    /**
     * @param mixed $certField
     * @return self
     */
    public function setCertField($certField): self
    {
        $this->certField = $certField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRetakeField()
    {
        return $this->retakeField ?? $this->faker->numberBetween(0, 10);
    }

    /**
     * @param mixed $retakeField
     * @return self
     */
    public function setRetakeField($retakeField): self
    {
        $this->retakeField = $retakeField;

        return $this;
    }

}