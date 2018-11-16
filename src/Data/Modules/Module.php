<?php

namespace App\Data\Modules;

use App\Data\Base;
use Zend\Stdlib\ArrayUtils;

class Module extends Base
{
    protected $course;

    protected $type = 'modules';

    protected $titleField;
    protected $imgField;
    protected $daysField;
    protected $ordField;
    protected $slugField;

    protected function getAttributesData() : array
    {
        return [
            'title' => $this->getTitleField(),
            'img' => $this->getImgField(),
            'days' => $this->getDaysField(),
            'ord' => $this->getOrdField(),
            'slug' => $this->getSlugField()
        ];
    }

    protected function getRelationshipsData() : array
    {
        $result = [];

        if ($course = $this->getCourse()) {
            $result = ArrayUtils::merge($result, $course);
        }

        return $result;
    }

    /**
     * @return mixed
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * @param string $type
     * @param string $id
     * @return self
     */
    public function setCourse(string $type, string $id): self
    {
        $this->course = $this->setOneRelation($type, $id);

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