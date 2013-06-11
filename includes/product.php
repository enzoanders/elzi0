<?php

include("db.php");


class Products{

	private $iProductID;
	private $sProductName;
	private $sDescription;
	private $iPrice;
	private $iTypeID;
	private $iStockLevel;
	private $sPhotoPath;
	private $iActive;

	public function __construct(){

		$this->iProductID = 0;
		$this->sProductName = '';
		$this->sDescription = '';
		$this->iPrice = 0;
		$this->iTypeID = 0;
		$this->iStockLevel = 0;
		$this->sPhotoPath = '';
		$this->iActive = 0;

	}

	public function load($iProductID){

		$oDatabase = new Database();

		$sQuery = "SELECT ProductID, ProductName, Description, Price, TypeID, StockLevel, PhotoPath, Active
				   FROM tbproduct
			       WHERE ProductID =" . $iProductID;

		$oResult = $oDatabase->query($sQuery);
		//Fetch result out as an array
		$aProduct = $oDatabase->fetch_array($oResult);

		//Assign array values to object attributes
		$this->iPageID = $aProduct["ProductID"];
		$this->sProductNameID = $aProduct["ProductNameID"];
		$this->sDescription = $aProduct["Description"];
		$this->iPrice = $aProduct["Price"];
		$this->iTypeID = $aProduct["TypeID"];
		$this->iStockLevel = $aProduct["StockLevel"];
		$this->sPhotoPath = $aProduct["PhotoPath"];
		$this->iActive = $aProduct["Active"];
		
		$oDatabase->close();

	}

	//getter: used to read private attributes

	public function __get($sProperty){

		switch($sProperty){

		case "ProductID":
			return $this->iProductID;
			break;
		case "ProductName":
			return $this->sProductName;
			break;
		case "Description":
			return $this->sDescription;
			break;
		case "Price":
			return $this->iPrice;
			break;
		case "TypeID":
			return $this->iTypeID;
			break;
		case "StockLevel":
			return $this->iStockLevel;
			break;
		case "PhotoPath":
			return $this->sPhotoPath;
			break;
		case "Active":
			return $this->iActive;
			break;
		default:
			die($sProperty ." is not allowed to read from");

		}

	}






}


/////////////////TESTING////////////////////

$oTest = new Products();

$oTest->load(2);

echo "<pre>";
 print_r($oTest);
 echo "</pre>";

	




 ?>