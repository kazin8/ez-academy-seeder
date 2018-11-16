<?php

namespace App\Data\Packages;

use App\Data\Base;
use Zend\Stdlib\ArrayUtils;

class Package extends Base
{
    const PAY_CURR_EUR           = 'EUR';
    const PAY_CURR_USD           = 'USD';
    const PAY_CURR_CNY           = 'CNY';

    const PAY_TYPE_ONE           = 'ONE';
    const PAY_TYPE_SUBSCRIBE     = 'SUB';

    protected $nameField;
    protected $descriptionField;
    protected $isActiveField;
    protected $priceField;
    protected $salePageProductIdField;
    protected $isThanksPageUpdateField;
    protected $salePageUrlField;
    protected $funnelIdField;
    protected $payCurrField;
    protected $payTypeField;
    protected $levelIdField;
    protected $upgradeUrlField;
    protected $ordField;

    protected $academy;

    protected $type = 'packages';

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
            'price' => $this->getPriceField(),
            'sale-page-product-id' => $this->getSalePageProductIdField(),
            'is-thanks-page-update' => $this->getIsThanksPageUpdateField(),
            'sale-page-url' => $this->getSalePageUrlField(),
            'funnel-id' => $this->getFunnelIdField(),
            'ord' => $this->getOrdField(),
            'pay-curr' => $this->getPayCurrField(),
            'pay-type' => $this->getPayTypeField(),
            'level-id' => $this->getLevelIdField(),
            'upgrade-url' => $this->getUpgradeUrlField()



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
    public function getPriceField()
    {
        return $this->priceField ?? $this->faker->randomFloat();
    }

    /**
     * @param mixed $priceField
     * @return self
     */
    public function setPriceField($priceField): self
    {
        $this->priceField = $priceField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSalePageProductIdField()
    {
        return $this->salePageProductIdField ?? $this->faker->uuid;
    }

    /**
     * @param mixed $salePageProductIdField
     * @return self
     */
    public function setSalePageProductIdField($salePageProductIdField): self
    {
        $this->salePageProductIdField = $salePageProductIdField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsThanksPageUpdateField()
    {
        return (int) ($this->isThanksPageUpdateField ?? $this->faker->boolean);
    }

    /**
     * @param mixed $isThanksPageUpdateField
     * @return self
     */
    public function setIsThanksPageUpdateField($isThanksPageUpdateField): self
    {
        $this->isThanksPageUpdateField = $isThanksPageUpdateField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSalePageUrlField()
    {
        return $this->salePageUrlField ?? $this->faker->url;
    }

    /**
     * @param mixed $salePageUrlField
     * @return self
     */
    public function setSalePageUrlField($salePageUrlField): self
    {
        $this->salePageUrlField = $salePageUrlField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFunnelIdField()
    {
        return $this->funnelIdField ?? $this->faker->uuid;
    }

    /**
     * @param mixed $funnelIdField
     * @return self
     */
    public function setFunnelIdField($funnelIdField): self
    {
        $this->funnelIdField = $funnelIdField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayCurrField()
    {
        return $this->payCurrField ?? $this->faker->randomElement([
                self::PAY_CURR_CNY,
                self::PAY_CURR_EUR,
                self::PAY_CURR_USD
            ]);
    }

    /**
     * @param mixed $payCurrField
     * @return self
     */
    public function setPayCurrField($payCurrField): self
    {
        $this->payCurrField = $payCurrField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayTypeField()
    {
        return $this->payTypeField ?? $this->faker->randomElement([
                self::PAY_TYPE_ONE,
                self::PAY_TYPE_SUBSCRIBE
            ]);
    }

    /**
     * @param mixed $payTypeField
     * @return self
     */
    public function setPayTypeField($payTypeField): self
    {
        $this->payTypeField = $payTypeField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLevelIdField()
    {
        return $this->levelIdField ?? $this->faker->numberBetween(1, 10);
    }

    /**
     * @param mixed $levelIdField
     * @return self
     */
    public function setLevelIdField($levelIdField): self
    {
        $this->levelIdField = $levelIdField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpgradeUrlField()
    {
        return $this->upgradeUrlField ?? $this->faker->url;
    }

    /**
     * @param mixed $upgradeUrlField
     * @return self
     */
    public function setUpgradeUrlField($upgradeUrlField): self
    {
        $this->upgradeUrlField = $upgradeUrlField;

        return $this;
    }
}