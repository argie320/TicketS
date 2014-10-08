<?php  

class Customer {
	
	public $custcode = "";
	public $CustomerName  = "";
	public $EmailAddress  = "";
	public $ContactNumber  = "";
	public $FaxNo  = "";
	public $Address  = "";
	public $ContactPerson  = "";

    public function __construct($code, $name, $email, $contact_num, $fax_number, $address, $contactperson){
        $this->custcode = $code;
        $this->ContactName = $name;
        $this->EmailAddress = $email;
        $this->ContactNumber = $contact_num;
        $this->FaxNo = $fax_number;
        $this->Address = $address;
        $this->ContactPerson = $contactperson;
    }

}


?>