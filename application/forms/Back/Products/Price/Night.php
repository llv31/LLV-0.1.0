<?php
/**
 * PHP Class Night.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 22/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class App_Form_Back_Products_Price_Night
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

        /**  */
        for ($i = 1; $i <= 4; $i++) {
            $elements[] = new Zend_Form_Element_Text(
                array(
                     'name'            => 'nuit' . $i,
                     'label'           => _('PRODUCTS_EDIT_PRICE_NUIT' . $i)
                )
            );
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
    public function fillForm(Llv_Dto_Product $product)
    {
        $this->getElement('id')->setValue($product->id);
        $this->getElement('availability')->setValue($product->availability);
        $this->getElement('nuit1')->setValue($product->price->one);
        $this->getElement('nuit2')->setValue($product->price->two);
        $this->getElement('nuit3')->setValue($product->price->three);
        $this->getElement('nuit4')->setValue($product->price->four);
    }
}