<?php
namespace PortlandLabs\Concrete5\MigrationTool\Entity\Import\Conversation;

use Doctrine\Common\Collections\ArrayCollection;
use PortlandLabs\Concrete5\MigrationTool\Entity\Import\ObjectCollection;
use PortlandLabs\Concrete5\MigrationTool\Batch\Formatter\ObjectCollection\ConversationRatingTypeFormatter;
use PortlandLabs\Concrete5\MigrationTool\Batch\Validator\ValidatorInterface;

/**
 * @Entity
 */
class RatingTypeObjectCollection extends ObjectCollection
{
    /**
     * @OneToMany(targetEntity="\PortlandLabs\Concrete5\MigrationTool\Entity\Import\Conversation\RatingType", mappedBy="collection", cascade={"persist", "remove"})
     **/
    public $types;

    public function __construct()
    {
        $this->types = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getTypes()
    {
        return $this->types;
    }

    public function getFormatter()
    {
        return new ConversationRatingTypeFormatter($this);
    }

    public function getType()
    {
        return 'conversation_rating_type';
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

    public function getRecordValidator(ValidatorInterface $batch)
    {
        return false;
    }
}
