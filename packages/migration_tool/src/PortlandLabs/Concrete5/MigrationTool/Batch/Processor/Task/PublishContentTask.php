<?php
namespace PortlandLabs\Concrete5\MigrationTool\Batch\Processor\Task;

use Concrete\Core\Foundation\Processor\ActionInterface;
use Concrete\Core\Foundation\Processor\TaskInterface;

defined('C5_EXECUTE') or die("Access Denied.");

class PublishContentTask implements TaskInterface
{
    public function execute(ActionInterface $action)
    {
        $target = $action->getTarget();
        $subject = $action->getSubject();

        // Since batch is serialized we do this:
        $em = \Database::connection()->getEntityManager();
        $batch = $em->getRepository('PortlandLabs\Concrete5\MigrationTool\Entity\Import\Batch')->findOneById($target->getBatch()->getId());

        $subject->execute($batch);
    }

    public function finish(ActionInterface $action)
    {
        return;
    }
}
