<?php

namespace App\Data\PackagesProducts;

use App\Data\Base;
use Zend\Stdlib\ArrayUtils;

class PackageProduct extends Base
{
    protected $package;

    protected $type = 'packages-products';

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