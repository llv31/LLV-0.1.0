<?php
/**
 * PHP Class App_Form_Back_Cms_Page.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 22/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class App_Form_Back_Cms_Page
    extends App_Form_Abstract
{
    public function __construct()
    {
        $this->setMethod(Zend_Form::METHOD_POST);
        $this->setAttrib('enctype', Zend_Form::ENCTYPE_MULTIPART);
        $this->_setAction('/index/index/');
        $this->setAttrib('id', 'cms_page');
        $this->setAttrib('class', 'i18ned');

        $elements = array();
        /** @var $language Llv_Dto_Language */
        foreach (Llv_Context_Referential::getInstance()->getLanguages() as $language) {
            $text = new Zend_Form_Element_Text(
                array(
                     'name'            => App_Model_Constant_Cms_Page::FORM_PREFIX_TITLE . $language->id,
                     'label'           => _('HOME_PAGECMS_EDIT_TITLE_LABEL') . ' ' . $language->label,
                     'class'           => 'jq-lang',
                     'data-language'   => $language->locale->toString()
                )
            );
            $textarea = new Zend_Form_Element_Textarea(
                array(
                     'name'            => App_Model_Constant_Cms_Page::FORM_PREFIX_CONTENT . $language->id,
                     'label'           => _('HOME_PAGECMS_EDIT_CONTENT_LABEL') . ' ' . $language->label,
                     'class'           => 'jq-lang',
                     'data-language'   => $language->locale->toString()
                )
            );

            $elements[] = $text->setBelongsTo(App_Model_Constant_Cms_Page::FORM_PREFIX_TITLE);
            $elements[] = $textarea->setBelongsTo(App_Model_Constant_Cms_Page::FORM_PREFIX_CONTENT);
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