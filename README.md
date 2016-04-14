# ephp #


## EasyPhp documentaci&oacute;n ##

EasyPhp es una herramienta creada para el r&aacute;pido desarrollo de aplicaciones php orientadas a soluciones a la medida.

### Setup ###

La configuraci&oacute;n general de base de datos y rutas se adaptar&aacute; en

> /lib/Configuracion.php

Antes de comenzar a crear tablas es necesario ejecutar cuando menos una vez en un explorador el administrador
el cual utilizará

>/lib/Wizard.php

para crear las tablas base.

###### Accesos default

El usuario y contraseña default para poder entrar al administrador serán

><ul><li><strong>Usuario</strong>:admin@efphp.</li><li><strong>Contraseña</strong>:admin</li></ul>


##### Módulos default

Como default se generan las siguientes tablas

><ul>
    <li><strong>admin</strong>: Contiene el usuario base ADMINISTRADOR, almacenará futuros usuarios.</li>
    <li><strong>rol</strong>: Contiene el rol base ADMINISTRADOR, almacenará futuros roles. </li>
    <li><strong>cms</strong>: Contiene un ejemplo de contenido html el cual es mostrado en el frontend /BASEURL/index.php en el explorador</li>
    <li><strong>menu</strong>: Contiene el menú raiz de donde heredarán todos los menús además de "home" el cual podrá visualizarse en el menú de /BASEURL/index.php en el explorador</li>
    <li><strong>log</strong>: Almacena todas las actividades que se realizen por parte de cualquier usuario, login, intento (satisfactorio o fallido) de abc.</li>
</ul>

##### Creación de tablas custom

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


##### Tipos de datos para backend

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


Cada columna de la tabla puede tener un comentario el cual hará que funcione de la siguiente manera.

>'Etiqueta para mostrar en formularios-Tipo de validación-Tipo de servicio'

e.g.

> [Título-tel-normal]

Esto tendrá como resultado mostrar en el administrador la etiqueta en el input sustuyendo el nombre de la columna por "Título", el valor será validado como teléfono.
(El tercer parámetro está en desarrollo)

Para agregar tipos de validación se puede modificar/agregar en

> /js/lib.js:validator.validator(type, val, selector)

Un ejemplo de creación de tabla con estas características:

>$table = "CREATE TABLE `cms` (
           `id` int(11) NOT NULL AUTO_INCREMENT,
           `nombre` varchar(255) DEFAULT NULL COMMENT 'Título-text',
           `tag` varchar(255) NOT NULL COMMENT 'Tag-text',
           `cms_contenido` text  NOT NULL COMMENT 'Contenido CMS-text',
           PRIMARY KEY (`id`)
         ) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8";


### Implementaci&oacute;n Frontend###

Una vez configurado el proyecto se podr&aacute; acceder como usuario a 

> BASEURL/index.php

Toda secci&oacute;n que se quiera agregar al usuario se localizar&aacute; en 

> /vistas
 e.g. /vistas/contacto.php

Y podrá ser invocada mediante la siguiente ruta

> BASEURL/?s=contacto

#### Contenido ####

El contenido puede ser html puro o pueden utilizarse placeholers para que invoque bloques desde la base de datos mostrando el resultado de la tabla `cms`.

Para poder hacer esto es necesario crear un nuevo registro en el backend de cms. La columna tag será el identificador para poderlo mostrar en el frontend.

>e.g. tag:contacto

la utilización sería de la siguiente manera

>en /vistas/contacto.php se podrá poner cualquier contenido HTML y en donde se desee mostrar el contenido del cms de tendrá que utilizar la siguiente nomenclatura {{tag}} el cual será igual al nombre del tag teniendo como resultado {{contacto}}.

#### Menú ####

El menú podrá administrarse desde el backend y podrá tener herencia anidada infinita tomando como padre id_menú.
Si se utiliza "Main_Category" como padre se mostrará en el menú principal superior y esta será (o no) padre de otras y así sucesivamente.
La url será idéntica a como se quiera utilizar

> ?s=contacto


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