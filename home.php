<?php

require "dbBroker.php";
require "model/knjiga.php";
require "model/rezervacija.php";

session_start();

if(empty($_SESSION['user']) || $_SESSION['user'] == ''){
	header("Location: login.php");
	die();
}

$result = Knjiga::getAll($conn);

if(!$result){
	echo "Greska kod upita";
}

if($result->num_rows == 0){
	echo "Nema knjiga";
	die();
}

$result1 = Rezervacija::getByUserName($_SESSION['user'], $conn); 

if(!$result1){
	echo "Greska kod upita";
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
  	<title>Table 07</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/home.css">

	</head>
	<body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<h1 class="naslov">DOBRODOSAO <?php echo $_SESSION['user'] ?></h1>
	<div class = "tabele">
	<section class="ftco-section">
		<div class="container">

			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table table-bordered table-dark table-hover">
						  <thead>
						    <tr>
						      <th>#</th>
						      <th>Naslov</th>
						      <th>Autor</th>
						      <th>Godina nastanka</th>
							  <th>Cena</th>
							  <th>Izaberi</th>
						    </tr>
						  </thead>
						  <tbody class="tableBody">
							<?php
								while($red = $result->fetch_array()){
							?>
						    <tr id = '<?php echo $red['knjigaId']?>'>
						      <th scope="row"><?php echo $red['knjigaId']?></th>
						      <td><?php echo $red['naslov']?></td>
						      <td><?php echo $red['autor']?></td>
						      <td><?php echo $red['godinaNastanka']?></td>
							  <td><?php echo $red['cena']?></td>
							  <td class="radio"><input type="radio" name = "izaberi" value=<?php echo $red["knjigaId"] ?>></td>
						    </tr>
							<?php }
							?>							
						  </tbody>
						</table>
					</div>
                    
				</div>
			</div>
		</div>
	</section>


    <section class="ftco-section">
		<div class="container">

			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table id = "tabela" class="table table-bordered table-dark table-hover">
						  <thead>
						    <tr>
							<th>#</th>
						      <th>Naslov</th>
						      <th>Autor</th>
						      <th>Godina nastanka</th>
							  
						    </tr>
						  </thead>
						  <tbody>
						  <?php
								while($red = $result1->fetch_array()){
							?>
						    <tr id = '<?php echo $red['knjigaId']?>'>
						      <th scope="row"><?php echo $red['knjigaId']?></th>
						      <td><?php echo $red['naslov']?></td>
						      <td><?php echo $red['autor']?></td>
						      <td><?php echo $red['godinaNastanka']?></td>					  
						    </tr>
							<?php }
							?>
						  </tbody>
						</table>
					</div>
                    
				</div>
			</div>
		</div>
	</section>
	</div>

	<div class="dugmici">
		<button onclick="dodajRezervaciju()">Dodaj</button>
		<button>Nadji po autoru</button>
		<input type="text">
		<button>Sortitaj po naslovu</button>
	</div>
	
	<script>
		
		function dodajRezervaciju(){
			
			event.preventDefault();

			var buttons = $('.radio input')
			let knjigaId

			for(let i = 0;i<buttons.length;i++){
				if(buttons[i].checked){
					knjigaId = buttons[i].value;
					break;
				}
			}

			let userName = $('.naslov')[0].innerText;
			userName = userName.split(' ')[1];

			let string = "userName=" + userName + "&" + "knjigaId=" + knjigaId

			request = $.ajax({
        		url: "handler/addReservation.php",
        		type: "post",
       			data: string
    		});

    		request.done(function (response, textStatus, jqXHR) {

        		if (response === "Success") {

           		 alert("Rezervacija je dodata")

        	} else {
           		 console.log("Rezervacija nije dodata")
        	}
    		})

   			 request.fail(function (jqXHR, textStatus, errorThrown) {
        		console.log("Desila se greska: " + textStatus, errorThrown)
    		})


		}
		
	
	</script>

	</body>
</html>

