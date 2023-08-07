<?php

namespace Models;

class Payment
{
    private $paymentId;
    private $paymentDate;
    private $invoice;
    private $amount;
    private $paymentImage;

    private $paymentPdfPath;

    public function getPaymentId()
    {
        return $this->paymentId;
    }
    public function setPaymentId($paymentId)
    {
        $this->paymentId=$paymentId;
    }
    public function getPaymentDate()
    {
        return $this->paymentDate;
    }
    public function setPaymentDate($paymentDate)
    {
        $this->paymentDate=$paymentDate;
    }
    public function getInvoice()
    {
        return $this->invoice;
    }
    public function setInvoice(Invoice $invoice)
    {
        $this->invoice=$invoice;
    }
    public function getAmount()
    {
        return $this->amount;
    }
    public function setAmount($amount)
    {
        $this->amount=$amount;
    }
    public function getPaymentImage()
    {
        return $this->paymentImage;
    }
    public function setPaymentImage($paymentImage)
    {
        $this->paymentImage=$paymentImage;
    }
    
    public function getPaymentPdf(){
        return $this->paymentPdfPath;
    }

    public function setPaymentPdf($path){
        $this->paymentPdfPath=$path;
    }
}
?>