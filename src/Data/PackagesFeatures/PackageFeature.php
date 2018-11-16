<?php

namespace App\Data\PackagesFeatures;

use App\Data\Base;
use Zend\Stdlib\ArrayUtils;

class PackageFeature extends Base
{
    protected $package;

    protected $type = 'packages-features';

    protected $nameField;

    protected function getAttributesData() : array
    {
        return [
            'name' => $this->getNameField()
        ];
    }

    protected function getRelationshipsData() : array
    {
        $result = [];

        if ($package = $this->getPackage()) {
            $result = ArrayUtils::merge($result, $package);
        }

        return $result;
    }

    /**
     * @return mixed
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * @param string $type
     * @param string $id
     * @return self
     */
    public function setPackage(string $type, string $id): self
    {
        $this->package = $this->setOneRelation($type, $id);

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
}