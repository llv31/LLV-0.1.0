<?php

class TestController
    extends Zend_Controller_Action
{
    public function init()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function generateWeeksAction()
    {

        $timestamp = time();
        for ($i = 0; $i < 520; $i++) {
            $dateDebut = new DateTime(date('Y-m-d 17:00:00', strtotime("now", $timestamp)));
            $dateFin = new DateTime(date('Y-m-d 10:30:00', strtotime("+1 week", $dateDebut->getTimestamp())));
            $timestamp = $dateFin->getTimestamp();

            $query = "INSERT INTO  `giteluch`.`season_week` (
                `number` ,
                `date_begining` ,
                `date_ending`
                )
                VALUES (
                '" . (int)date('W', $dateFin->getTimestamp()) . "',
                '" . $dateDebut->format(Llv_Constant_Date::FORMAT_DB) . "',
                '" . $dateFin->format(Llv_Constant_Date::FORMAT_DB) . "'
                );
                ";
            echo $query . "<br/>";
        }
        die;
    }

    public function getProductAction()
    {
        $filter = new Llv_Services_Product_Filter_Product();
        $filter->url = 'venasque';
        $filter->url = 'etch-soulet-1';

        $product = Llv_Context_Product::getInstance()->getOne($filter);
        Zend_Debug::dump($product);

    }


}

