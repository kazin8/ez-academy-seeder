<?php

namespace App\Data\ActionsTagsAdds;

use App\Data\Base;
use Zend\Stdlib\ArrayUtils;

class ActionTagAdd extends Base
{
    protected $action;

    protected $type = 'actions-tags-adds';

    protected $nameField;

    protected function getAttributesData() : array
    {
        return [
            'name' => $this->getNameField()
        ];
    }

    protected function getRelationshipsData() : array
    {
        $result = [];

        if ($action = $this->getAction()) {
            $result = ArrayUtils::merge($result, $action);
        }

        return $result;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param string $type
     * @param string $id
     * @return self
     */
    public function setAction(string $type, string $id): self
    {
        $this->action = $this->setOneRelation($type, $id);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNameField()
    {
        return $this->nameField ?? $this->faker->sentence();
    }

    /**
     * @param mixed $nameField
     * @return self
     */
    public function setNameField($nameField): self
    {
        $this->nameField = $nameField;
    }
}