<?php
/**
 * PHP Class Files.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 28/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Services_Referential_Helper_Files
{
    /**
     * Retourne le chemin vers les fichiers uploadés
     *
     * @static
     * @return mixed
     */
    public static function getUploadPath()
    {
        return Llv_Config::getInstance()->project->path->files->upload;
    }
    /**
     * Retourne l'url vers les fichiers uploadés
     *
     * @static
     * @return mixed
     */
    public static function getUploadUrl()
    {
        return Llv_Config::getInstance()->project->url->files->upload;
    }

    /**
     * Retourne le chemin vers les fichiers à dowloader
     *
     * @static
     * @return mixed
     */
    public static function getDownloadPath()
    {
        return Llv_Config::getInstance()->project->path->files->download;
    }

    /**
     * Retourne l'url vers les fichiers à dowloader
     *
     * @static
     * @return mixed
     */
    public static function getDownloadUrl()
    {
        return Llv_Config::getInstance()->project->url->files->download;
    }
}