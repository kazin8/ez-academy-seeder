<?php

namespace App\Data\Lessons;

use App\Data\Base;
use Zend\Stdlib\ArrayUtils;

class Lesson extends Base
{
    protected $module;

    protected $type = 'lessons';

    protected $titleField;
    protected $fullTextField;
    protected $daysField;
    protected $ordField;
    protected $slugField;

    protected function getAttributesData() : array
    {
        return [
            'title' => $this->getTitleField(),
            'full-text' => $this->getFullTextField(),
            'days' => $this->getDaysField(),
            'ord' => $this->getOrdField(),
            'slug' => $this->getSlugField()
        ];
    }

    protected function getRelationshipsData() : array
    {
        $result = [];

        if ($module = $this->getModule()) {
            $result = ArrayUtils::merge($result, $module);
        }

        return $result;
    }

    /**
     * @return mixed
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @param string $type
     * @param string $id
     * @return self
     */
    public function setModule(string $type, string $id): self
    {
        $this->module = $this->setOneRelation($type, $id);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitleField()
    {
        return $this->titleField ?? $this->faker->sentence($this->faker->numberBetween(1, 10));
    }

    /**
     * @param mixed $titleField
     * @return self
     */
    public function setTitleField($titleField): self
    {
        $this->titleField = $titleField;

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
    public function getDaysField()
    {
        return $this->daysField ?? $this->faker->numberBetween(0, 100);
    }

    /**
     * @param mixed $daysField
     * @return self
     */
    public function setDaysField($daysField): self
    {
        $this->daysField = $daysField;

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
    public function getSlugField()
    {
        return $this->slugField ?? $this->faker->slug($this->faker->numberBetween(1, 5));
    }

    /**
     * @param mixed $slugField
     * @return self
     */
    public function setSlugField($slugField): self
    {
        $this->slugField = $slugField;

        return $this;
    }

}