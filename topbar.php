<?php
	$str = file_get_contents("https://productsdb-devops-arcada-2018.herokuapp.com/api/products");
	$json = json_decode($str, true);
	if(isset($_SESSION['shopping_cart'])){
	
	}else {
		$_SESSION['shopping_cart'] = array();
	}
?>

<div class="col-12" id="topbar">
	<div class="col-10">
		<a href="index.php"><h4>Shoe shop</h4></a>
	</div>
	<div class="col-2">
			<div class="dropdown">
				<a href="shopping_cart.php"><button class="dropbtn">Cart</button></a>
					<div class="dropdown-content" style="width:200%">
						<?php
							
							$totalAmount = 0;
							if (!empty($_SESSION['shopping_cart'])){
							for ($j = 0;$j<count($_SESSION['shopping_cart']);$j++){
								for ($i = 0;$i<count($json);$i++){
									if($json[$i]['id'] === $_SESSION['shopping_cart'][$j]){
									echo "<td><div class='col-9'>";
									echo "<a href='product_page.php?productid=" . $json[$i]['id'] . "'>" . $json[$i]['name'] . "</a></div>";
									echo "</td>";
									$totalAmount = $totalAmount + $json[$i]['price'];
									}
								}
							}
							}else {echo"<td>Shopping cart</br>is empty!</td></br>";}

							echo "<td>TOTAL: ".$totalAmount."e</td></br>";
						?>
						
						<div class="col-6"><input  style="width:100%" type=button class=btntopbar onClick="location.href='shopping_cart.php'" value="To Cart"></div>
						<form method="post">
						<div class="col-6"><button type="submit" style="width:100%" class=btntopbar name="remove_all">Remove all</button></div></br>
						<button class=btntopbar style="width:100%">CHECKOUT</button></br><!-- missing function -->
						<?php 
							if(isset($_POST['remove_all'])){
								unset($_SESSION['shopping_cart']);
								$_SESSION['shopping_cart'] = array();
								header("Refresh:0");
							}
						?>
						</form>
					</div>
			</div>
		
			<?php
				if (isset($_SESSION['user_info']))
				{
					echo	'<div class="dropdown">
								<a href="account.php"><button class="dropbtn">Account</button>
									<div class="dropdown-content" style="width:200%;right:0%"></a>
										<a href="account.php"><button class=btntopbar style="width:100%"><i class="fas fa-sign"></i>&ensp;Account</button></a></br>
										<form method="post" action="#"><button type="submit" value="Logout" name="logout" class=btntopbar style="width:100%"><i class="fas fa-sign-out-alt"></i>&ensp;Logout</button></form></br>
									</div>
							</div>';
				}
				else
				{
					echo	'<div class="dropdown">
								<a href="login.php"><button class="dropbtn">Login</button></a>
									<div class="dropdown-content" style="width:200%;right:0%">
										<a href="login.php"><button class=btntopbar style="width:100%"><i class="fas fa-sign-in-alt"></i>&ensp;Login</button></a></br>
										<a href="register.php"><button class=btntopbar style="width:100%"><i class="fas fa-sign"></i>&ensp;Register</button></a></br>	
									</div>
							</div>';
				}
				if (isset($_POST['logout']))
				{
					user_logout();
				}
			?>
		</div>
</div>