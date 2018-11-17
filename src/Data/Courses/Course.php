<?php

namespace App\Data\Courses;

use App\Data\Base;
use Zend\Stdlib\ArrayUtils;

class Course extends Base
{
    const TYPE_PUBLISHED         = 'PUB';
    const TYPE_DRAFT             = 'DRA';

    const OBLIGATORY_NO          = 'ONO';
    const OBLIGATORY_LESSONS     = 'LES';
    const OBLIGATORY_MODULE      = 'MOD';

    const SALE_PAGE_TYPE_DEFAULT = 'DEF';
    const SALE_PAGE_TYPE_CUSTOM  = 'CUS';
    const SALE_PAGE_TYPE_FUNNEL  = 'FUN';

    const PAY_CURR_EUR           = 'EUR';
    const PAY_CURR_USD           = 'USD';
    const PAY_CURR_CNY           = 'CNY';

    const PAY_TYPE_ONE           = 'ONE';
    const PAY_TYPE_SUBSCRIBE     = 'SUB';

    protected $nameField;
    protected $descriptionField;
    protected $slugField;
    protected $subjectField;
    protected $levelField;
    protected $typeField;
    protected $imgField;
    protected $isPrivateField;
    protected $obligatoryField;
    protected $limitField;
    protected $isPublicField;
    protected $salePageTypeField;
    protected $salePageTextField;
    protected $salePageProductIdField;
    protected $isThanksPageUpdateField;
    protected $salePageUrlField;
    protected $funnelIdField;
    protected $priceField;
    protected $payCurrField;
    protected $payTypeField;
    protected $upsellFunnelIdField;
    protected $isFreeField;

    protected $academy;
    protected $group;
    protected $relatedCourses;

    protected $type = 'courses';

    protected function getRelationshipsData() : array
    {
        $result = [];

        if ($academy = $this->getAcademy()) {
            $result = ArrayUtils::merge($result, $academy);
        }

        if ($group = $this->getGroup()) {
            $result = ArrayUtils::merge($result, $group);
        }

        if ($relatedCourses = $this->getRelatedCourses()) {
            $result = ArrayUtils::merge($result, $relatedCourses);
        }

        return $result;
    }

    protected function getAttributesData() : array
    {
        return [
            'name' => $this->getNameField(),
            'slug' => $this->getSlugField(),
            'description' => $this->getDescriptionField(),
            'subject' => $this->getSubjectField(),
            'level' => $this->getLevelField(),
            'type' => $this->getTypeField(),
            'img' => $this->getImgField(),
            'is-private' => $this->getIsPrivateField(),
            'obligatory' => $this->getObligatoryField(),
            'limit' => $this->getLimitField(),
            'is-public' => $this->getIsPublicField(),
            'sale-page-type' => $this->getSalePageTypeField(),
            'sale-page-text' => $this->getSalePageTextField(),
            'sale-page-product-id' => $this->getSalePageProductIdField(),
            'is-thanks-page-update' => $this->getIsThanksPageUpdateField(),
            'sale-page-url' => $this->getSalePageUrlField(),
            'funnel-id' => $this->getFunnelIdField(),
            'price' => $this->getPriceField(),
            'pay-curr' => $this->getPayCurrField(),
            'pay-type' => $this->getPayTypeField(),
            'upsell-funnel-id' => $this->getUpsellFunnelIdField(),
            'is-free' => $this->getIsFreeField(),
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
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param string $type
     * @param string $id
     * @return self
     */
    public function setGroup(string $type, string $id): self
    {
        $this->group = $this->setOneRelation($type, $id);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRelatedCourses()
    {
        return $this->relatedCourses;
    }

    /**
     * @param string $type
     * @param array $ids
     * @return self
     */
    public function setRelatedCourses(string $type, array $ids): self
    {
        $this->relatedCourses = $this->setManyRelation($type, $ids);

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
    public function getLevelField()
    {
        return $this->levelField ?? $this->faker->numberBetween(1, 10);
    }

    /**
     * @param mixed $levelField
     * @return self
     */
    public function setLevelField($levelField): self
    {
        $this->levelField = $levelField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlugField()
    {
        return $this->slugField ?? $this->faker->slug($this->faker->numberBetween(1, 4));
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

    /**
     * @return mixed
     */
    public function getSubjectField()
    {
        return $this->subjectField ?? $this->faker->sentence($this->faker->numberBetween(1, 5));
    }

    /**
     * @param mixed $subjectField
     * @return self
     */
    public function setSubjectField($subjectField): self
    {
        $this->subjectField = $subjectField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTypeField()
    {
        return $this->typeField ?? $this->faker->randomElement([
                self::TYPE_DRAFT,
                self::TYPE_PUBLISHED
            ]);
    }

    /**
     * @param mixed $typeField
     * @return self
     */
    public function setTypeField($typeField): self
    {
        $this->typeField = $typeField;

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
     * @return self
     */
    public function setImgField($imgField): self
    {
        $this->imgField = $imgField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsPrivateField()
    {
        return (int) ($this->isPrivateField ?? $this->faker->boolean());
    }

    /**
     * @param mixed $isPrivateField
     * @return self
     */
    public function setIsPrivateField($isPrivateField): self
    {
        $this->isPrivateField = $isPrivateField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getObligatoryField()
    {
        return $this->obligatoryField ?? $this->faker->randomElement([
                self::OBLIGATORY_LESSONS,
                self::OBLIGATORY_MODULE,
                self::OBLIGATORY_NO
            ]);
    }

    /**
     * @param mixed $obligatoryField
     * @return self
     */
    public function setObligatoryField($obligatoryField): self
    {
        $this->obligatoryField = $obligatoryField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLimitField()
    {
        return $this->limitField ?? $this->faker->numberBetween(0, 100);
    }

    /**
     * @param mixed $limitField
     * @return self
     */
    public function setLimitField($limitField): self
    {
        $this->limitField = $limitField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsPublicField()
    {
        return (int) ($this->isPublicField ?? $this->faker->boolean());
    }

    /**
     * @param mixed $isPublicField
     * @return self
     */
    public function setIsPublicField($isPublicField): self
    {
        $this->isPublicField = $isPublicField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSalePageTypeField()
    {
        return $this->salePageTypeField ?? $this->faker->randomElement([
                self::SALE_PAGE_TYPE_CUSTOM,
                self::SALE_PAGE_TYPE_DEFAULT,
                self::SALE_PAGE_TYPE_FUNNEL
            ]);
    }

    /**
     * @param mixed $salePageTypeField
     * @return self
     */
    public function setSalePageTypeField($salePageTypeField): self
    {
        $this->salePageTypeField = $salePageTypeField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSalePageTextField()
    {
        return $this->salePageTextField ?? $this->faker->realText(500);
    }

    /**
     * @param mixed $salePageTextField
     * @return self
     */
    public function setSalePageTextField($salePageTextField): self
    {
        $this->salePageTextField = $salePageTextField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpsellFunnelIdField()
    {
        return $this->upsellFunnelIdField ?? $this->faker->uuid;
    }

    /**
     * @param mixed $upsellFunnelIdField
     * @return self
     */
    public function setUpsellFunnelIdField($upsellFunnelIdField): self
    {
        $this->upsellFunnelIdField = $upsellFunnelIdField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsFreeField()
    {
        return (int) ($this->isFreeField ?? $this->faker->boolean());
    }

    /**
     * @param mixed $isFreeField
     * @return self
     */
    public function setIsFreeField($isFreeField): self
    {
        $this->isFreeField = $isFreeField;

        return $this;
    }
}