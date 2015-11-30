<?php

namespace PortlandLabs\Concrete5\MigrationTool\Importer\CIF\Element;

use PortlandLabs\Concrete5\MigrationTool\Entity\Import\AttributeTypeObjectCollection;
use PortlandLabs\Concrete5\MigrationTool\Entity\Import\BlockTypeSetObjectCollection;
use PortlandLabs\Concrete5\MigrationTool\Importer\CIF\ElementInterface;
use PortlandLabs\Concrete5\MigrationTool\Entity\Import\AttributeType as CoreAttributeType;
use PortlandLabs\Concrete5\MigrationTool\Importer\CIF\ElementParserInterface;

defined('C5_EXECUTE') or die("Access Denied.");

class BlockTypeSet implements ElementParserInterface
{

    public function getObjectCollection(\SimpleXMLElement $element)
    {
        $collection = new BlockTypeSetObjectCollection();
        if ($element->blocktypesets) {
            foreach($element->blocktypesets->blocktypeset as $node) {
                $type = new \PortlandLabs\Concrete5\MigrationTool\Entity\Import\BlockTypeSet();
                $type->setHandle((string) $node['handle']);
                $type->setName((string) $node['name']);
                $type->setPackage((string) $node['package']);
                $types = array();
                if ($node->blocktype) {
                    foreach($node->blocktype as $cn) {
                        $types[] = (string) $cn['handle'];
                    }
                }
                $type->setTypes($types);
                $collection->getSets()->add($type);
                $type->setCollection($collection);
            }
        }
        return $collection;
    }

}