<?php
include_once('asset/DB.php');

class PersonInfo {

    public $FullName;
    public $Username;
    public $Email;
    public $Position;

    public function __construct(){

    }
	
	public function checkUsernameIfExits($value){
		
		// trim and escape input value    
		$value = $this->mMysqli->real_escape_string(trim($value));
		
		// empty user name is not valid
		if ($value == null) 
			return '0'; // not valid
		
		// check if the username exists in the database
		$query = $this->mMysqli->query('SELECT user_name FROM gagamit WHERE user_name ="' . $value . '"');
		
		if ($this->mMysqli->affected_rows > 0)
      		return '0'; // not valid
    	else
      		return '1'; // valid
		
	}
	
	public function checkEmailIfExits($value){
		
		// trim and escape input value    
		$value = $this->mMysqli->real_escape_string(trim($value));
		
		// empty user name is not valid
		if ($value == null) 
			return 0; // not valid
		
		// check if the username exists in the database
		$result = DB::getInstance()->prepare("SELECT email FROM gagamit WHERE email = :emial ");
        $result->execute(array(':emial'=>$value));
		
		if ($result->rowCount())
      		return '0'; // not valid
    	else
      		return '1'; // valid
		
	}

    private function searchPerson($position){

         //remove all non-numeric characters. If so, \D means "anything that isn't a digit":
        $type = preg_replace('/\D/', '',$position);
        if(isset($type)){

            $result = DB::getInstance()->query("SELECT * FROM gagamit WHERE position = ".$type." ");

            if($result->rowCount() > 0){

                $personArray = array();

                while($row = $result->fetch(PDO::FETCH_ASSOC)){

                    $username = $row['user_name'];
                    $fn = $row['fullname'];
                    $em = $row['email'];
                    $com = $row['company'];
                    $mobile = $row['mobile'];

                    $personArray[$username] = array("FullName"=>$fn, "Email"=>$em, "Company"=>$com,"MobileNumber"=>$mobile);
                }
                return $personArray;
            }else{
                return "No Result";
            }

        }else{
            return false;
        }

    }


    public function getCustomerServiceRe(){
       return $this->searchPerson(0);
    }


    public function getSuperVisor(){
        return $this->searchPerson(1);
    }

    public function getListOfEngineer(){
        return $this->searchPerson(2);
    }

}

/*Test This File
$sd = new Person();
print_r($sd->getListOfEngineer());
*/


?>