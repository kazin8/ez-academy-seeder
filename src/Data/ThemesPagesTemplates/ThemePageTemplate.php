<?php

namespace App\Data\ThemesPagesTemplates;

use App\Data\Base;

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
        if ($this->theme) {
            $result[$this->theme['type']]['data'] = $this->theme;
        }

        if ($this->pageType) {
            $result[$this->pageType['type']]['data'] = $this->pageType;
        }

        return $result;
    }

    public function setTheme($theme)
    {
        $this->theme = $theme;
    }

    public function setPageType($pageType)
    {
        $this->pageType = $pageType;
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