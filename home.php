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
  	<title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/home.css">

	</head>
	<body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/home.js"></script>

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
						    <tr id = 'knjiga-<?php echo $red['knjigaId']?>'>
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
						    <tr id = 'rezervacija-<?php echo $red['knjigaId']?>'>
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
		<div><button onclick="dodajRezervaciju()">Dodaj</button></div>
		<br>
		<div>
			<button  onclick="pretrazi()">Nadji po autoru</button>
			<input id = "myInput" type="text" placeholder="Ime autora">
		</div>
		<br>
		<div><button onclick="sortiraj()">Sortitaj po naslovu</button></div>
		<br>
		<div><button onclick="prikazi()">Prikazi sve</button></div>	
		<br>
		<div style="display: block;"><a href = "logout.php" style="position:absolute; top: 10px; right: 10px;"><button>Log out</button></div></a>
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
				 append(knjigaId);

        	} else {
           		 alert("Rezervacija nije dodata, odaberite knjigu")
        	}
    		})

   			 request.fail(function (jqXHR, textStatus, errorThrown) {
        		console.log("Desila se greska: " + textStatus, errorThrown)
    		})
			

		}

		function append(knjigaId){

			let row = $(`#knjiga-${knjigaId} td`);

			console.log(row);

			$("#tabela tbody").append(`
				<tr id = 'knjiga-${knjigaId}'>
					<th scope="row">${knjigaId}</th>
					<td>${row[0].outerText}</td>
					<td>${row[1].outerText}</td>
					<td>${row[2].outerText}</td>					  
				</tr>
			`)
		}
		
	
	</script>

	</body>
</html>

