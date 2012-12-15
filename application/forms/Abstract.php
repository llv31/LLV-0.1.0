<?php
/**
 * PHP Class Abstract .php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 22/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class App_Form_Abstract
    extends Zend_Form
{
    protected $formDecorator = array(
        'FormElements',
        array('HtmlTag'),
        'Form'
    );

    protected $fieldsetDecorator = array(
        'FormElements',
        array('HtmlTag', array('tag'=> 'dl')),
        'Fieldset'
    );

    protected $elementsDecorator = array(
        'ViewHelper',
        array('Label', array('placement'=> 'prepend')),
        array(array('row'=> 'HtmlTag'), array('tag'=> 'p', 'class'=> 'default_element'))
    );
    protected $submitDecorator = array(
        'ViewHelper',
        array(array('row'=> 'HtmlTag'), array('tag'=> 'p', 'class'=> 'submit_element'))
    );
    protected $textareaDecorator = array(
        'ViewHelper',
        array('Label', array('placement'=> 'prepend')),
        array(array('row'=> 'HtmlTag'), array('tag'=> 'p', 'class'=> 'textarea_element'))
    );
    protected $selectDecorator = array(
        'ViewHelper',
        array('Label', array('placement'=> 'prepend')),
        array(array('row'=> 'HtmlTag'), array('tag'=> 'p', 'class'=> 'select_element'))
    );
    protected $fileDecorator = array(
        'ViewHelper',
        array('Label', array('placement'=> 'prepend')),
        array(array('row'=> 'HtmlTag'), array('tag'=> 'p', 'class'=> 'file_element'))
    );
    protected $smallElementsDecorator = array(
        'ViewHelper',
        array('Label', array('placement'=> 'prepend')),
        array(array('row'=> 'HtmlTag'), array('tag'=> 'p', 'class'=> 'small_element'))
    );

    /**
     * Initialisation des décorateurs
     */
    public function init()
    {
        $this->setDisableLoadDefaultDecorators(true);
        $this->setDecorators($this->formDecorator);
        $this->setDisplayGroupDecorators($this->fieldsetDecorator);

        /** @var $element Zend_Form_Element */
        foreach ($this->getElements() as $element) {
            if ($element->isRequired()) {
                $element->setLabel($element->getLabel() . _('GLOBAL_CHAMP_OBLIGATOIRE'));
            }
            if ($element instanceof Zend_Form_Element_Submit) {
                $element->setDecorators($this->submitDecorator);
            } elseif ($element instanceof Zend_Form_Element_Textarea) {
                $element->setDecorators($this->textareaDecorator);
            } elseif ($element instanceof Zend_Form_Element_Select) {
                $element->setDecorators($this->selectDecorator);
            } elseif ($element instanceof Zend_Form_Element_File) {
//                $element->setDecorators($this->fileDecorator);
            } elseif ($element instanceof Zend_Form_Element_Text && $element->getAttrib('class') == 'small') {
                $element->setDecorators($this->smallElementsDecorator);
            } else {
                $element->setDecorators($this->elementsDecorator);
            }
        }
    }

    /**
     * Set l'action du form quel que soit l'environnement
     *
     * @param $action
     */
    protected function _setAction($action)
    {
        if (APPLICATION_ENV == 'dev') {
            $this->setAction(App_View_Helper_BaseUrl::baseUrl() . $action);
        } else {
            $this->setAction($action);
        }
    }
}