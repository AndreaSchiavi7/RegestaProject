<!DOCTYPE html>
<html>
<body>

<style>
.img_article{
	float:right;
	width:80px;
	height:auto;
	display:inline-block;
	padding:10px;
}

.row{
	margin:5px;
	padding:10px;
	border:1px solid black;
	border-radius:5px;
	background:#dfdfdf;
	display:inline-block;
	float:left;
	text-align: center;
	width: 300px;
}

.orderQty, .barcode{
	float:left;	
}

.barcode{
	display:none;
}

h3{
	float:left;
}

.supplierContainer{
	width: calc(100% - 40px);
	padding:20px;
	display: inline-block;
	text-align:left;
}

.button_buy{
	clear:both;
	display:block;
}

</style>

<h1>SHOP</h1>

<?php

function GetDataFromDb($sqlquery)
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

		
    $data = array();
    $result = $conn->query($sqlquery);
    if ($result)
    {
		while($row = $result->fetch_assoc())
        {
            $data[] = $row;
        }
    }
	
	$result->close();
	$conn->close();
	
    return $data;
}




$queryArticle = "SELECT * FROM article";
$ArticleArray = GetDataFromDb($queryArticle);


$querySupplier = "SELECT * FROM supplier";
$SupplierArray = GetDataFromDb($querySupplier);

//ARRAY Article to show
$articleGrouped = array();

$div ='<div class="panel-body">';

if (count($ArticleArray, COUNT_NORMAL)> 0) {
	
	//while($Article = $resultArticle->fetch_assoc()) {
	foreach ($ArticleArray as $Article) {	
		if (count($articleGrouped, COUNT_NORMAL)==0){
			$articleGrouped[] = $Article['name'];
		}
		else
		{
			$foundArticle=0;
			foreach ($articleGrouped as $Art) {
				if($Art==$Article['name']) {
					$foundArticle=1;
					break;
				}
			}
			
			if ($foundArticle == 0){
				$articleGrouped[] = $Article['name'];
			}
		}
	}
	
	$min_price = 0;
	$min_shipping = 0;
	
	foreach ($articleGrouped as $Art) {
		$div .='<div class="row">';// add css classes and the like here. In case you don't know, the .= operators concatenate the strings that will make your html code.
		$div .=' <form action="/order_page.php">';
		$div .='    <div class="col-md-4">'; // be careful with this class, as you might need to evaluate it for every run of the loop
		$div .='        <div class="thumbnail">';
		$div .='            <h3>' . $Art .'</h3>';
		

		$already_set_img = 0;
		$min_price = 0;
		$min_shipping = 0;
		
		foreach ($ArticleArray as $Article) {
			if($Art==$Article['name']) {
				foreach ($SupplierArray as $Supplier) {
						if($Article['idSupplier']==$Supplier["idSupplier"]){
							if ($min_price == 0)
								$min_price = $Article["price"];
							
							if ($Article["price"] < $min_price)
								$min_price = $Article["price"];
							
							if($min_shipping == 0)
								$min_shipping = $Supplier["shippingDays"];
							
							if($Supplier["shippingDays"] < $min_shipping)
								$min_shipping = $Supplier["shippingDays"];
						}
				}
			}
		}
		
		foreach ($ArticleArray as $Article) {

			if($Art==$Article['name']) {
				
				if ($already_set_img == 0)
				{
					$div .='            <img class="img_article" src="'.$Article["img_src"].'"/>';
					$div .='            <input class="barcode" type="text" name="barcode" value="'.$Article["barcode"].'"/>';
					$div .='            <input class="orderQty" type="number" name="qty" value="0"/>';
					$div .='            <input class="button_buy" type="submit" value="Ordina">';
					$already_set_img=1;
				}
				
				foreach ($SupplierArray as $Supplier) {
					if($Article['idSupplier']==$Supplier["idSupplier"]){
						$div .='       <div class="supplierContainer">';
						$div .='            <input type="radio" id="html" name="supplier" value="'.$Supplier["idSupplier"].'">';
						$div .='            <div>' .$Supplier["name"].'</div>';
						$div .='            <div>Stock: ' .$Article["quantity"].'</div>';
						
						if ($min_price == $Article["price"])
							$div .='            <div style="color:green">€ ' .$Article["price"].'</div>';
						else
							$div .='            <div>€ ' .$Article["price"].'</div>';
						if ($min_shipping == $Supplier["shippingDays"])
							$div.='				<div Style = "color:green">Shipping '.$Supplier["shippingDays"].' days</div>';
						else
							$div.='             <div>Shipping '.$Supplier["shippingDays"].' days</div>';
						$div .='       </div>';
					}
				}
			}

			
			
		}
		$div .='        </div>';
		$div .='    </div>';
		$div .=' </form>';
		$div .='</div>';
	}
	
	
	
}else {
  echo "0 results";
}

$div .= '</div>'; // And here you close the main div.


?> 

<?php echo $div; ?>

</body>
</html>
