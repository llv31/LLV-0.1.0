<?php
/**
 * PHP Class Cms.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 27/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Services_Cms
{

    /** @var $_entity Llv_Entity_Cms */
    protected static $_entity;
    /** @var Llv_Entity_Uploader */
    protected static $_uploaderEntity;

    /**
     * @return \Llv_Entity_Cms
     */
    public static function getEntity()
    {
        return self::$_entity;
    }

    /**
     * @return \Llv_Entity_Uploader
     */
    public static function getUploaderEntity()
    {
        return self::$_uploaderEntity;
    }

    /**
     *
     */
    public function __construct($entity = null, $uploaderEntity = null)
    {
        if (is_null($entity)) {
            self::$_entity = new Llv_Entity_Cms();
        } elseif ($entity instanceof Llv_Entity_Cms_Interface) {
            self::$_entity = $entity;
        } else {
            throw new InvalidArgumentException(_('ERROR_EXCEPTION_INVALIDARGUMENT'));
        }

        if (is_null($uploaderEntity)) {
            self::$_uploaderEntity = new Llv_Entity_Uploader();
        } elseif ($uploaderEntity instanceof Llv_Entity_Uploader_Interface) {
            self::$_uploaderEntity = $uploaderEntity;
        } else {
            throw new InvalidArgumentException(_('ERROR_EXCEPTION_INVALIDARGUMENT'));
        }
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    public function pageGetRow(
        Llv_Services_Message_Header $header,
        Llv_Services_Cms_Request_Page $request
    )
    {
        $message = new Llv_Services_Cms_Message_Page();
        try {
            $entityFilter = new Llv_Entity_Cms_Request_Page();
            $entityFilter->id = $request->id;
            $entityFilter->idLangue = $request->idLangue;
            $message->page = $this->getEntity()->pageGetRow($entityFilter);
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /**
     * @param Llv_Services_Message_Header   $header
     * @param Llv_Services_Cms_Request_Page $request
     *
     * @return Llv_Services_Cms_Message_Page
     */
    public function pageUpdateRow(
        Llv_Services_Message_Header $header,
        Llv_Services_Cms_Request_Page $request
    )
    {
        $message = new Llv_Services_Cms_Message_Page();
        try {
            $entityFilter = new Llv_Entity_Cms_Request_Page();
            $entityFilter->id = $request->id;
            $entityFilter->idLangue = $request->idLangue;
            $entityFilter->title = $request->title;
            $entityFilter->content = $request->content;
            $entityFilter->url = $request->url;
            $entityFilter->dateAdd = $request->dateAdd;
            $entityFilter->dateUpdate = $request->dateUpdate;
            $entityFilter->dateDelete = $request->dateDelete;
            $this->getEntity()->pageUpdateRow($entityFilter);
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Services_Message_Header        $header
     * @param Llv_Services_Cms_Request_Carrousel $request
     *
     * @return Llv_Services_Cms_Message_Carrousel
     */
    public function carrouselAddRow(
        Llv_Services_Message_Header $header,
        Llv_Services_Cms_Request_Carrousel $request
    )
    {
        $message = new Llv_Services_Cms_Message_Carrousel();
        try {
            $file = new Llv_Dto_File();
            $file->filename = $request->filename;
            $file->tmpName = $request->tmpName;
            $file->error = $request->error;
            if ($file->error == UPLOAD_ERR_OK) {
                $filename = $this->getUploaderEntity()->moveFile(
                    $file,
                    Llv_Services_Cms_Helper_Carrousel::getCarrouselFilesPath()
                );
                if (!is_null($filename)) {
                    $entityFilter = new Llv_Entity_Cms_Request_Carrousel();
                    $entityFilter->filename = $filename;
                    $entityFilter->originalFilename = $request->filename;
                    $entityFilter->mimeType = $request->mimeType;
                    $entityFilter->size = $request->size;
                    $entityFilter->dateAdd = new DateTime();
                    $entityFilter->dateUpdate = new DateTime();
                    $entityFilter->dateDelete = null;
                    if (!is_null($this->getEntity()->carrouselAddRow($entityFilter))) {
                        $message->success = true;
                    }
                }
                if (!$message->success) {
                    unlink(Llv_Services_Cms_Helper_Carrousel::getCarrouselFilesPath() . $filename);
                }
            }
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /**
     * @param Llv_Services_Message_Header       $header
     * @param Llv_Services_Cms_Filter_Carrousel $filter
     *
     * @return Llv_Services_Cms_Message_Carrousel
     */
    public function carrouselGetList(
        Llv_Services_Message_Header $header,
        Llv_Services_Cms_Filter_Carrousel $filter
    )
    {
        $message = new Llv_Services_Cms_Message_Carrousel();
        try {
            $entityFilter = new Llv_Entity_Cms_Filter_Carrousel();
            if (isset($filter->online)) {
                $entityFilter->online = $filter->online;
            }
            if (isset($filter->includeDeleted)) {
                $entityFilter->includeDeleted = $filter->includeDeleted;
            }
            $message->carrousels = $this->getEntity()->carrouselGetList($entityFilter);
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /**
     * @param Llv_Services_Message_Header        $header
     * @param Llv_Services_Cms_Request_Carrousel $request
     *
     * @return Llv_Services_Cms_Message_Carrousel
     */
    public function carrouselDeleteRow(
        Llv_Services_Message_Header $header,
        Llv_Services_Cms_Request_Carrousel $request
    )
    {
        $message = new Llv_Services_Cms_Message_Carrousel();
        try {
            $entityFilter = new Llv_Entity_Cms_Request_Carrousel();
            $entityFilter->id = $request->id;
            $this->getEntity()->carrouselDeleteRow($entityFilter);
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }
}