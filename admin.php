<?php

require "dbBroker.php";
require "model/knjiga.php";

session_start();

if(empty($_SESSION['admin']) || $_SESSION['admin'] == ''){
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


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/admin.css">
    <title>Admin page</title>
</head>
<body>

<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

<div class="container">
    <div class="row clearfix">
    	<div class="col-md-12 table-responsive">
			<table class="table table-bordered table-hover table-sortable" id="tab_logic">
				<thead>
					<tr >
                        <th class="text-center" style="display: none;"> 
							Id
						</th>
						<th class="text-center">
							Naslov
						</th>
						<th class="text-center">
							Autor
						</th>
						<th class="text-center">
							Godina 
						</th>
    					<th class="text-center">
							Cena u dinarima
						</th>
        				<th class="text-center" style="border-top: 1px solid #ffffff; border-right: 1px solid #ffffff;">
						</th>
					</tr>
				</thead>
				<tbody class="tableBody">
    				<?php
					while($red = $result->fetch_array()){
					?>					
						<tr id='<?php echo $red['knjigaId']?>' data-id="0" class="hidden" >
                        <td data-name="id" style="display: none;">
						    <input value="<?php echo $red["knjigaId"]?>" type="text" name='id'  class="form-control"  readonly = "true"/>
						</td>
						<td data-name="name">
						    <input value="<?php echo $red["naslov"]?>" type="text" name='name' required placeholder='Naslov' class="form-control" />
						</td>
						<td data-name="autor">
						    <input value="<?php echo $red["autor"]?>" type="text" name='autor' required placeholder='Autor' class="form-control" />
						</td>
						<td data-name="godina">
                             <input value="<?php echo $red["godinaNastanka"]?>" type="text" name='godina' required placeholder='Godina' class="form-control" />
						</td>
    					<td data-name="cena">
                            <input value="<?php echo $red["cena"]?>" type="text" name='cena' required placeholder='Cena' class="form-control" />
						</td>
                        <td data-name="del">
                            <button id = "dugme <?php echo $red["knjigaId"]?>" onclick="obrisi(this.id)" name="del0" class='btn btn-danger glyphicon glyphicon-remove row-remove'><span aria-hidden="true">×</span></button>
                        </td>
					</tr>
					<?php
					}
					?>
					<tr class="add" data-id="0" class="hidden" >
                        <td data-name="id" style="display: none;">
						    <input type="text" name='id' class="form-control"  readonly = "true"/>
						</td>
						<td data-name="name">
						    <input type="text" name='name' required placeholder='Naslov' class="form-control" />
						</td>
						<td data-name="autor">
						    <input type="text" name='autor' required placeholder='Autor' class="form-control" />
						</td>
						<td data-name="godina">
                             <input type="text" name='godina' required placeholder='Godina' class="form-control" />
						</td>
    					<td data-name="cena">
                            <input type="text" name='cena' required placeholder='Cena' class="form-control" />
						</td>
                        <td data-name="del">
                            <button onclick="obrisi(this.id)" name="del0" class='btn btn-danger glyphicon glyphicon-remove row-remove'><span aria-hidden="true">×</span></button>
                        </td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<a id="add_row" class="btn btn-primary float-right" onclick="dodaj()">Dodaj knjigu</a>
</div>

<a href="logout.php" style="position: absolute; top: 10px; right:10px; "><button>Logout</button></a>

<script src="/js/admin.js"></script>

</body>
</html>