<?php
namespace DAO\BD;

use Models\Invoice as Invoice;


interface IInvoiceDAOBD
{
    
    public function Add(Invoice $invoice);
    
}
?>