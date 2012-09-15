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
    public $formDecorator = array(
        'FormElements',
        array('HtmlTag'),
        'Form'
    );
    public $elementsDecorator = array(
        'ViewHelper',
        array('Label', array('placement'=> 'prepend')),
        array(array('row'=> 'HtmlTag'), array('tag'=> 'p', 'class'=> 'default_element'))
    );
    public $submitDecorator = array(
        'ViewHelper',
        array(array('row'=> 'HtmlTag'), array('tag'=> 'p', 'class'=> 'submit_element'))
    );
    public $textareaDecorator = array(
        'ViewHelper',
        array('Label', array('placement'=> 'prepend')),
        array(array('row'=> 'HtmlTag'), array('tag'=> 'p', 'class'=> 'textarea_element'))
    );
    public $selectDecorator = array(
        'ViewHelper',
        array('Label', array('placement'=> 'prepend')),
        array(array('row'=> 'HtmlTag'), array('tag'=> 'p', 'class'=> 'select_element'))
    );
    public $fileDecorator = array(
        'ViewHelper',
        array('Label', array('placement'=> 'prepend')),
        array(array('row'=> 'HtmlTag'), array('tag'=> 'p', 'class'=> 'file_element'))
    );

    /**
     * Initialisation des décorateurs
     */
    public function init()
    {
        $this->setDisableLoadDefaultDecorators(true);
        $this->setDecorators($this->formDecorator);

        /** @var $element Zend_Form_Element */
        foreach ($this->getElements() as $element) {
            if ($element instanceof Zend_Form_Element_Submit) {
                $element->setDecorators($this->submitDecorator);
            } elseif ($element instanceof Zend_Form_Element_Textarea) {
                $element->setDecorators($this->textareaDecorator);
            } elseif ($element instanceof Zend_Form_Element_Select) {
                $element->setDecorators($this->selectDecorator);
            } elseif ($element instanceof Zend_Form_Element_File) {
//                $element->setDecorators($this->fileDecorator);
            } else {
                $element->setDecorators($this->elementsDecorator);
            }
        }
    }

    /**
     * Set l'action du form quel que soit l'environnement
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