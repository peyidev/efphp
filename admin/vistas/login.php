<div id="logo-admin-block"><img id="logo-admin-img" src='../<?php echo LOGO;?>' alt='' /></div>
<div id="login">
	<form method="post" action="../lib/Execute.php?e=User/loginAdmin&back=1">
		<label for="usr" class='input-login'>Usuario</label><input type="text" id="usr" name="usr" />
		<label for="psw" class='input-login'>Contraseña</label><input type="password" id="psw" name="psw" />
		<input id="login-submit" type="submit" value="Entrar">
	</form>
</div>