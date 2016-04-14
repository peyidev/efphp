# ephp #


## EasyPhp documentaci&oacute;n ##

EasyPhp es una herramienta orientada al r&aacute;pido desarrollo de aplicaciones php orientadas a peque&ntilde;os negocios y sistemas de baja disponibilidad.

### Setup ###

El primer requisito para implementar la herramienta es el modelo de la base de datos.
La base de datos deberá seguir la siguientes reglas

> 1. Las llaves primarias deber&aacute;n llamarse "id"
> 2. Las llaves foraneas deber&aacute;n llamarse "id_tablaQueRelaciona"
> 3. Deber&aacute; tener la columna "nombre" cada tabla que sea relacionada
> e.g.

>	<table>
		<tr>
			<td><strong>administrador</strong></td>
		</tr>
		<tr>
			<td>id:int(11)</td>
		</tr>
		<tr>
			<td>id_rol:int(11)</td>
		</tr>
		<tr>
			<td>nombre:varchar(255)</td>
		</tr>
		<tr>
			<td>usuario:varchar(255)</td>
		</tr>
		<tr>
			<td>password:varchar(255)</td>
		</tr>
	</table>
	<table>
		<tr>
			<td><strong>rol</strong></td>
		</tr>
		<tr>
			<td>id:int(11)</td>
		</tr>
		<tr>
			<td>nombre:varchar(255)</td>
		</tr>
	</table>


Los tipos de datos y nombre de las columnas así como sus comentarios hacen que se comporten de manera distinta en el admin.

><table>
    <thead>
        <tr><th>Nomenclatura</th><th>Tipo de dato</td><th>Resultado</th></tr>
    </thead>
    <tbody>
        <tr>
            <td> <strong>id</strong></td>
            <td> int </td>
            <td>
                <ul>
                    <li>Editor: No genera input</li>
                    <li>Grid: Genera botón para ver el detalle del registro</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td> <strong>id_</strong>llaveforanea </td>
            <td> int </td>
            <td>
                <ul>
                    <li>Editor: Genera un dropdown con un join dinámico a la tabla relacionada mostrando la columna nombre de la tabla foránea</li>
                    <li>Grid: Genera un join dinámico que muestra la relación entre la tabla y la tabla relacionada mostrando la columna nombre de la tabla foránea</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td> <strong>cms_</strong>nombrecolumna </td>
            <td> text </td>
            <td>
                <ul>
                    <li>Editor: Genera un input con un editor WYSIWYG, acepta html, css, javascript </li>
                    <li>Grid: Muestra botón que lleva al preview del texto</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td> nombrecolumna </td>
            <td> date </td>
            <td>
                <ul>
                    <li>Editor: Genera un calendario dinámico que es mostrado cuando se da click en el input </li>
                    <li>Grid: Muestra el valor de la columna guardado sin alteración</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td> <strong>img_</strong>nombrecolumna </td>
            <td> varchar(255) </td>
            <td>
                <ul>
                    <li>Editor: Genera un input de tipo file el cual recibe extensiones [.png, .jpg, .gif] y guarda los archivos en /media/img/ </li>
                    <li>Grid: Muestra el nombre del archivo</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td> <strong>bool_</strong>nombrecolumna </td>
            <td>  tinyint(1) </td>
            <td>
                <ul>
                    <li>Editor: Genera un dropdown con opción sí y no [0 = no, 2 = sí] </li>
                    <li>Grid: Muestra ícono check o cross dependiendo el valor</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td> <strong>status_</strong>nombrecolumna </td>
            <td> tinyint(1) </td>
            <td>
                <ul>
                    <li>Editor: Genera un dropdown con opción sí, no y pendiente [0 = no, 1 = pendiente, 2 = sí] </li>
                    <li>Grid: Muestra ícono check, cross o admiración dependiendo el valor</li>
                </ul>
            </td>
        </tr>
    </tbody>
</table>


La configuraci&oacute;n general de base de datos y rutas se adaptar&aacute; en

> /lib/Configuracion.php

	
### Implementaci&oacute;n Frontend###

Una vez configurado el proyecto se podr&aacute; acceder como usuario a 

> BASEURL/index.php

Toda secci&oacute;n que se quiera agregar al usuario se localizar&aacute; en 

> /vistas
 e.g. /vistas/contacto.php

Y podrá ser invocada mediante la siguiente ruta

> BASEURL/?s=contacto

#### javascript ####

La funcionalidad javascript est&aacute; deber&aacute; codificarse dentro de

> /js/vistas.js

Teniendo dos funcionalidades

> global : function(){}

Aqu&iacute; se condificar&aacute; todas las acciones generales del sitio.

Se deber&aacute;n agregar funciones extras con el nombre de la vista que se quiera ejecutar en particular para todas las funciones que NO sean globales

> e.g.
  global : function(){},
  contacto : function(){ alert("Yo soy el contacto")}

#### css ####

Todos los estilos del sitio deber&aacute;n estar situados en 

> /css/style.css

#### php ####

Todas las clases deber&aacute;n nombrarse con el mismo nombre del archivo en may&uacute;sculas y podr&aacute;n ser ejecutadas con un controlador gen&eacute;rico de la siguiente manera

> /lib/Execute.php?e=ClaseParaEjecutar/metodoParaEjecutar

Pudiendo agregar como parametro 

> /lib/Execute.php?e=ClaseParaEjecutar/metodoParaEjecutar&back=1

Para cuando se requiere regresar de manera autom&aacute;tica a la p&aacute;gina que invoca el servicio

### Implementaci&oacute;n Administrador ###

El administrador deber&aacute; ser previamente configurado de la siguiente manera

> /admin/config/menu.xml

Contiene la estructura de men&uacute; necesaria para cada rol de cada usuario administrador (v&eacute;ase archivo menu.xml)

La notaci&oacute;n para generar m&oacute;dulos dentro del administrador ser&aacute; de la siguiente manera

> subitemLink: ?s=tabla-admin

La cual generar&aacute; un administrador de altas bajas y cambios para la tabla seleccionada
1

