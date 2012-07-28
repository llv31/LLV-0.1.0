<?php
/**
 * PHP Class Login.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 22/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class App_Form_Back_Login
    extends App_Form_Abstract
{
    public function __construct()
    {
        $this->setMethod(Zend_Form::METHOD_POST);
        $this->setAttrib('enctype', Zend_Form::ENCTYPE_MULTIPART);

        $this->setAction('/index/login/');
        if (APPLICATION_ENV == 'dev') {
            $this->setAction(App_View_Helper_BaseUrl::baseUrl() . 'index/login/');
        }

        /** Login */
        $elements[] = new Zend_Form_Element_Text(
            array(
                 'name'    => 'login',
                 'label'   => _('HOME_LOGIN_FORM_LOGIN_LABEL'),
                 'required'=> true
            )
        );
        /** Password */
        $elements[] = new Zend_Form_Element_Password(
            array(
                 'name'    => 'password',
                 'label'   => _('HOME_LOGIN_FORM_PASSWORD_LABEL'),
                 'required'=> true
            )
        );

        /** Bouton de validation */
        $elements[] = new Zend_Form_Element_Submit(
            array(
                 'name'    => 'submit',
                 'label'   => _('HOME_LOGIN_FORM_SUBMIT_LABEL')
            )
        );
        /** Ajout des éléments au formulaire */
        $this->addElements($elements);

        return parent::__construct();
    }
}