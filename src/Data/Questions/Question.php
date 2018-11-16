<?php

namespace App\Data\Questions;

use App\Data\Base;
use Zend\Stdlib\ArrayUtils;

class Question extends Base
{
    const TYPE_SINGLE_TEXT = 'STX';
    const TYPE_SINGLE_IMG  = 'SIM';
    const TYPE_MULTI_TEXT  = 'MTX';
    const TYPE_MULTI_IMG   = 'MIM';

    protected $quiz;

    protected $type = 'questions';

    protected $ordField;
    protected $typeField;
    protected $fullTextField;

    protected function getAttributesData() : array
    {
        return [
            'ord' => $this->getOrdField(),
            'type' => $this->getTypeField(),
            'full-text' => $this->getFullTextField()
        ];
    }

    protected function getRelationshipsData() : array
    {
        $result = [];

        if ($quiz = $this->getQuiz()) {
            $result = ArrayUtils::merge($result, $quiz);
        }

        return $result;
    }

    /**
     * @return mixed
     */
    public function getQuiz()
    {
        return $this->quiz;
    }

    /**
     * @param string $type
     * @param string $id
     * @return self
     */
    public function setQuiz(string $type, string $id): self
    {
        $this->quiz = $this->setOneRelation($type, $id);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrdField()
    {
        return $this->ordField ?? $this->faker->numberBetween(0, 10);
    }

    /**
     * @param mixed $ordField
     * @return self
     */
    public function setOrdField($ordField): self
    {
        $this->ordField = $ordField;

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
    public function getTypeField()
    {
        return $this->typeField ?? $this->faker->randomElement([
                self::TYPE_MULTI_IMG,
                self::TYPE_MULTI_TEXT,
                self::TYPE_SINGLE_IMG,
                self::TYPE_SINGLE_TEXT
            ]);
    }

    /**
     * @param mixed $typeField
     * @return self
     */
    public function setTypeField($typeField): self
    {
        $this->type = $typeField;

        return $this;
    }
}