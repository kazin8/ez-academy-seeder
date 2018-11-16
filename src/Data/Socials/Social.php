<?php

namespace App\Data\Socials;

use App\Data\Base;
use Zend\Stdlib\ArrayUtils;

class Social extends Base
{
    protected $type = 'socials';

    protected $academy;

    protected $labelField;
    protected $subLabelField;
    protected $urlField;
    protected $imgField;
    protected $ordField;
    protected $isActiveField;
    protected $typeField;

    protected function getAttributesData() : array
    {
        return [
            'label' => $this->getLabelField(),
            'sub-label' => $this->getSubLabelField(),
            'url' => $this->getUrlField(),
            'img' => $this->getImgField(),
            'ord' => $this->getOrdField(),
            'is-active' => $this->getIsActiveField()
        ];
    }

    protected function getRelationshipsData() : array
    {
        $result = [];
        if ($academy = $this->getAcademy()) {
            $result = ArrayUtils::merge($result, $academy);
        }

        return $result;
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
    public function getLabelField()
    {
        return $this->labelField ?? $this->faker->sentence(2);
    }

    /**
     * @param mixed $labelField
     * @return self
     */
    public function setLabelField($labelField): self
    {
        $this->labelField = $labelField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubLabelField()
    {
        return $this->subLabelField ?? $this->faker->sentence();
    }

    /**
     * @param mixed $subLabelField
     * @return self
     */
    public function setSubLabelField($subLabelField): self
    {
        $this->subLabelField = $subLabelField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrlField()
    {
        return $this->urlField ?? $this->faker->url;
    }

    /**
     * @param mixed $urlField
     * @return self
     */
    public function setUrlField($urlField): self
    {
        $this->urlField = $urlField;

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
}