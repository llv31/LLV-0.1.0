<?php
/**
 * PHP Class News.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 04/08/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Services_News
{
    /** @var $_entity Llv_Entity_News */
    protected static $_entity;
    /** @var Llv_Entity_Uploader */
    protected static $_uploaderEntity;

    /**
     * @return \Llv_Entity_News
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
            self::$_entity = new Llv_Entity_News();
        } elseif ($entity instanceof Llv_Entity_News_Interface) {
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

    /**
     * @param Llv_Services_Message_Header   $header
     * @param Llv_Services_News_Filter_News $filter
     *
     * @return Llv_Services_News_Message_News
     */
    public function getOne(
        Llv_Services_Message_Header $header,
        Llv_Services_News_Filter_News $filter
    )
    {
        $message = new Llv_Services_News_Message_News();
        try {
            $entityFilter = new Llv_Entity_News_Filter_News();
            $entityFilter->id = $filter->id;
            $entityFilter->idLangue = $filter->idLangue;
            $actualite = $this->getEntity()->getOne($entityFilter);
            if (!is_null($actualite->id)) {
                /** On ajoute la catégorie */
                $categoryFilter = new Llv_Services_News_Filter_Category();
                $categoryFilter->id = $actualite->category->id;
                $categorie = $this->categoryGetOne($header, $categoryFilter);
                $actualite->category = $categorie->categorie;
                $message->actualite = $actualite;
                $message->success = true;
            }
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /**
     * @param Llv_Services_Message_Header   $header
     * @param Llv_Services_News_Filter_News $filter
     *
     * @return Llv_Services_News_Message_News
     */
    public function getAll(
        Llv_Services_Message_Header $header,
        Llv_Services_News_Filter_News $filter
    )
    {
        $message = new Llv_Services_News_Message_News();
        try {
            $entityFilter = new Llv_Entity_News_Filter_News();
            if (isset($filter->online)) {
                $entityFilter->online = $filter->online;
            }
            $entityFilter->idLangue = $filter->idLangue;
            $actualites = $this->getEntity()->getAll($entityFilter);
            /** On ajoute les catégories */
            $result = array();
            foreach ($actualites as $actualite) {
                $categoryFilter = new Llv_Services_News_Filter_Category();
                $categoryFilter->id = $actualite->category->id;
                $categorie = $this->categoryGetOne($header, $categoryFilter);
                $actualite->category = $categorie->categorie;
                $result[] = $actualite;
            }
            $message->actualites = $result;
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /**
     * @param Llv_Services_Message_Header    $header
     * @param Llv_Services_News_Request_Edit $request
     *
     * @return Llv_Services_News_Message_News
     */
    public function editRow(
        Llv_Services_Message_Header $header,
        Llv_Services_News_Request_Edit $request
    )
    {
        $message = new Llv_Services_News_Message_News();
        try {
            $entityRequest = new Llv_Entity_News_Request_Edit();
            $entityRequest->id = isset($request->id)
                && !is_null($request->id)
                && !empty($request->id)
                ? $request->id
                : null;
            $entityRequest->idCategorie = $request->idCategorie;
            $entityRequest->position = $request->position;
            $entityRequest->online = $request->online;
            $entityRequest->coordonnees = $request->coordonnees;
            $entityRequest->dateAdd = $request->dateAdd;
            $entityRequest->dateUpdate = $request->dateUpdate;
            $entityRequest->dateDelete = $request->dateDelete;
            if (is_null($entityRequest->id)) {
                $message->idActualite = $this->getEntity()->addRow($entityRequest);
            } else {
                $this->getEntity()->updateRow($entityRequest);
            }
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Services_Message_Header   $header
     * @param Llv_Services_News_Filter_News $request
     *
     * @return Llv_Services_News_Message_News
     */
    public function getRowContent(
        Llv_Services_Message_Header $header,
        Llv_Services_News_Filter_News $request
    )
    {
        $message = new Llv_Services_News_Message_News();
        try {
            $entityRequest = new Llv_Entity_News_Filter_News();
            $entityRequest->id = $request->id;
            $entityRequest->idLangue = $request->idLangue;
            if (!is_null($entityRequest->id) && !is_null($entityRequest->idLangue)) {
                $this->getEntity()->getRowContent($entityRequest);
            }
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /**
     * @param Llv_Services_Message_Header           $header
     * @param Llv_Services_News_Request_EditContent $request
     *
     * @return Llv_Services_News_Message_News
     */
    public function editRowContent(
        Llv_Services_Message_Header $header,
        Llv_Services_News_Request_EditContent $request
    )
    {
        $message = new Llv_Services_News_Message_News();
        try {
            $entityRequest = new Llv_Entity_News_Request_EditContent();
            $entityRequest->idNews = isset($request->idNews)
                && !is_null($request->idNews)
                && !empty($request->idNews)
                ? $request->idNews
                : null;
            $entityRequest->idLangue = $request->idLangue;
            $entityRequest->lien = $request->lien;
            $entityRequest->content = $request->content;
            $entityRequest->title = $request->title;

            $filter = new Llv_Services_News_Filter_News();
            $filter->id = $request->idNews;
            $filter->idLangue = $request->idLangue;
            $result = $this->getOne($header, $filter);

            if (!$result->success) {
                $this->getEntity()->addRowContent($entityRequest);
            } else {
                $this->getEntity()->updateRowContent($entityRequest);
            }
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */
    /**
     * @param Llv_Services_Message_Header    $header
     * @param Llv_Services_News_Request_File $request
     *
     * @return Llv_Services_News_Message_File
     */
    public function addRowFile(
        Llv_Services_Message_Header $header,
        Llv_Services_News_Request_File $request
    )
    {
        $message = new Llv_Services_News_Message_File();
        try {
            $file = new Llv_Dto_File();
            $file->filename = $request->filename;
            $file->tmpName = $request->tmpName;
            $file->error = $request->error;
            if ($file->error == UPLOAD_ERR_OK) {
                $filename = $this->getUploaderEntity()->moveFile(
                    $file,
                    Llv_Services_News_Helper_News::getNewsFilesPath()
                );
                if (!is_null($filename)) {
                    $entityFilter = new Llv_Entity_News_Request_File();
                    $entityFilter->idNews = $request->idNews;
                    $entityFilter->filename = $filename;
                    $entityFilter->originalFilename = $request->filename;
                    $entityFilter->mimeType = $request->mimeType;
                    $entityFilter->size = $request->size;
                    $entityFilter->dateAdd = new DateTime();
                    $entityFilter->dateDelete = null;
                    if (!is_null($this->getEntity()->addRowFile($entityFilter))) {
                        $message->success = true;
                    }
                }
                if (!$message->success) {
                    unlink(Llv_Services_News_Helper_News::getNewsFilesPath() . $filename);
                }
            }
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /**
     * @param Llv_Services_Message_Header   $header
     * @param Llv_Services_News_Filter_File $filter
     *
     * @return Llv_Services_News_Message_File
     */
    public function getNewsFiles(
        Llv_Services_Message_Header $header,
        Llv_Services_News_Filter_File $filter
    )
    {
        $message = new Llv_Services_News_Message_File();
        try {
            /** On ajoute les illustrations */
            $entityFilter = new Llv_Entity_News_Filter_File();
            $entityFilter->idNews = $filter->idNews;
            $message->files = $this->getEntity()->getNewsFiles($entityFilter);
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Services_Message_Header       $header
     * @param Llv_Services_News_Filter_Category $filter
     *
     * @return Llv_Services_News_Message_Category
     */
    public function categoryGetOne(
        Llv_Services_Message_Header $header,
        Llv_Services_News_Filter_Category $filter
    )
    {
        $message = new Llv_Services_News_Message_Category();
        try {
            $entityFilter = new Llv_Entity_News_Filter_Category();
            $entityFilter->id = $filter->id;
            $message->categorie = $this->getEntity()->categoryGetOne($entityFilter);
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /**
     * @param Llv_Services_Message_Header       $header
     * @param Llv_Services_News_Filter_Category $filter
     *
     * @return Llv_Services_News_Message_Category
     */
    public function categoryGetAll(
        Llv_Services_Message_Header $header,
        Llv_Services_News_Filter_Category $filter
    )
    {
        $message = new Llv_Services_News_Message_Category();
        try {
            $entityFilter = new Llv_Entity_News_Filter_Category();
            if (isset($filter->online)) {
                $entityFilter->online = $filter->online;
            }
            $entityFilter->idLangue = $filter->idLangue;
            $message->categories = $this->getEntity()->categoryGetAll($entityFilter);
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }
}