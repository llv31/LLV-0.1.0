<?php
/**
 * PHP Class Carrousel.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 27/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class App_Form_Back_FileUploader
    extends App_Form_Abstract
{
    public function __construct($nbUpload = null)
    {
        $this->setMethod(Zend_Form::METHOD_POST);
        $this->setAttrib('enctype', Zend_Form::ENCTYPE_MULTIPART);

        $this->setAttrib('id', 'file_uploader');

        $elements = array();
        $nbUpload = !is_null($nbUpload) ? $nbUpload : App_Model_Constant_Upload::FORM_INPUT_COUNT;
        for ($i = 1; $i <= $nbUpload; $i++) {
            $file = new Zend_Form_Element_File(
                array(
                     'name'            => App_Model_Constant_Upload::FORM_PREFIX_FILE . $i,
                     //                     'label'           => _('HOME_CARROUSEL_FILE_LABEL'),
                     'maxFileSize'     => App_Model_Constant_Upload::MAX_FILE_SIZE
                )
            );
            $file->addValidator('Extension', false, 'jpg,png,jpeg');
            $elements[] = $file->setBelongsTo(App_Model_Constant_Upload::FORM_PREFIX_FILE);
        }

        /** Bouton de validation */
        $elements[] = new Zend_Form_Element_Submit(
            array(
                 'name'    => 'submit',
                 'label'   => _('GLOBAL_FORM_SUBMIT')
            )
        );
        /** Ajout des éléments au formulaire */
        $this->addElements($elements);

        return parent::__construct();
    }

    public function setActions($action)
    {
        $this->setAction($action);

        if (APPLICATION_ENV == 'dev') {
            $this->setAction(App_View_Helper_BaseUrl::baseUrl() . $action);
        }
    }
}