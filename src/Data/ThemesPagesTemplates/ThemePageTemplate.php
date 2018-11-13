<?php

namespace App\Data\ThemesPagesTemplates;

use App\Data\Base;

class ThemePageTemplate extends Base
{
    protected $theme;
    protected $pageType;
    protected $type = 'themes-pages-templates';

    protected function getAttributesData() : array
    {
        return [
            'ord' => $this->faker->randomNumber(2),
            'template-id' => $this->faker->uuid,
            'is-single' => (int) $this->faker->boolean()
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
}