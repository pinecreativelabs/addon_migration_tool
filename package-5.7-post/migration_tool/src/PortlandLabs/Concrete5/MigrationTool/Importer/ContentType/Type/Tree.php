<?php

namespace PortlandLabs\Concrete5\MigrationTool\Importer\ContentType\Type;

use PortlandLabs\Concrete5\MigrationTool\Entity\Import\Area;
use PortlandLabs\Concrete5\MigrationTool\Entity\Import\Attribute;
use PortlandLabs\Concrete5\MigrationTool\Entity\Import\BannedWordObjectCollection;
use PortlandLabs\Concrete5\MigrationTool\Entity\Import\Block;
use PortlandLabs\Concrete5\MigrationTool\Entity\Import\CaptchaObjectCollection;
use PortlandLabs\Concrete5\MigrationTool\Entity\Import\ContentEditorSnippetObjectCollection;
use PortlandLabs\Concrete5\MigrationTool\Entity\Import\Conversation\FlagType;
use PortlandLabs\Concrete5\MigrationTool\Entity\Import\Conversation\FlagTypeObjectCollection;
use PortlandLabs\Concrete5\MigrationTool\Entity\Import\PageAttribute;
use PortlandLabs\Concrete5\MigrationTool\Entity\Import\PageObjectCollection;
use PortlandLabs\Concrete5\MigrationTool\Entity\Import\PageTemplate as CorePageTemplate;
use PortlandLabs\Concrete5\MigrationTool\Entity\Import\PageTemplateObjectCollection;
use PortlandLabs\Concrete5\MigrationTool\Entity\Import\SocialLinkObjectCollection;
use PortlandLabs\Concrete5\MigrationTool\Entity\Import\ThemeObjectCollection;
use PortlandLabs\Concrete5\MigrationTool\Entity\Import\TreeNode;
use PortlandLabs\Concrete5\MigrationTool\Entity\Import\TreeObjectCollection;
use PortlandLabs\Concrete5\MigrationTool\Entity\Import\Workflow\Type;
use PortlandLabs\Concrete5\MigrationTool\Entity\Import\Workflow\TypeObjectCollection;
use PortlandLabs\Concrete5\MigrationTool\Importer\ContentType\TypeInterface;

defined('C5_EXECUTE') or die("Access Denied.");

class Tree implements TypeInterface
{

    public function getObjectCollection(\SimpleXMLElement $element)
    {
        $collection = new TreeObjectCollection();
        if ($element->trees->tree) {
            foreach($element->trees->tree as $node) {
                $tree = new \PortlandLabs\Concrete5\MigrationTool\Entity\Import\Tree();
                $tree->setType((string) $node['type']);
                foreach($node->children() as $child) {
                    $n = new TreeNode();
                    $n->setTitle((string) $child['name']);
                    $n->setTree($tree);
                    $tree->getNodes()->add($n);
                }
                $collection->getTrees()->add($tree);
                $tree->setCollection($collection);
            }
        }
        return $collection;
    }
}