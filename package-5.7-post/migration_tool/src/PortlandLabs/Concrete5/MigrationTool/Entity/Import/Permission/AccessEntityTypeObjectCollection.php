<?php

namespace PortlandLabs\Concrete5\MigrationTool\Entity\Import\Permission;

use Doctrine\Common\Collections\ArrayCollection;
use PortlandLabs\Concrete5\MigrationTool\Entity\Import\ObjectCollection;
use PortlandLabs\Concrete5\MigrationTool\Importer\ContentType\Formatter\AttributeKeyCategoryFormatter;
use PortlandLabs\Concrete5\MigrationTool\Importer\ContentType\Formatter\BlockTypeFormatter;
use PortlandLabs\Concrete5\MigrationTool\Importer\ContentType\Formatter\ConversationEditorFormatter;
use PortlandLabs\Concrete5\MigrationTool\Importer\ContentType\Formatter\PageTemplateFormatter;
use PortlandLabs\Concrete5\MigrationTool\Importer\ContentType\Formatter\PermissionAccessEntityTypeFormatter;

/**
 * @Entity
 */
class AccessEntityTypeObjectCollection extends ObjectCollection
{

    /**
     * @OneToMany(targetEntity="AccessEntityType", mappedBy="collection", cascade={"persist", "remove"})
     **/
    public $types;

    public function __construct()
    {
        $this->types = new ArrayCollection();
    }

    public function getFormatter()
    {
        return new PermissionAccessEntityTypeFormatter($this);
    }

    /**
     * @return mixed
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @param mixed $types
     */
    public function setTypes($types)
    {
        $this->types = $types;
    }


    public function getType()
    {
        return 'permission_access_entity_type';
    }

    public function hasRecords()
    {
        return count($this->getTypes());
    }

    public function getRecords()
    {
        return $this->getTypes();
    }

    public function getTreeFormatter()
    {
        return false;
    }

    public function getRecordValidator()
    {
        return false;
    }





}