<?php
/**
 * PHP Class Product.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 22/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class App_Form_Back_Product
    extends App_Form_Abstract
{
    public function __construct($id)
    {
        $this->setMethod(Zend_Form::METHOD_POST);
        $this->setAttrib('enctype', Zend_Form::ENCTYPE_MULTIPART);
        $this->setAttrib('class', 'i18ned');
        $this->_setAction('products/edit-product/');

        /**  */
        $elements[] = new Zend_Form_Element_Hidden(
            array(
                 'name' => 'id',
                 'value'=> null
            )
        );

        /** @var $language Llv_Dto_Language */
        foreach (Llv_Context_Referential::getInstance()->getLanguages() as $language) {
            $text = new Zend_Form_Element_Text(
                array(
                     'name'            => App_Model_Constant_Product::FORM_PREFIX_TITLE . $language->id,
                     'label'           => _('PRODUCTS_LIST_TITRE') . ' ' . $language->label,
                     'class'           => 'jq-lang',
                     'data-language'   => $language->locale->toString(),
                     'required'        => true
                )
            );
            $intro = new Zend_Form_Element_Textarea(
                array(
                     'name'            => App_Model_Constant_Product::FORM_PREFIX_INTRO . $language->id,
                     'label'           => _('PRODUCTS_LIST_INTRO') . ' ' . $language->label,
                     'class'           => 'jq-lang',
                     'data-language'   => $language->locale->toString(),
                     'required'        => true
                )
            );
            $textarea = new Zend_Form_Element_Textarea(
                array(
                     'name'            => App_Model_Constant_Product::FORM_PREFIX_CONTENT . $language->id,
                     'label'           => _('PRODUCTS_LIST_DESCRIPTION') . ' ' . $language->label,
                     'class'           => 'jq-lang',
                     'data-language'   => $language->locale->toString(),
                     'required'        => true
                )
            );

            $elements[] = $text->setBelongsTo(App_Model_Constant_Product::FORM_PREFIX_TITLE);
            $elements[] = $intro->setBelongsTo(App_Model_Constant_Product::FORM_PREFIX_INTRO);
            $elements[] = $textarea->setBelongsTo(App_Model_Constant_Product::FORM_PREFIX_CONTENT);
        }

        /** Bouton de validation */
        $elements[] = new Zend_Form_Element_Submit(
            array(
                 'name'    => 'submit',
                 'label'   => _('GLOBAL_FORM_SUBMIT')
            )
        );
        $elements[] = new Zend_Form_Element_Submit(
            array(
                 'name'    => 'submit_quit',
                 'label'   => _('GLOBAL_FORM_SUBMIT_QUIT')
            )
        );

        /** Ajout des éléments au formulaire */
        $this->addElements($elements);
        $this->fillForm($id);
        return parent::__construct();
    }

    /**
     * @param $id
     */
    public function fillForm($id)
    {
        $this->getElement('id')->setValue($id);
        foreach (Llv_Context_Referential::getInstance()->getLanguages() as $language) {
            $filter = new Llv_Services_Product_Filter_Product();
            $filter->id = $id;
            $filter->idLangue = $language->id;
            $product = Llv_Context_Product::getInstance()->getOne($filter);
            if (!is_null($product)) {
                $this->getElement(App_Model_Constant_Product::FORM_PREFIX_INTRO . $language->id)->setValue($product->introduction);
                $this->getElement(App_Model_Constant_Product::FORM_PREFIX_TITLE . $language->id)->setValue($product->title);
                $this->getElement(App_Model_Constant_Product::FORM_PREFIX_CONTENT . $language->id)->setValue($product->content);
            }
        }
    }
}