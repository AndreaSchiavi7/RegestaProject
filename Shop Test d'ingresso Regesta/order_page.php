<!DOCTYPE html>
<html>
<body>

<?php

$fastest; //meno shippig days
$cheapest; // meno costoso
$idFastSupplier;//id supplier piu veloce
$idCurrentArticle;// id article choosen
$CurrentPrice;//price choosen
$total;// total prize without discount
$totalquantity;// quantita generale
$currentdate = date('y-m-d h:i:s');
$currentdate = date('Y-m-d h:i:s',strtotime($currentdate));//current data e ora

function ShowDataFromDb($sqlquery,$qty)
{
	$servername = "localhost";
	$username = "root";
	$password = "1234";
	$dbname = "PhilipsShops";
	global $fastest; //meno shippig days
	global $cheapest; // meno costoso
	global $idFastSupplier; // id supplier piu veloce
	global $idCurrentArticle;// id article choosen
	global $CurrentPrice;//price choosen
	global $total;// total prize without discount
	global $totalquantity;// quantita generale
	

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

		
    //$data = array();
    $result = $conn->query($sqlquery);
	
    if ($result)
    {
		while($row = $result->fetch_assoc())
        {
			$idCurrentArticle = $row['idArticle'];
			$totalquantity = $row['quantity'];
			$CurrentPrice = $row['price'];
			
			////
			
			echo "<img class='img_article' float='right' width='80px' height='auto' display='inline-block' padding='10px' src=".$row['img_src']."/><br>";
			
            echo"id Article: " . $row['idArticle']. "
			<br>id Supplier: ".$row["idSupplier"]."
			<br>barcode: ".$row["barcode"]."
			<br>Name: ".$row["name"]."
			<br>Description: ".$row["desc"]."
			<br>Date: ".$row["date"]."
			<br>Price: ".$row["price"]."
			<br>Stocks: ".$row["quantity"];
			
			$total= $row["price"] * $qty;
			
			echo "<br>your Total: ".$total."€<br>";
			
			
			if($row['price']==$cheapest){
				echo "The following supplier is the cheapest one<br>";
			}
			else{
				echo"Not the cheapest<br>";
			}
			
			if($idFastSupplier==$row["idSupplier"]){
				echo "The following supplier is the fastest one<br>";
			}
			else{
				echo"Not the fastest<br>";
			}
			
        }
    }
	
	$result->close();
	$conn->close();
	
    //return $data;
	
}

function GetPriceFromDb($sqlquery)
{
	$servername = "localhost";
	$username = "root";
	$password = "1234";
	$dbname = "PhilipsShops";
	global $fastest; //meno shippig days
	global $cheapest; // meno costosoù
	global $idFastSupplier; // id supplier piu veloce
	global $idCurrentArticle;// id article choosen
	global $CurrentPrice;//price choosen
	global $total;// total prize without discount
	global $totalquantity;// quantita generale
	$i=0;


	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	//echo $cheapest;
    //$data = array();
    $result = $conn->query($sqlquery);
    if ($result)
    {
		while($row = $result->fetch_assoc())
        {
			
            if($i==0){
				$cheapest = $row['price'];
				$i++;
			}
			else{
				if($row['price']<$cheapest){
					$cheapest = $row['price'];
				}
				else{
					// non fare niente
				}
			}
        }
    }
	
	$result->close();
	$conn->close();
	
}

function GetSupplierFromDb($sqlquery)
{
	$servername = "localhost";
	$username = "root";
	$password = "1234";
	$dbname = "PhilipsShops";
	global $fastest; //meno shippig days
	global $cheapest; // meno costoso
	global $idFastSupplier; // id supplier piu veloce
	global $idCurrentArticle;// id article choosen
	global $CurrentPrice;//price choosen
	global $total;// total prize without discount
	global $totalquantity;// quantita generale
	$i=0;


	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

		
    //$data = array();
    $result = $conn->query($sqlquery);
    if ($result)
    {
		while($row = $result->fetch_assoc())
        {
			
            if($i==0){
				$fastest = $row['shippingDays'];
				$i++;
			}
			else{
				if($row['shippingDays']<$fastest){
					$fastest = $row['shippingDays'];
					$idFastSupplier=$row['idSupplier'];
				}
				else{
					// non fare niente
				}
			}
        }
    }
	
	$result->close();
	$conn->close();

}

