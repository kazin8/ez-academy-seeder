<?php

namespace App\Data\Courses;

use Zend\Stdlib\ArrayUtils;

class CoursePackage extends Course
{
    protected $packages;
    protected $relatedPackages;

    protected function getRelationshipsData() : array
    {
        $result = parent::getRelationshipsData();

        if ($packages = $this->getPackages()) {
            $result = ArrayUtils::merge($result, $packages);
        }

        if ($relatedPackages = $this->getRelatedPackages()) {
            $result = ArrayUtils::merge($result, $relatedPackages);
        }

        return $result;
    }

    /**
     * @return mixed
     */
    public function getPackages()
    {
        return $this->packages;
    }

    /**
     * @param string $type
     * @param array $ids
     * @return self
     */
    public function setPackages(string $type, array $ids): self
    {
        $this->packages = $this->setManyRelation($type, $ids);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRelatedPackages()
    {
        return $this->relatedPackages;
    }

    /**
     * @param string $type
     * @param array $ids
     * @return self
     */
    public function setRelatedPackages(string $type, array $ids): self
    {
        $this->relatedPackages = $this->setManyRelation($type, $ids);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSalePageTypeField()
    {
        return $this->salePageTypeField ?? null;
    }

    /**
     * @return mixed
     */
    public function getSalePageTextField()
    {
        return $this->salePageTextField ?? null;
    }

    /**
     * @return mixed
     */
    public function getUpsellFunnelIdField()
    {
        return $this->upsellFunnelIdField ?? null;
    }

    /**
     * @return mixed
     */
    public function getPriceField()
    {
        return $this->priceField ?? null;
    }

    /**
     * @return mixed
     */
    public function getSalePageProductIdField()
    {
        return $this->salePageProductIdField ?? null;
    }

    /**
     * @return mixed
     */
    public function getIsThanksPageUpdateField()
    {
        return (int) ($this->isThanksPageUpdateField ?? null);
    }

    /**
     * @return mixed
     */
    public function getSalePageUrlField()
    {
        return $this->salePageUrlField ?? null;
    }

    /**
     * @return mixed
     */
    public function getFunnelIdField()
    {
        return $this->funnelIdField ?? null;
    }

    /**
     * @return mixed
     */
    public function getPayCurrField()
    {
        return $this->payCurrField ?? null;
    }

    /**
     * @return mixed
     */
    public function getPayTypeField()
    {
        return $this->payTypeField ?? null;
    }
}