<?php
/**
 * PHP Class Product.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 04/08/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Services_Product
{
    /** @var $_entity Llv_Entity_Product */
    protected static $_entity;
    /** @var Llv_Entity_Uploader */
    protected static $_uploaderEntity;

    /**
     * @return \Llv_Entity_Product
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
            self::$_entity = new Llv_Entity_Product();
        } elseif ($entity instanceof Llv_Entity_Product_Interface) {
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
     * @param Llv_Services_Message_Header           $header
     * @param Llv_Services_Product_Filter_Product   $filter
     *
     * @return Llv_Services_Product_Message_Product
     */
    public function getOne(
        Llv_Services_Message_Header $header,
        Llv_Services_Product_Filter_Product $filter
    )
    {
        $message = new Llv_Services_Product_Message_Product();
        try {
            $entityFilter = new Llv_Entity_Product_Filter_Product();
            $entityFilter->id = $filter->id;
            $entityFilter->idLangue = $filter->idLangue;
            $entityFilter->url = $filter->url;
            $entityFilter->onlineIllustration = $filter->onlineIllustration;
            $produit = $this->getEntity()->getOne($entityFilter);
            $message->product = $produit;
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /**
     * @param Llv_Services_Message_Header           $header
     * @param Llv_Services_Product_Filter_Product   $filter
     *
     * @return Llv_Services_Product_Message_Product
     */
    public function getAll(
        Llv_Services_Message_Header $header,
        Llv_Services_Product_Filter_Product $filter
    )
    {
        $message = new Llv_Services_Product_Message_Product();
        try {
            $entityFilter = new Llv_Entity_Product_Filter_Product();
            $entityFilter->idLangue = $filter->idLangue;
            $entityFilter->idCategory = $filter->idCategory;
            $entityFilter->exceptThisId = $filter->exceptThisId;
            $produits = $this->getEntity()->getAll($entityFilter);
            $message->products = $produits;
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /**
     * @param Llv_Services_Message_Header        $header
     * @param Llv_Services_Product_Request_Edit  $request
     *
     * @return Llv_Services_Product_Message_Product
     */
    public function editRow(
        Llv_Services_Message_Header $header,
        Llv_Services_Product_Request_Edit $request
    )
    {
        $message = new Llv_Services_Product_Message_Product();
        try {
            $entityRequest = new Llv_Entity_Product_Request_Edit();
            $entityRequest->id = isset($request->id)
                && !is_null($request->id)
                && !empty($request->id)
                ? $request->id
                : null;
            $entityRequest->idCategorie = $request->idCategorie;
            $entityRequest->position = $request->position;
            $entityRequest->url = $request->url;
            $entityRequest->availability = $request->availability;
            if (is_null($entityRequest->id)) {
                $message->idProduct = $this->getEntity()->addRow($entityRequest);
            } else {
                if (isset($request->moveUp)) {
                    $entityRequest->moveUp = $request->moveUp;
                }
                if (isset($request->show)) {
                    $entityRequest->show = $request->show;
                }
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
     * @param Llv_Services_Message_Header           $header
     * @param Llv_Services_Product_Filter_Product   $request
     *
     * @return Llv_Services_Product_Message_Product
     */
    public function getRowContent(
        Llv_Services_Message_Header $header,
        Llv_Services_Product_Filter_Product $request
    )
    {
        $message = new Llv_Services_Product_Message_Product();
        try {
            $entityRequest = new Llv_Entity_Product_Filter_Product();
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
     * @param Llv_Services_Message_Header               $header
     * @param Llv_Services_Product_Request_EditContent  $request
     *
     * @return Llv_Services_Product_Message_Product
     */
    public function editRowContent(
        Llv_Services_Message_Header $header,
        Llv_Services_Product_Request_EditContent $request
    )
    {
        $message = new Llv_Services_Product_Message_Product();
        try {
            $entityRequest = new Llv_Entity_Product_Request_EditContent();
            $entityRequest->idProduct = isset($request->idProduct)
                && !is_null($request->idProduct)
                && !empty($request->idProduct)
                ? $request->idProduct
                : null;
            $entityRequest->idLangue = $request->idLangue;
            $entityRequest->title = $request->title;
            $entityRequest->introduction = stripslashes($request->introduction);
            $entityRequest->content = stripslashes($request->content);

            $this->getEntity()->updateRowContent($entityRequest);
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */
    /**
     * @param Llv_Services_Message_Header        $header
     * @param Llv_Services_Product_Request_File  $request
     *
     * @return Llv_Services_Product_Message_File
     */
    public function addRowFile(
        Llv_Services_Message_Header $header,
        Llv_Services_Product_Request_File $request
    )
    {
        $message = new Llv_Services_Product_Message_File();
        try {
            Zend_Debug::dump($request);
            $file = new Llv_Dto_File();
            $file->filename = $request->filename;
            $file->tmpName = $request->tmpName;
            $file->error = $request->error;
            if ($file->error == UPLOAD_ERR_OK) {
                $filename = $this->getUploaderEntity()->moveFile(
                    $file,
                    Llv_Constant_File_Category::PRODUCTS
                );
                if (!is_null($filename)) {
                    $entityFilter = new Llv_Entity_Product_Request_File();
                    $entityFilter->idProduct = $request->idProduct;
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
                    $this->getUploaderEntity()->deleteFile(
                        $filename,
                        Llv_Constant_File_Category::PRODUCTS
                    );
                }
            }
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /**
     * @param Llv_Services_Message_Header       $header
     * @param Llv_Services_Product_Filter_File  $filter
     *
     * @return Llv_Services_Product_Message_File
     */
    public function getProductFiles(
        Llv_Services_Message_Header $header,
        Llv_Services_Product_Filter_File $filter
    )
    {
        $message = new Llv_Services_Product_Message_File();
        try {
            /** On ajoute les illustrations */
            $entityFilter = new Llv_Entity_Product_Filter_File();
            $entityFilter->idProduct = $filter->idProduct;
            $message->files = $this->getEntity()->getProductFiles($entityFilter);
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /**
     * @param Llv_Services_Message_Header        $header
     * @param Llv_Services_Product_Request_File  $request
     *
     * @return Llv_Services_Product_Message_File
     */
    public function updateRowFile(
        Llv_Services_Message_Header $header,
        Llv_Services_Product_Request_File $request
    )
    {
        $message = new Llv_Services_Product_Message_File();
        try {
            /** On ajoute les illustrations */
            $entityRequest = new Llv_Entity_Product_Request_File();
            $entityRequest->id = $request->id;
            if (isset($request->moveUp)) {
                $entityRequest->moveUp = $request->moveUp;
            }
            if (isset($request->show)) {
                $entityRequest->show = $request->show;
            }
            $message->file = $this->getEntity()->updateRowFile($entityRequest);
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /**
     * @param Llv_Services_Message_Header        $header
     * @param Llv_Services_Product_Request_File  $filter
     *
     * @return Llv_Services_Product_Message_File
     */
    public function deleteRowFile(
        Llv_Services_Message_Header $header,
        Llv_Services_Product_Request_File $filter
    )
    {
        $message = new Llv_Services_Product_Message_File();
        try {
            /** On ajoute les illustrations */
            $entityFilter = new Llv_Entity_Product_Filter_File();
            $entityFilter->id = $filter->id;
            $filename = $this->getEntity()->deleteRowFile($entityFilter);
            $this->getUploaderEntity()->deleteFile(
                $filename,
                Llv_Constant_File_Category::PRODUCTS
            );
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Services_Message_Header           $header
     * @param Llv_Services_Product_Filter_Category  $filter
     *
     * @return Llv_Services_Product_Message_Category
     */
    public function categoryGetOne(
        Llv_Services_Message_Header $header,
        Llv_Services_Product_Filter_Category $filter
    )
    {
        $message = new Llv_Services_Product_Message_Category();
        try {
            $entityFilter = new Llv_Entity_Product_Filter_Category();
            $entityFilter->id = $filter->id;
            $entityFilter->idLangue = $filter->idLangue;
            $entityFilter->route = $filter->route;
            $message->categorie = $this->getEntity()->categoryGetOne($entityFilter);
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /**
     * @param Llv_Services_Message_Header           $header
     * @param Llv_Services_Product_Filter_Category  $filter
     *
     * @return Llv_Services_Product_Message_Category
     */
    public function categoryGetAll(
        Llv_Services_Message_Header $header,
        Llv_Services_Product_Filter_Category $filter
    )
    {
        $message = new Llv_Services_Product_Message_Category();
        try {
            $entityFilter = new Llv_Entity_Product_Filter_Category();
            $entityFilter->idLangue = $filter->idLangue;
            $message->categories = $this->getEntity()->categoryGetAll($entityFilter);
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /**
     * @param Llv_Services_Message_Header               $header
     * @param Llv_Services_Product_Request_EditCategory $request
     *
     * @return Llv_Services_Product_Message_Category
     */
    public function categoryUpdateRow(
        Llv_Services_Message_Header $header,
        Llv_Services_Product_Request_EditCategory $request
    )
    {
        $message = new Llv_Services_Product_Message_Category();
        try {
            $entityRequest = new Llv_Entity_Product_Request_EditCategory();
            $entityRequest->id = isset($request->id)
                && !is_null($request->id)
                && !empty($request->id)
                ? $request->id
                : null;
            $entityRequest->coordonnees = $request->coordonnees;
            $entityRequest->pinColor = $request->pinColor;
            $entityRequest->princingType = $request->princingType;
//            $entityRequest->route = $request->route;
            $this->getEntity()->categoryUpdateRow($entityRequest);
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /**
     * @param Llv_Services_Message_Header                      $header
     * @param Llv_Services_Product_Request_EditCategoryContent $request
     *
     * @return Llv_Services_Product_Message_Category
     */
    public function categoryEditRowContent(
        Llv_Services_Message_Header $header,
        Llv_Services_Product_Request_EditCategoryContent $request
    )
    {
        $message = new Llv_Services_Product_Message_Category();
        try {
            $entityRequest = new Llv_Entity_Product_Request_EditCategoryContent();
            $entityRequest->idCategory = isset($request->idCategory)
                && !is_null($request->idCategory)
                && !empty($request->idCategory)
                ? $request->idCategory
                : null;
            $entityRequest->idLangue = isset($request->idLangue)
                && !is_null($request->idLangue)
                && !empty($request->idLangue)
                ? $request->idLangue
                : null;
            $entityRequest->type = $request->type;
            $entityRequest->title = $request->title;
            $entityRequest->content = $request->content;
            $this->getEntity()->categoryEditRowContent($entityRequest);
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /**
     * @param Llv_Services_Message_Header               $header
     * @param Llv_Services_Product_Request_File         $request
     *
     * @return Llv_Services_Product_Message_Category
     */
    public function categoryUpdateFile(
        Llv_Services_Message_Header $header,
        Llv_Services_Product_Request_File $request
    )
    {
        $message = new Llv_Services_Product_Message_Category();
        try {
            $file = new Llv_Dto_File();
            $file->filename = $request->filename;
            $file->tmpName = $request->tmpName;
            $file->error = $request->error;
            if ($file->error == UPLOAD_ERR_OK) {
                if (!$message->success) {
                    $this->getUploaderEntity()->deleteFile(
                        $request->id . '.jpg',
                        Llv_Constant_File_Category::PRODUCTS_CATEGORY
                    );
                }
                $this->getUploaderEntity()->moveFile(
                    $file,
                    Llv_Constant_File_Category::PRODUCTS_CATEGORY,
                    $request->id
                );
            }
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Services_Message_Header        $header
     * @param Llv_Services_Product_Filter_Season $filter
     *
     * @return Llv_Services_Product_Message_Week
     */
    public function weeksGetOne(
        Llv_Services_Message_Header $header,
        Llv_Services_Product_Filter_Season $filter
    )
    {
        $message = new Llv_Services_Product_Message_Week();
        try {
            $entityFilter = new Llv_Entity_Product_Filter_Season();
            $entityFilter->id = $filter->id;
            $entityFilter->idSeasonType = $filter->idSeasonType;
            $entityFilter->weekNumber = $filter->weekNumber;
            $entityFilter->dateDebut = $filter->dateDebut;
            $entityFilter->dateFin = $filter->dateFin;
            $message->week = $this->getEntity()->weeksGetOne($entityFilter);
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /**
     * @param Llv_Services_Message_Header        $header
     * @param Llv_Services_Product_Filter_Season $filter
     *
     * @return Llv_Services_Product_Message_Week
     */
    public function weeksGetAll(
        Llv_Services_Message_Header $header,
        Llv_Services_Product_Filter_Season $filter
    )
    {
        $message = new Llv_Services_Product_Message_Week();
        try {
            $entityFilter = new Llv_Entity_Product_Filter_Season();
            $entityFilter->dateDebut = $filter->dateDebut;
            $entityFilter->dateFin = $filter->dateFin;
            $message->weeks = $this->getEntity()->weeksGetAll($entityFilter);
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Services_Message_Header        $header
     * @param Llv_Services_Product_Filter_Season $filter
     *
     * @return Llv_Services_Product_Message_Week
     */
    public function seasonGetAll(
        Llv_Services_Message_Header $header,
        Llv_Services_Product_Filter_Season $filter
    )
    {
        $message = new Llv_Services_Product_Message_Week();
        try {
            $entityFilter = new Llv_Entity_Product_Filter_Season();
            $entityFilter->idLangue = $filter->idLangue;
//            $entityFilter->idSeasonType = $filter->idSeasonType;
            $message->weeks = $this->getEntity()->seasonGetAll($entityFilter);
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /**
     * @param Llv_Services_Message_Header         $header
     * @param Llv_Services_Product_Request_Season $request
     *
     * @return Llv_Services_Product_Message_Week
     */
    public function weekUpdateLot(
        Llv_Services_Message_Header $header,
        Llv_Services_Product_Request_Season $request
    )
    {
        $message = new Llv_Services_Product_Message_Week();
        try {
            $entityRequest = new Llv_Entity_Product_Request_Season();
            $entityRequest->id = $request->id;
            $entityRequest->idWeekList = $request->idWeekList;
            $this->getEntity()->weekUpdateLot($entityRequest);
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }
}