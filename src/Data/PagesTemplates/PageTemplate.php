<?php

namespace App\Data\PagesTemplates;

use App\Data\Base;
use Zend\Stdlib\ArrayUtils;

class PageTemplate extends Base
{
    protected $type = 'pages-templates';

    protected $theme;
    protected $pageType;
    protected $academy;

    protected $ordField;
    protected $templateIdField;
    protected $slugField;

    protected function getAttributesData() : array
    {
        return [
            'ord' => $this->getOrdField(),
            'template-id' => $this->getTemplateIdField(),
            'slug' => $this->getSlugField()
        ];
    }

    protected function getRelationshipsData() : array
    {
        $result = [];

        if ($academy = $this->getAcademy()) {
            $result = ArrayUtils::merge($result, $academy);
        }

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
    public function getSlugField()
    {
        return $this->slugField ?? $this->faker->slug(2);
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
}