<?php

namespace App\Data\CoursesProducts;

use App\Data\Base;
use Zend\Stdlib\ArrayUtils;

class CourseProduct extends Base
{
    protected $course;

    protected $type = 'courses-products';

    protected $ipnIdField;
    protected $productIdField;

    protected function getAttributesData() : array
    {
        return [
            'ipn-id' => $this->getIpnIdField(),
            'product-id' => $this->getProductIdField()
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
    public function getIpnIdField()
    {
        return $this->ipnIdField ?? $this->faker->slug();
    }

    /**
     * @param mixed $ipnIdField
     * @return self
     */
    public function setIpnIdField($ipnIdField): self
    {
        $this->ipnIdField = $ipnIdField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProductIdField()
    {
        return $this->productIdField ?? $this->faker->uuid;
    }

    /**
     * @param mixed $productIdField
     * @return self
     */
    public function setProductIdField($productIdField): self
    {
        $this->productIdField = $productIdField;

        return $this;
    }
}