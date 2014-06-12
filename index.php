<!DOCTYPE html>
<html>
	<head>
		<title>¿Quién ha visitado mi Facebook?</title>
		<meta charset="UTF-8">
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="css/main.css">
	</head>
	<body>
		<div id="header">
			<h1>¿Quién ha visitado mi Facebook?</h1>
		</div>
	
		<div id="info">
			<ol>
				<li>Abre tu Facebook en otra pestaña del navegador.</li>
				<li>Haz clic derecho en un lugar vacío y selecciona <i>"Ver código fuente de la página"</i> o pulsa <strong>Ctrl+U</strong>.</li>
				<li>Pulsa <strong>Ctrl+F</strong> para realizar una búsqueda en el código fuente y escribe <strong><i>friendslist</i></strong>.</li>
				<li>A continuación, verás una lista de identificadores de usuario con el formato:<br />
				<span class="consoletext">"100001234567890-2","100001234567891-2","1166123456-2",...</span></li>
				<li>Copia en la caja de abajo la lista de identificadores que quieres comprobar, pulsa el botón et voilà!</li>
			</ol>
		</div>
	
		<div id="input">
			<form method="post" action="">
				<input class="caja" type="text" name="lista" />
				<input class="boton" type="submit" value="Comprobar!" />
			</form>
		</div>
		
		<?php
		if (isset($_REQUEST['lista'])) $lista = $_REQUEST['lista'];
		if (isset($lista)) {
			?>
			<div id="friendslist">
			<?php
			$array = explode(',', $lista);
			foreach ($array as $id) {
				$id = substr(str_replace('"', '', $id), 0, -2);
				$user = json_decode(file_get_contents("http://graph.facebook.com/$id"));
				?>
				<a href="http://www.facebook.com/<?=$id?>" target="_blank">
					<div class="friend">
						<div class="photo"><img src="http://graph.facebook.com/<?=$id?>/picture"></img></div>
						<div class="name"><?=$user->name?></div>
					</div>
				</a>
				<?php
			}
			?>
			</div>
			<?php
		}
		?>
	</body>
</html>
