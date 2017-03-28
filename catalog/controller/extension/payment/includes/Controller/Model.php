<?php
abstract class Controller_Model extends Controller
{

    public $_methodInstance;

    public function __construct($registry)
    {
        parent::__construct($registry);
        $this->language->load('extension/payment/checkoutapipayment');
        $methodType = $this->config->get('checkoutapipayment_pci_enable');


        switch ($methodType)
        {
            case 'yes':
                $this->setMethodInstance(new Controller_Methods_creditcardpci($registry));
                break;

            default:
                $this->setMethodInstance(new Controller_Methods_creditcard($registry));
                break;
        }
    }

    public function index()
    {
        $this->getMethodInstance()->getIndex();
        $data = $this->getMethodInstance()->getData();

        return $this->load->view('extension/payment/checkoutapi/checkoutapipayment', $data);
		
    }

    public function setMethodInstance($methodInstance)
    {
        $this->_methodInstance = $methodInstance;
    }

    public function getMethodInstance()
    {

        return $this->_methodInstance;
    }

    public function send()
    {
        $this->getMethodInstance()->send();
    }


}