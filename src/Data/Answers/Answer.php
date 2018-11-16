<?php

namespace App\Data\Answers;

use App\Data\Base;
use Zend\Stdlib\ArrayUtils;

class Answer extends Base
{
    protected $question;

    protected $type = 'answers';

    protected $nameField;
    protected $imgField;
    protected $isCorrectField;

    protected function getAttributesData() : array
    {
        return [
            'name' => $this->getNameField(),
            'img' => $this->getImgField(),
            'is-correct' => $this->getIsCorrectField()
        ];
    }

    protected function getRelationshipsData() : array
    {
        $result = [];

        if ($question = $this->getQuestion()) {
            $result = ArrayUtils::merge($result, $question);
        }

        return $result;
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param string $type
     * @param string $id
     * @return self
     */
    public function setQuestion(string $type, string $id): self
    {
        $this->question = $this->setOneRelation($type, $id);

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
    public function getImgField()
    {
        return $this->imgField ?? $this->faker->uuid;
    }

    /**
     * @param mixed $imgField
     * 2@return self
     */
    public function setImgField($imgField): self
    {
        $this->imgField = $imgField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsCorrectField()
    {
        return (int) ($this->isCorrectField ?? $this->faker->boolean());
    }

    /**
     * @param mixed $isCorrectField
     * @return self
     */
    public function setIsCorrectField($isCorrectField): self
    {
        $this->isCorrectField = $isCorrectField;

        return $this;
    }
}