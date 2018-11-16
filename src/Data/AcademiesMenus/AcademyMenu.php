<?php

namespace App\Data\AcademiesMenus;

use App\Data\Base;
use Zend\Stdlib\ArrayUtils;

class AcademyMenu extends Base
{
    const TYPE_HEADER = 'HED';
    const TYPE_FOOTER = 'FOT';
    const TYPE_LOGIN  = 'LOG';

    protected $academy;
    protected $pageType;

    protected $type = 'academies-menus';

    protected $nameField;
    protected $typeField;

    protected function getAttributesData() : array
    {
        return [
            'name' => $this->getNameField(),
            'type' => $this->getTypeField()
        ];
    }

    protected function getRelationshipsData() : array
    {
        $result = [];

        if ($academy = $this->getAcademy()) {
            $result = ArrayUtils::merge($result, $academy);
        }

        if ($pageType = $this->getPageType()) {
            $result = ArrayUtils::merge($result, $pageType);
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
    public function getNameField()
    {
        return $this->nameField ?? $this->faker->words();
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
    public function getTypeField()
    {
        return $this->typeField ?? $this->faker->randomElement([
                self::TYPE_FOOTER,
                self::TYPE_HEADER,
                self::TYPE_LOGIN
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
}