function GetDiscountFromDb($sqlquery,$qty)
{
	$servername = "localhost";
	$username = "root";
	$password = "1234";
	$dbname = "PhilipsShops";
	global $fastest; //meno shippig days
	global $cheapest; // meno costosoù
	global $idFastSupplier; // id supplier piu veloce
	global $idCurrentArticle;// id article choosen
	global $CurrentPrice;//price choosen
	global $total;// total prize without discount
	global $totalquantity;// quantita generale
	global $currentdate;
	$i=0;


	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

    //$data = array();
    $result = $conn->query($sqlquery);
    if ($result)
    {
		while($row = $result->fetch_assoc())
        {
			
            if($row['idArticle']==$idCurrentArticle){
				if($row['Maxpurchase']!=0){
					if($total>$row['Maxpurchase']){
						$subtotal = ($total /100)*$row['discount'];
						$total= $total - $subtotal;
						echo "With discount:".$total."<br>";
					}
					else{
						//echo "No discounts<br>";
					}
				}
				else if ($row['Minpurchase']!=0){
					if($total<$row['Minpurchase']){
						$subtotal = ($total /100)*$row['discount'];
						$total= $total - $subtotal;
						echo "With discount:".$total."<br>";
					}
					else{
						//echo "No discounts<br>";
					}
				}
				else if($row['Maxpurchase']!=0 && $row['Minpurchase']!=0){
					if($total<$row['MinPurchase'] && $total>$row['MaxPurchase']){
						$subtotal = ($total /100)*$row['discount'];
						$total= $total - $subtotal;
						echo "With discount:".$total."<br>";
					}
					else{
						//echo "No discounts<br>";
					}
				}
				else if($row['quantity']!=0){
					if($qty>$row['quantity']){
						$subtotal = ($total /100)*$row['discount'];
						$total= $total - $subtotal;
						echo "With discount:".$total." off:".$row['discount']."%<br>";
					}
					else{
						//echo "No discounts<br>";
					}
				}
				else if ($row['dateStart']!="1900-01-01 00:00:00" && $row['dateEnd']!="1900-01-01 00:00:00"){
					if(($currentdate >= $row['dateStart']) && ($currentdate <= $row['dateEnd']))
					{
						$subtotal = ($total /100)*$row['discount'];
						$total= $total - $subtotal;
						echo "With discount:".$total."<br>";
					}
					else{
						//echo "No discounts<br>";
					}
				}
			}
			else{
				//echo "No discounts";
			}
        }
    }
	
	$result->close();
	$conn->close();
	
}

function UpdateDataFromDb($sqlquery)
{
	$servername = "localhost";
	$username = "root";
	$password = "1234";
	$dbname = "PhilipsShops";


	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	
    $result = $conn->query($sqlquery);
    if ($result == TRUE)
    {
		echo "Record updated successfully<br>";
    }
	else {
		echo "Error updating record ".$conn->error;
	}
	
	//$result->close();
	$conn->close();
		
}

function InsertDataFromDb($sqlquery)
{
	$servername = "localhost";
	$username = "root";
	$password = "1234";
	$dbname = "PhilipsShops";


	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

		
    //$data = array();
    $result = $conn->query($sqlquery);
    if ($result == TRUE)
    {
		echo "New record created successfully<br>";
    }
	else{
		echo "Error: ".$sqlquery."<br>".$conn->error;
	}
	
	$conn->close();
	
    //return $data;
	
}

 $base_url = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 'https' : 'http' ) . '://' .  $_SERVER['HTTP_HOST'];
 $url = $base_url . $_SERVER["REQUEST_URI"];
 $url_components = parse_url($url);
 parse_str($url_components['query'], $query);

 if(isset($query['supplier'])){
	/*echo $query['barcode'];
	echo '-';
	echo $query['qty'] ;
	echo '-';
	echo $query['supplier'];
	echo '</br>';*/
 
	//condizioni
	$queryArticle="SELECT * FROM article";
	$ArticleArray = GetPriceFromDb($queryArticle);
 
	$querySupplier="SELECT * FROM supplier";
	$SupplierArray = GetSupplierFromDb($querySupplier);
 
	$barcode = $query['barcode'];
	$qty = $query['qty'];
	$idSupplier = $query['supplier'];
	$sqlquery = "SELECT * FROM article WHERE barcode = $barcode AND idSupplier = $idSupplier";
 
	//prendi il parametro stock
	$ArticleRow = ShowDataFromDb($sqlquery,$qty);
 
	$queryDiscount="SELECT * FROM discount";
	$DiscountArray = GetDiscountFromDb($queryDiscount,$qty);
 
	//UPDATE parametro stock - qty comprata sul db
	if($qty<=$totalquantity && $qty!=0){
		echo "<p><span style='color:green'>Order confirmed </p>";
		$newquantity = $totalquantity-$qty;
		$queryUpdate = "UPDATE article SET quantity = $newquantity WHERE barcode = $barcode AND idSupplier = $idSupplier";
		$ArticleArray = UpdateDataFromDb($queryUpdate);
	
		//INSERT ordine sul db
		$queryOrder = "INSERT INTO philipsshops.order (date,idSupplier,price,idArticle,QuantityBought,enable,dt)
					   VALUES ('$currentdate',$idSupplier,$CurrentPrice,$idCurrentArticle,$qty,1,1)";
		$ArticleArray = InsertDataFromDb($queryOrder);
	}
	else if($qty==0){
		echo "<p><span style='color:red'>Order Failed <br>
	          Error quantity </p>";
	}
	else{
		echo "<p><span style='color:red'>Order Failed <br>
	         Not enough stock</p>";
	}
 }
 else{
	echo "Error non hai scelto un supplier";
 }
 
?>

</body>
</html>