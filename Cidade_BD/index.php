<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Cidades</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
        <?php
            $servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "brasil";

			//Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
		
			//Check connection
			if($conn->connect_error){
				die("Connection failed: " .$conn->connect_error);
			}
        ?>
        <div class="card mt-4" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Estados</h5>
                <label for="cod_estados">Estado:</label>
                <select name="cod_estados" id="cod_estados">
                    <option value="">-- Escolha um estado --</option>
                    <?php
                        $res = mysqli_query( $conn, "SELECT cod_estados, sigla FROM estados ORDER BY sigla ");
                        while ( $row = mysqli_fetch_assoc( $res ) ) {
                            echo '<option value="'.$row['cod_estados'].'">'.$row['sigla'].'</option>';
                        }
                    ?>
                </select>
                <label for="cod_cidades">Cidade:</label>
                <select name="cod_cidades" id="cod_cidades">
                    <option value="">-- Escolha uma cidade --</option>
                </select>
            </div>
        </div>             
		<script type="text/javascript">
			const estadosSelect = document.querySelector('#cod_estados');
			const cidadesSelect = document.querySelector('#cod_cidades');
			estadosSelect.addEventListener('change', e => {
				fetch(`./cidades.ajax.php?cod_estados=${e.target.value}`,{method:'GET'})
				.then(dados => dados.json()) //descodifica a resposta
				.then(dados => {
					cidadesSelect.innerHTML = '';
					dados.forEach(e=>{
						const option = document.createElement('option');
						option.innerText = e.nome;
						cidadesSelect.appendChild(option);
					})
					console.log()
				}) // exibi a resposta
				.catch(err => console.log(err));
			});
			
		</script>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>