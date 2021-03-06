<?php
namespace PortlandLabs\Concrete5\MigrationTool\Publisher\Routine;

use PortlandLabs\Concrete5\MigrationTool\Batch\BatchInterface;

defined('C5_EXECUTE') or die("Access Denied.");

class CreateConfigValuesRoutine extends AbstractRoutine
{
    public function execute(BatchInterface $batch)
    {
        $values = $batch->getObjectCollection('config_value');

        if (!$values) {
            return;
        }

        foreach ($values->getValues() as $value) {
            if (!$value->getPublisherValidator()->skipItem()) {
                $pkg = null;
                if ($value->getPackage()) {
                    $pkg = \Package::getByHandle($value->getPackage());
                }
                if (is_object($pkg)) {
                    \Config::save($pkg->getPackageHandle() . '::' . $value->getConfigKey(), $value->getConfigValue());
                } else {
                    \Config::save($value->getConfigKey(), $value->getConfigValue());
                }
            }
        }
    }
}
