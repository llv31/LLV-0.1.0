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

class App_Form_Back_Cms_Carrousel
    extends App_Form_Abstract
{
    public function __construct()
    {
        $this->setMethod(Zend_Form::METHOD_POST);
        $this->setAttrib('enctype', Zend_Form::ENCTYPE_MULTIPART);


        $this->setAction('/index/carrousel-add/');
        if (APPLICATION_ENV == 'dev') {
            $this->setAction(App_View_Helper_BaseUrl::baseUrl() . 'index/carrousel-add/');
        }
        $this->setAttrib('id', 'cms_carrousel');

        $elements = array();
        for ($i = 1; $i <= App_Model_Constant_Upload::FORM_INPUT_COUNT; $i++) {
            $file = new Zend_Form_Element_File(
                array(
                     'name'            => App_Model_Constant_Upload::FORM_PREFIX_FILE . $i,
                     //                     'label'           => _('HOME_CARROUSEL_FILE_LABEL'),
                     'maxFileSize'     => App_Model_Constant_Upload::MAX_FILE_SIZE
                )
            );
            $file->addValidator('Extension', false, 'jpg,png,jpeg');
//            $file->setDestination(Llv_Services_Cms_Helper_Carrousel::getCarrouselFilesPath());
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
}