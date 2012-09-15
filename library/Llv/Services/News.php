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
    public function newsGetOne(
        Llv_Services_Message_Header $header,
        Llv_Services_News_Filter_News $filter
    )
    {
        $message = new Llv_Services_News_Message_News();
        try {
            $entityFilter = new Llv_Entity_News_Filter_News();
            $entityFilter->id = $filter->id;
            $actualite = $this->getEntity()->newsGetOne($entityFilter);
            /** On ajoute la catégorie */
            $categoryFilter = new Llv_Services_News_Filter_Category();
            $categoryFilter->id = $actualite->category->id;
            $categorie = $this->categoryGetOne($header, $categoryFilter);
            $actualite->category = $categorie->categorie;
            $message->actualite = $actualite;
            $message->success = true;
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
    public function newsGetAll(
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
            $actualites = $this->getEntity()->newsGetAll($entityFilter);
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