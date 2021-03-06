<?php

namespace App\Data\ThemesPagesTemplates;

use App\Data\Base;
use Zend\Stdlib\ArrayUtils;

class ThemePageTemplate extends Base
{
    protected $theme;
    protected $pageType;
    protected $type = 'themes-pages-templates';

    protected $ordField;
    protected $templateIdField;
    protected $isSingleField;

    protected function getAttributesData() : array
    {
        return [
            'ord' => $this->getOrdField(),
            'template-id' => $this->getTemplateIdField(),
            'is-single' => $this->getIsSingleField()
        ];
    }

    protected function getRelationshipsData() : array
    {
        $result = [];

        if ($theme = $this->getTheme()) {
            $result = ArrayUtils::merge($result, $theme);
        }

        if ($pageType = $this->getPageType()) {
            $result = ArrayUtils::merge($result, $pageType);
        }

        return $result;
    }

    /**
     * @return mixed
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @param string $type
     * @param string $id
     * @return self
     */
    public function setTheme(string $type, string $id): self
    {
        $this->theme = $this->setOneRelation($type, $id);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPageType()
    {
        return $this->pageType;
    }

    /**
     * @param string $type
     * @param string $id
     * @return self
     */
    public function setPageType(string $type, string $id): self
    {
        $this->pageType = $this->setOneRelation($type, $id);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrdField()
    {
        return $this->ordField ?? $this->faker->numberBetween(0, 20);
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
    public function getTemplateIdField()
    {
        return $this->templateIdField ?? $this->faker->uuid;
    }

    /**
     * @param mixed $templateIdField
     * @return self
     */
    public function setTemplateIdField($templateIdField): self
    {
        $this->templateIdField = $templateIdField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsSingleField()
    {
        return (int) ($this->isSingleField ?? $this->faker->boolean);
    }

    /**
     * @param mixed $isSingleField
     * @return self
     */
    public function setIsSingleField($isSingleField): self
    {
        $this->isSingleField = $isSingleField;

        return $this;
    }


}