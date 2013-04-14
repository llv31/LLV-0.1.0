<?php
/**
 * PHP Class ContactController.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 21/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class ContactController
    extends Zend_Controller_Action
{
    public function init()
    {
    }

    public function indexAction()
    {
        $contactForm = new App_Form_Front_Contact();
        if ($this->getRequest()->isPost()) {
            if ($contactForm->isValid($_POST)) {
                try {
                    $mailer = new PHPMailer_PHPMailer(true);
                    $mailer->AddAddress('contact@aroy.fr', 'Alexandre');
                    $mailer->AddAddress(_('CONTACT_ENVOI_MAIL_MAIL'), 'Luchon Location Vacances');
                    $mailer->SetFrom(
                        $contactForm->getValue('email'),
                        $contactForm->getValue('prenom') . ' ' . $contactForm->getValue('nom')
                    );
                    $mailer->AddReplyTo(
                        $contactForm->getValue('email'),
                        $contactForm->getValue('prenom') . ' ' . $contactForm->getValue('nom')
                    );
                    $mailer->Subject = _('CONTACT_ENVOI_MAIL_SUJET');
                    $mailer->AltBody = _('CONTACT_ENVOI_MAIL_ALT');
                    $mailer->MsgHTML(
                        implode(
                            '<br/>',
                            array(
                                 '<h2>' . _('CONTACT_FORM_FIELDSET_INFORMATIONS') . '</h2>',
                                 _('CONTACT_FORM_LABEL_DECOUVERTE') . ' : ' . $contactForm->getValue('decouverte'),
                                 _('CONTACT_FORM_LABEL_NOM') . ' : ' . $contactForm->getValue('nom') . ' ' . $contactForm->getValue('prenom'),
                                 nl2br($contactForm->getValue('adresse')),
                                 _('CONTACT_FORM_LABEL_TELEPHONE') . ' : ' . $contactForm->getValue('telephone'),
                                 _('CONTACT_FORM_LABEL_EMAIL') . ' : ' . $contactForm->getValue('email'),
                                 '<h2>' . _('CONTACT_FORM_FIELDSET_DEMANDE') . '</h2>',
                                 _('CONTACT_FORM_LABEL_ADULTES') . ' : ' . $contactForm->getValue('adultes'),
                                 _('CONTACT_FORM_LABEL_ENFANTS') . ' : ' . $contactForm->getValue('enfants'),
                                 _('CONTACT_FORM_LABEL_ARRIVEE') . ' : ' . $contactForm->getValue('arrivee'),
                                 _('CONTACT_FORM_LABEL_DEPART') . ' : ' . $contactForm->getValue('depart'),
                                 _('CONTACT_FORM_LABEL_LOCATIONS') . ' : ' . $contactForm->getValue('locations'),
                                 _('CONTACT_FORM_LABEL_PRECISIONS') . ' : ' . $contactForm->getValue('precisions')
                            )
                        )
                    );
//                $mailer->AddAttachment('images/phpmailer.gif'); // attachment
//                $mailer->AddAttachment('images/phpmailer_mini.gif'); // attachment
                    $mailer->set('CharSet', 'UTF-8');
                    $mailer->Send();
                    $this->view->assign('successMessage', _('CONTACT_ENVOI_MAIL_MESSAGE_SUCCES')); //Pretty error messages from PHPMailer
                } catch (PHPMailer_phpmailerException $e) {
                    $this->view->assign('errorMessage', $e->getMessage()); //Pretty error messages from PHPMailer
                } catch (Exception $e) {
                    $this->view->assign('errorMessage', $e->getMessage()); //Pretty error messages from PHPMailer
                }
            } else {
                $this->view->assign('errorMessage', _('CONTACT_ENVOI_MAIL_MESSAGE_OBLIGATOIRE')); //Pretty error messages from PHPMailer
            }
        }
        $this->view->assign('contactForm', $contactForm);
    }
}