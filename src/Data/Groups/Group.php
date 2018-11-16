<?php

namespace App\Data\Groups;

use App\Data\Base;
use Zend\Stdlib\ArrayUtils;

class Group extends Base
{
    protected $nameField;
    protected $descriptionField;
    protected $isActiveField;
    protected $colorField;
    protected $ordField;

    protected $academy;

    protected $type = 'groups';

    protected function getRelationshipsData() : array
    {
        $result = [];

        if ($academy = $this->getAcademy()) {
            $result = ArrayUtils::merge($result, $academy);
        }

        return $result;
    }

    protected function getAttributesData() : array
    {
        return [
            'name' => $this->getNameField(),
            'description' => $this->getDescriptionField(),
            'is-active' => $this->getIsActiveField(),
            'color' => $this->getColorField(),
            'ord' => $this->getOrdField()
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
    public function getNameField()
    {
        return $this->nameField ?? $this->faker->sentence($this->faker->numberBetween(1, 5));
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
    public function getDescriptionField()
    {
        return $this->descriptionField ?? $this->faker->realText();
    }

    /**
     * @param mixed $descriptionField
     * @return self
     */
    public function setDescriptionField($descriptionField): self
    {
        $this->descriptionField = $descriptionField;

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
    public function getColorField()
    {
        return $this->colorField ?? $this->faker->hexColor;
    }

    /**
     * @param mixed $colorField
     * @return self
     */
    public function setColorField($colorField): self
    {
        $this->colorField = $colorField;

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
 }