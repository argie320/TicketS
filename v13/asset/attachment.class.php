<?php 

class FileScanner{
	
	private $uploaded;
	private $failed;
	private $allowed;
	private $rootdir;
	public $service_number_DIR;
	private $mReply_number;
	private $listOfReadyToInsertInSQL;
	
	function __construct($service_number, $reply_number){
		
		$this->mReply_number = $reply_number;
		$this->service_number_DIR = $service_number;
		$this->uploaded = array();
		$this->failed = array();
		$this->rootdir = "attachment/";
		$this->allowed = array('txt','jpeg','pdf','doc','docx','pub','xls','xlsx','jpg','png','pps','ppt','pptx','psd','zip','7z');
		
	}
	
	public function startScan($element){
		
		$files = $element;
		
		if(!empty($files['name'][0])){
			
			$this->createDIR();
			
			foreach($files['name'] as $position => $file_name){
				
				$file_tmp = $files['tmp_name'][$position];
				$file_size =$files['size'][$position];
				$file_error=$files['error'][$position];
		
				$file_ext = explode('.', $file_name);
				$file_ext = strtolower(end($file_ext));
				$failed_in_extension = array();
				$failed_to_upload = array();
				$failed_error_in_file = array();
				
				
				if(in_array($file_ext, $this->allowed)){
					
					if($file_error == 0){
						$file_name_new = uniqid('' , true) . '.' . $file_ext;
						$file_destination = $this->rootdir.''.$this->service_number_DIR.'/' .$file_name_new;
						
						//Name of the file
						$file_name = $files['name'][$position];
						//New filename unique by millisecon
						$file_name_new[$position];
						
						if(move_uploaded_file($file_tmp, $file_destination)){
							$this->uploaded[$position] = $file_destination;
						}else{
							$failed_to_upload[$position] = "".$file_name." is failed to upload";
						}
						
						/******
						*Return the array names of file
						*****/
						$file_name_array=$file_name;
						$file_name_new_array=$file_name_new;
						$value_insert[] = "('" .$this->service_number_DIR. "',  '" .$file_name_new_array. "', '" . $file_name_array . "', NOW())";	
					}else{
						$failed_error_in_file[$position] = "".$file_name." error with code {".$file_error."}";
					}
					
					
				}else{
					$failed_in_extension[$position] = " ".$file_name." file extension {".$file_ext."} is not allowed";
				}
			}
			
			$values_insert = implode(',', $value_insert);
			$query = "INSERT INTO sv_ticket_details_attachment(sv_number, uniqid,attachment,date_uploaded) VALUES" . $values_insert;
			
			$this->listOfReadyToInsertInSQL = $query;
			return true;
			
		}else{
			return false;
		}
		
	}
	
	public function getInsertedQuery(){
		return $this->listOfReadyToInsertInSQL;
	}
	
	private function createDIR(){
		
		if(!file_exists("$this->rootdir"."$this->service_number_DIR"."/")){
			mkdir("$this->rootdir"."$this->service_number_DIR", 0755);
		}
			
	}
	
	
	
}

?>

