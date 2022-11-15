<?php namespace DAO\BD;

use Models\Payment as Payment;

interface IPaymentDAOBD
{
    public function Add(Payment $payment);
    public function GetAll();
}

?>