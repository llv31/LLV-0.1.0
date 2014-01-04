<?php
/**
 * PHP Class IndexController.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 21/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class IndexController
    extends Zend_Controller_Action
{
    public function indexAction()
    {
        $this->view->assign('social_facebook', Llv_Context_Application::getInstance()->getFacebookPage());

        $request = new Llv_Services_Cms_Request_Page();
        $request->id = Llv_Constant_Cms_Page::HOME_ID;
        $messageAccueil = Llv_Context_Cms::getInstance()->pageGetRow($request);
        $this->view->assign('message_accueil', $messageAccueil);

        $filter = new Llv_Services_Cms_Filter_Carrousel();
        $filter->online = true;
        $filter->amount = 4;
        $carrousel = Llv_Context_Cms::getInstance()->carrouselGetList($filter);
        $this->view->assign('carrousel', $carrousel);

        $filter = new Llv_Services_News_Filter_News();
        $filter->spotlight = true;
        $filter->onlineIllustration = true;
        $filter->amount = 5;
        $news = Llv_Context_News::getInstance()->getAll($filter);
        $this->view->assign('news', $news);

        $filter = new Llv_Services_Product_Filter_Product();
        $filter->idCategory = Llv_Constant_Product::CATEGORY_GUESTHOUSE;
        $filter->onlineIllustration = true;
        $filter->illustrationAmount = 9;
        $guesthouse = Llv_Context_Product::getInstance()->getAll($filter);
        $this->view->assign('guesthouse', $guesthouse);

        $filter->idCategory = Llv_Constant_Product::CATEGORY_CHALET;
        $chalet = Llv_Context_Product::getInstance()->getAll($filter);
        $this->view->assign('chalet', $chalet);
    }

    public function contactAction()
    {
        if ($this->getRequest()->isPost()) {
            $antibot = $this->_getParam('agezegaga');
            if (strlen($antibot) <= 0) {
                try {

                    $mandatory = array(
                        'nom',
                        'prenom',
                        'email',
                        'telephone',
                        'message',
                    );
                    $validForm = true;
                    foreach ($mandatory as $field) {
                        if (strlen($this->_getParam($field)) <= 0) {
                            $validForm = false;
                        }
                    }
                    if ($validForm) {
                        $mailer = new PHPMailer_PHPMailer(true);
                        $mailer->AddAddress('aroybase@hotmail.fr', 'Luchon Location Vacances');
                        $mailer->AddAddress(_('CONTACT_ENVOI_MAIL_MAIL'), 'Luchon Location Vacances');
                        $mailer->SetFrom(
                            $this->_getParam('email'),
                            $this->_getParam('prenom') . ' ' . $this->_getParam('nom')
                        );
                        $mailer->AddReplyTo(
                            $this->_getParam('email'),
                            $this->_getParam('prenom') . ' ' . $this->_getParam('nom')
                        );
                        $mailer->Subject = _('CONTACT_ENVOI_MAIL_SUJET2');
                        $mailer->AltBody = _('CONTACT_ENVOI_MAIL_ALT');
                        $mailer->MsgHTML(
                            implode(
                                '<br/>',
                                array(
                                     '<h2>' . _('CONTACT_FORM_FIELDSET_INFORMATIONS') . '</h2>',
                                     _('CONTACT_FORM_LABEL_NOM') . ' : ' . $this->_getParam('nom') . ' ' . $this->_getParam('prenom'),
                                     _('CONTACT_FORM_LABEL_TELEPHONE') . ' : ' . $this->_getParam('telephone'),
                                     _('CONTACT_FORM_LABEL_EMAIL') . ' : ' . $this->_getParam('email'),
                                     '<h2>' . _('CONTACT_FORM_FIELDSET_DEMANDE') . '</h2>',
                                     _('CONTACT_FORM_LABEL_LOCATIONS') . ' : ' . $this->_getParam('locations'),
                                     _('CONTACT_FORM_LABEL_PRECISIONS') . ' : ' . $this->_getParam('message')
                                )
                            )
                        );
                        $mailer->set('CharSet', 'UTF-8');
                        $mailer->Send();
                        $this->view->assign('successMessage', _('CONTACT_ENVOI_MAIL_MESSAGE_SUCCES')); //Pretty error messages from PHPMailer
                    } else {
                        $this->view->assign('errorMessage', _('CONTACT_ENVOI_MAIL_MESSAGE_OBLIGATOIRE')); //Pretty error messages from PHPMailer
                    }
                } catch (PHPMailer_phpmailerException $e) {
                    $this->view->assign('errorMessage', $e->getMessage()); //Pretty error messages from PHPMailer
                }
                $this->_forward('index', 'index');
            }
        }
    }

    public function reservationAction()
    {
        if ($this->getRequest()->isPost()) {
            $antibot = $this->_getParam('agezegaga');
            if (strlen($antibot) <= 0) {
                try {
                    $mandatory = array(
                        'nom',
                        'prenom',
                        'email',
                        'telephone',
                        'adresse',
                        'location',
                        'adultes',
                        'enfants',
                        'arrivee',
                        'depart',
                    );
                    $validForm = true;
                    foreach ($mandatory as $field) {
                        if (strlen($this->_getParam($field)) <= 0) {
                            $validForm = false;
                        }
                    }
                    if ($validForm) {
                        $mailer = new PHPMailer_PHPMailer(true);
                        $mailer->AddAddress('aroybase@hotmail.fr', 'Luchon Location Vacances');
                        $mailer->AddAddress(_('CONTACT_ENVOI_MAIL_MAIL'), 'Luchon Location Vacances');
                        $mailer->SetFrom(
                            $this->_getParam('email'),
                            $this->_getParam('prenom') . ' ' . $this->_getParam('nom')
                        );
                        $mailer->AddReplyTo(
                            $this->_getParam('email'),
                            $this->_getParam('prenom') . ' ' . $this->_getParam('nom')
                        );
                        $mailer->Subject = _('CONTACT_ENVOI_MAIL_SUJET');
                        $mailer->AltBody = _('CONTACT_ENVOI_MAIL_ALT');
                        $mailer->MsgHTML(
                            implode(
                                '<br/>',
                                array(
                                     '<h2>' . _('CONTACT_FORM_FIELDSET_INFORMATIONS') . '</h2>',
                                     _('CONTACT_FORM_LABEL_DECOUVERTE') . ' : ' . $this->_getParam('decouverte'),
                                     _('CONTACT_FORM_LABEL_NOM') . ' : ' . $this->_getParam('nom') . ' ' . $this->_getParam('prenom'),
                                     nl2br($this->_getParam('adresse')),
                                     _('CONTACT_FORM_LABEL_TELEPHONE') . ' : ' . $this->_getParam('telephone'),
                                     _('CONTACT_FORM_LABEL_EMAIL') . ' : ' . $this->_getParam('email'),
                                     '<h2>' . _('CONTACT_FORM_FIELDSET_DEMANDE') . '</h2>',
                                     _('CONTACT_FORM_LABEL_ADULTES') . ' : ' . $this->_getParam('adultes'),
                                     _('CONTACT_FORM_LABEL_ENFANTS') . ' : ' . $this->_getParam('enfants'),
                                     _('CONTACT_FORM_LABEL_ARRIVEE') . ' : ' . $this->_getParam('arrivee'),
                                     _('CONTACT_FORM_LABEL_DEPART') . ' : ' . $this->_getParam('depart'),
                                     _('CONTACT_FORM_LABEL_LOCATIONS') . ' : ' . $this->_getParam('locations'),
                                     _('CONTACT_FORM_LABEL_PRECISIONS') . ' : ' . $this->_getParam('precisions')
                                )
                            )
                        );
                        $mailer->set('CharSet', 'UTF-8');
                        $mailer->Send();
                        $this->view->assign('successMessage', _('CONTACT_ENVOI_MAIL_MESSAGE_SUCCES')); //Pretty error messages from PHPMailer
                    } else {
                        $this->view->assign('errorMessage', _('CONTACT_ENVOI_MAIL_MESSAGE_OBLIGATOIRE')); //Pretty error messages from PHPMailer
                    }
                } catch (PHPMailer_phpmailerException $e) {
                    $this->view->assign('errorMessage', $e->getMessage()); //Pretty error messages from PHPMailer
                }
            }
            $this->_forward('index', 'index');
        }
    }
}