<?php
/**
 * PHP Class BuildDesignUrl.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 22/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class App_View_Helper_BuildDesignUrl
    extends Zend_View_Helper_Abstract
{
    const DESIGN_DIR_PATH = 'public/design';
    const DESIGN_DEFAULT_DIR_PATH = 'default';
    const DESIGN_DEFAULT_LANGUAGE_PATH = 'default';

    /**
     * Retourne l'url vers le fichier à inclure
     *
     * @param $filePath
     *
     * @return null|string
     */
    public function buildDesignUrl($filePath)
    {
        $root = realpath(APPLICATION_PATH . '/../');
        $dirs = array();
        $dirs[0] = self::DESIGN_DIR_PATH;
        $dirs[1] = Llv_Context_Application::getInstance()->getActiveModule();
        $dirs[2] = Llv_Context_Application::getInstance()->getLocale()->toString();

        if (!file_exists($root . '/' . implode('/', $dirs) . '/' . $filePath)) {
            $dirs[2] = self::DESIGN_DEFAULT_LANGUAGE_PATH;
            if (!file_exists($root . '/' . implode('/', $dirs) . '/' . $filePath)) {
                $dirs[1] = self::DESIGN_DEFAULT_DIR_PATH;
                if (!file_exists($root . '/' . implode('/', $dirs) . '/' . $filePath)) {
                    return null;
                }
            }
        }
        return $this->view->baseUrl() . implode('/', $dirs) . '/' . $filePath;
    }
}