<?php
/**
 * Resolve creating custom db table during install and mods on upgrade.
 *
 * @package logpagenotfound
 * @subpackage build
 */
if ($object->xpdo) {
    $modx =& $object->xpdo;
    $modelPath = $modx->getOption('logpagenotfound.core_path',null,$modx->getOption('core_path').'components/logpagenotfound/').'model/';
    $modx->log(xPDO::LOG_LEVEL_INFO,'adding logpagenotfound package...');
    $modx->addPackage('logpagenotfound',$modelPath);
    $manager = $modx->getManager();

    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
            $manager->createObjectContainer('pageNotFound');
            $modx->log(xPDO::LOG_LEVEL_INFO,'LogPageNotFound table created');
            break;

        case xPDOTransport::ACTION_UPGRADE:
            break;
    }
}
return true;