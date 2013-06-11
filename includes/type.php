<?php

require_once("db.php");
//require_once("product.php");

	class Type{

		private $iTypeID;
		private $sTypeName;
		private $iDisplayOrder;
		private $sDescription;
		private $aPages; //array of type pages  
	
		public function __construct(){

			$this->iTypeID = 0;
			$this->sTypeName = "";
			$this->iDisplayOrder = 0;
			$this->sDescription = "";
			$this->aPages = array();

		}

		//function will load a type from the database to php
		//precondition: typeID to load must exist

		public function load($iTypeID){

			$oDatabase = new Database();

			$sQuery = "SELECT TypeID, TypeName, DisplayOrder, Description
					   FROM tbproducttype
					   WHERE TypeID = ". $iTypeID;

					$oResult = $oDatabase->query($sQuery);
					//fetch result out as an array
					$aSubject = $oDatabase->fetch_array($oResult);

					//assign array values to object attributes
					$this->iTypeID = $aType["TypeID"];
					$this->sTypeName = $aType["TypeName"];
					$this->iDisplayOrder = $aType["DisplayOrder"];
					$this->sDescription = $aType["Description"];

					//load all pages under the product

					$sQuery ="SELECT ProductID
							  FROM tbproduct
							  WHERE TypeID = ".$iTypeID;
					$oResult = $oDatabase->query($sQuery);
					
					while($aRow = $oDatabase->fetch_array($oResult)){

						$oPage = new Page();
						$oPage->load($aRow["ProductID"]);
						$this->aPages[] = $oPage;

					}  

					$oDatabase->close();
				
				}

				//getter: used to read rivate attributes
				public function __get($sProperty){

					switch ($sProperty){
						case "TypeID":
		        			return $this->iTypeID;
		        			break;
		        		case "TypeName":
		        			return $this->sTypeName;
		        			break;
		        		case "DisplayOrder":
		        			return $this->iDisplayOrder;
		        			break;
		        		case "Description":
		        			return $this->sDescription;
		        			break;
		        		default:
		        			die($sProperty . " is not allowed to read from");
					
					}
				
				}
	
	}
?>