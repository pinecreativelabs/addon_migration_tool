<?php
namespace PortlandLabs\Concrete5\MigrationTool\Publisher\Routine;

use Concrete\Core\Page\Type\Type;
use PortlandLabs\Concrete5\MigrationTool\Batch\BatchInterface;
use PortlandLabs\Concrete5\MigrationTool\Entity\Import\Batch;

defined('C5_EXECUTE') or die("Access Denied.");

class CreatePageStructureRoutineAction extends AbstractPageAction
{
    public function execute(BatchInterface $batch)
    {
        $batchParent = $this->getBatchParentPage($batch);
        if (!is_object($batchParent)) {
            // First, create the top level page for the batch.
            $batches = \Page::getByPath('/!import_batches');
            $type = Type::getByHandle('import_batch');
            $batchParent = $batches->add($type, array(
                'cName' => $batch->getID(),
                'cHandle' => $batch->getID(),
                'pkgID' => \Package::getByHandle('migration_tool')->getPackageID(),
            ));
        }

        $data = array();
        $page = $this->page;

        $ui = $this->getTargetItem($batch, 'user', $page->getUser());
        if ($ui != '') {
            $data['uID'] = $ui->getUserID();
        } else {
            $data['uID'] = USER_SUPER_ID;
        }
        $cDatePublic = $page->getPublicDate();
        if ($cDatePublic) {
            $data['cDatePublic'] = $cDatePublic;
        }

        $type = $this->getTargetItem($batch, 'page_type', $page->getType());
        if ($type) {
            $data['ptID'] = $type->getPageTypeID();
        }
        $template = $this->getTargetItem($batch, 'page_template', $page->getTemplate());
        if (is_object($template)) {
            $data['pTemplateID'] = $template->getPageTemplateID();
        }
        if ($page->getPackage()) {
            $pkg = \Package::getByHandle($page->getPackage());
            if (is_object($pkg)) {
                $data['pkgID'] = $pkg->getPackageID();
            }
        }

        // TODO exception if parent not found
        if ($page->getBatchPath() != '') {
            $lastSlash = strrpos($page->getBatchPath(), '/');
            $parentPath = substr($page->getBatchPath(), 0, $lastSlash);
            $data['cHandle'] = substr($page->getBatchPath(), $lastSlash + 1);
            if (!$parentPath) {
                $parent = $batchParent;
            } else {
                $parent = \Page::getByPath('/!import_batches/' . $batch->getID() . $parentPath);
            }
        } else {
            $parent = $batchParent;
        }

        $data['name'] = $page->getName();
        $data['cDescription'] = $page->getDescription();

        $parent->add($type, $data);
    }
}
