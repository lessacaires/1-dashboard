<?php
	//conexão com banco de dados
	include_once('../conexao.php');
	//pegando tipo de consulta: listagem ou contador
   	$tipo=$_GET['tipo'];
	//se o tipo for listagem
   	if($tipo=='listagem'){ 
   		$pag=$_GET['pag']; 
   		$maximo=$_GET['maximo'];
		$inicio = ($pag * $maximo) - $maximo; //Variável para LIMIT da sql
		?>
		<tr>
			<td>ID</td>
			<td>Nome</td>
			<td>E-mail</td>
		</tr>
		<?php
   		$sql="SELECT * FROM usuarios ORDER BY usu_id LIMIT $inicio, $maximo"; //consulta no BD
				$resultados = mysqli_query($con, $sql);
				if (@mysqli_num_rows($resultados) == 0) //Se não retornar nada
				echo("Nenhum cadastro encontrado");
				while ($res=mysqli_fetch_array($resultados)) { //laço para listagem de itens
				$id = $res[0];
				$nome = $res[1];
				$email = $res[2];	
			?>
			<tr>
				<td><?php echo $id ?></td>
				<td><?php echo $nome ?></td>
				<td><?php echo $email?></td>
			</tr>
			<?php } 
	//se o tipo for contador
   	}else if($tipo=='contador'){
   		$sql_res=mysqli_query($con, "SELECT * FROM usuarios"); //consulta no banco
		$contador=mysqli_num_rows($sql_res); //Pegando Quantidade de itens
		echo $contador;
   	}else{
   		echo "Solicitação inválida";
   	}
?>