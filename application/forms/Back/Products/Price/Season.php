<?php
/**
 * PHP Class Season.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 22/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class App_Form_Back_Products_Price_Season
    extends App_Form_Abstract
{
    public function __construct(Llv_Dto_Product $product)
    {
        $this->setMethod(Zend_Form::METHOD_POST);
        $this->setAttrib('enctype', Zend_Form::ENCTYPE_MULTIPART);
        $this->setAttrib('class', 'i18ned');
        $this->_setAction('/products/edit-product/id/' . $product->id);

        /**  */
        $elements[] = new Zend_Form_Element_Hidden(
            array(
                 'name' => 'id',
                 'value'=> null
            )
        );

        /**  */
        $elements[] = new Zend_Form_Element_Text(
            array(
                 'name'            => 'availability',
                 'label'           => _('PRODUCTS_EDIT_PRICE_DISPO'),
                 'required'        => true
            )
        );

        /** @var $saison Llv_Dto_Season */
        $filter = new Llv_Services_Product_Filter_Season();
        foreach (Llv_Context_Product::getInstance()->seasonGetAll($filter) as $saison) {
            $week = new Zend_Form_Element_Text(
                array(
                     'name'            => App_Model_Constant_Product::FORM_PREFIX_WEEK . $saison->id,
                     'label'           => $saison->label . ' : ' . _('PRODUCTS_EDIT_PRICE_SAISON_SEMAINE'),
                     'class'           => 'small',
                     'required'        => true
                )
            );
            $weekend = new Zend_Form_Element_Text(
                array(
                     'name'            => App_Model_Constant_Product::FORM_PREFIX_WEEKEND . $saison->id,
                     'label'           => $saison->label . ' : ' . _('PRODUCTS_EDIT_PRICE_SAISON_WEEKEND'),
                     'class'           => 'small'
                )
            );
            $midweek = new Zend_Form_Element_Text(
                array(
                     'name'            => App_Model_Constant_Product::FORM_PREFIX_MIDWEEK . $saison->id,
                     'label'           => $saison->label . ' : ' . _('PRODUCTS_EDIT_PRICE_SAISON_MIDWEEK'),
                     'class'           => 'small'
                )
            );

            $elements[] = $week->setBelongsTo(App_Model_Constant_Product::FORM_PREFIX_WEEK);
            $elements[] = $weekend->setBelongsTo(App_Model_Constant_Product::FORM_PREFIX_WEEKEND);
            $elements[] = $midweek->setBelongsTo(App_Model_Constant_Product::FORM_PREFIX_MIDWEEK);
        }


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
        $this->fillForm($product);
        return parent::__construct();
    }

    /**
     * @param Llv_Dto_Product $product
     */
    public
    function fillForm(Llv_Dto_Product $product)
    {
        $this->getElement('id')->setValue($product->id);
        $this->getElement('availability')->setValue($product->availability);

        foreach ($product->price as $prix) {
            $this->getElement(App_Model_Constant_Product::FORM_PREFIX_WEEK . $prix->season->id)->setValue($prix->week);
            $this->getElement(App_Model_Constant_Product::FORM_PREFIX_WEEKEND . $prix->season->id)->setValue($prix->weekend);
            $this->getElement(App_Model_Constant_Product::FORM_PREFIX_MIDWEEK . $prix->season->id)->setValue($prix->midweek);
        }
    }
}