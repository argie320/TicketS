<?php
// load error handling module
//require_once('error_handler.php');
// load configuration file
require_once('config.php');

// class supports server-side suggest & autocomplete functionality
class Suggest
{
  // database handler
  private $mMysqli;
  
  // constructor opens database connection
  function __construct() 
  {   
    // connect to the database
    $this->mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, 
                                                          DB_DATABASE);    
  }
  
  // destructor, closes database connection  
  function __destruct() 
  {
    $this->mMysqli->close();
  }
  
  // returns all PHP functions that start with $keyword
  public function getSuggestions($keyword)
  {
    // escape the keyword string      
    $patterns = array('/\s+/', '/"+/', '/%+/');
    $replace = array('');
    $keyword = preg_replace($patterns, $replace, $keyword);
    // build the SQL query that gets the matching functions from the database
    if($keyword != '') 
      $query = 'SELECT customer_name ' .
               'FROM tbcustomer ' . 
               'WHERE  customer_name LIKE "' . $keyword . '%"';
    // if the keyword is empty build a SQL query that will return no results
    else
      $query = 'SELECT customer_name ' .
 
               'FROM tbcustomer ' .
               'WHERE customer_name=""'; 
    // execute the SQL query
    $result = $this->mMysqli->query($query);
	
	  
    // if we have results, loop through them and add them to the output
    if($result->num_rows)
      while ($row = $result->fetch_array(MYSQLI_ASSOC))
	   
	   $customername = $row['customer_name'];
	   
       $output =  array(
						 'customername'=>$customername
					);
					
		
    // close the result stream 
    $result->close();
	
	// build the JSON response		
    // return the results
    return json_encode($output,JSON_FORCE_OBJECT);
	
	
	
	
  }
//end class Suggest
}
?>
