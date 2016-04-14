<section id="main_content">
    <h1>
        <a aria-hidden="true" href="#ephp" class="anchor" id="ephp"><span class="octicon octicon-link" aria-hidden="true"></span></a>ephp</h1>

    <h2>
        <a aria-hidden="true" href="#easyphp-documentaci%C3%B3n" class="anchor" id="easyphp-documentación"><span class="octicon octicon-link" aria-hidden="true"></span></a>EasyPhp documentación</h2>

    <p>EasyPhp es una herramienta creada para el rápido desarrollo de aplicaciones php orientadas a soluciones a la medida.</p>

    <h3>
        <a aria-hidden="true" href="#setup" class="anchor" id="setup"><span class="octicon octicon-link" aria-hidden="true"></span></a>Setup</h3>

    <p>La configuración general de base de datos y rutas se adaptará en</p>

    <div class="table-well well well-lg">
        <p>/lib/Configuracion.php</p>
    </div>

    <p>Antes de comenzar a crear tablas es necesario ejecutar cuando menos una vez en un explorador el administrador
        el cual utilizará</p>

    <div class="table-well well well-lg">
        <p>/lib/Wizard.php</p>
    </div>

    <p>para crear las tablas base.</p>

    <h3>
        <a aria-hidden="true" href="#accesos-default" class="anchor" id="accesos-default"><span class="octicon octicon-link" aria-hidden="true"></span></a>Accesos default</h3>

    <p>El usuario y contraseña default para poder entrar al administrador serán</p>

    <div class="table-well well well-lg">
        <ul>
            <li>
                <strong>Usuario</strong>:admin@efphp.</li>
            <li>
                <strong>Contraseña</strong>:admin</li>
        </ul>
    </div>

    <h3>
        <a aria-hidden="true" href="#m%C3%B3dulos-default" class="anchor" id="módulos-default"><span class="octicon octicon-link" aria-hidden="true"></span></a>Módulos default</h3>

    <p>Como default se generan las siguientes tablas</p>

    <div class="table-well well well-lg">
        <ul>
            <li>
                <strong>admin</strong>: Contiene el usuario base ADMINISTRADOR, almacenará futuros usuarios.</li>
            <li>
                <strong>rol</strong>: Contiene el rol base ADMINISTRADOR, almacenará futuros roles. </li>
            <li>
                <strong>cms</strong>: Contiene un ejemplo de contenido html el cual es mostrado en el frontend /BASEURL/index.php en el explorador</li>
            <li>
                <strong>menu</strong>: Contiene el menú raiz de donde heredarán todos los menús además de "home" el cual podrá visualizarse en el menú de /BASEURL/index.php en el explorador</li>
            <li>
                <strong>log</strong>: Almacena todas las actividades que se realizen por parte de cualquier usuario, login, intento (satisfactorio o fallido) de abc.</li>
        </ul>
    </div>

    <h3>
        <a aria-hidden="true" href="#creaci%C3%B3n-de-tablas-custom" class="anchor" id="creación-de-tablas-custom"><span class="octicon octicon-link" aria-hidden="true"></span></a>Creación de tablas custom</h3>

    <p>El primer requisito para implementar la herramienta es el modelo de la base de datos.
        La base de datos deberá seguir la siguientes reglas</p>

        <ol>
            <li>Las llaves primarias deberán llamarse "id"</li>
            <li>Las llaves foraneas deberán llamarse "id_tablaQueRelaciona"</li>
            <li>
                <p>Deberá tener la columna "nombre" cada tabla que sea relacionada
                    e.g.</p>

                <div class="table-well well well-lg">
                    <table class="table">
                        <tbody><tr>
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
                        </tbody>
                    </table>
                </div>
                <div class="table-well well well-lg">
                    <table class="table">
                        <tbody><tr>
                            <td><strong>rol</strong></td>
                        </tr>
                        <tr>
                            <td>id:int(11)</td>
                        </tr>
                        <tr>
                            <td>nombre:varchar(255)</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </li>
        </ol>


    <h3>
        <a aria-hidden="true" href="#tipos-de-datos-para-backend" class="anchor" id="tipos-de-datos-para-backend"><span class="octicon octicon-link" aria-hidden="true"></span></a>Tipos de datos para backend</h3>

    <p>Los tipos de datos y nombre de las columnas así como sus comentarios hacen que se comporten de manera distinta en el admin.</p>

    <div class="table-well well well-lg">
        <table class="table">
            <thead>
            <tr>
                <th>Nomenclatura</th>
                <th>Tipo de dato</th>
                <th>Resultado</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td> <strong>id</strong>
                </td>
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
    </div>

    <p>Cada columna de la tabla puede tener un comentario el cual hará que funcione de la siguiente manera.</p>

    <div class="table-well well well-lg">
        <p>'Etiqueta para mostrar en formularios-Tipo de validación-Tipo de servicio'</p>
    </div>

    <p>e.g.</p>

    <div class="table-well well well-lg">
        <p>[Título-tel-normal]</p>
    </div>

    <p>Esto tendrá como resultado mostrar en el administrador la etiqueta en el input sustuyendo el nombre de la columna por "Título", el valor será validado como teléfono.
        (El tercer parámetro está en desarrollo)</p>

    <p>Para agregar tipos de validación se puede modificar/agregar en</p>

    <div class="table-well well well-lg">
        <p>/js/lib.js:validator.validator(type, val, selector)</p>
    </div>

    <p>Un ejemplo de creación de tabla con estas características:</p>

    <div class="table-well well well-lg">
        <pre>$table = "CREATE TABLE <code>cms</code> (
            <code>id</code> int(11) NOT NULL AUTO_INCREMENT,
            <code>nombre</code> varchar(255) DEFAULT NULL COMMENT 'Título-text',
            <code>tag</code> varchar(255) NOT NULL COMMENT 'Tag-text',
            <code>cms_contenido</code> text  NOT NULL COMMENT 'Contenido CMS-text',
            PRIMARY KEY (<code>id</code>)
            ) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8";</pre>
    </div>

    <h3>
        <a aria-hidden="true" href="#implementaci%C3%B3n-frontend" class="anchor" id="implementación-frontend"><span class="octicon octicon-link" aria-hidden="true"></span></a>Implementación Frontend</h3>

    <p>Una vez configurado el proyecto se podrá acceder como usuario a </p>

    <div class="table-well well well-lg">
        <p>BASEURL/index.php</p>
    </div>

    <p>Toda sección que se quiera agregar al usuario se localizará en </p>

    <div class="table-well well well-lg">
        <p>/vistas
            e.g. /vistas/contacto.php</p>
    </div>

    <p>Y podrá ser invocada mediante la siguiente ruta</p>

    <div class="table-well well well-lg">
        <p>BASEURL/?s=contacto</p>
    </div>

    <h4>
        <a aria-hidden="true" href="#contenido" class="anchor" id="contenido"><span class="octicon octicon-link" aria-hidden="true"></span></a>Contenido</h4>

    <p>El contenido puede ser html puro o pueden utilizarse placeholers para que invoque bloques desde la base de datos mostrando el resultado de la tabla <code>cms</code>.</p>

    <p>Para poder hacer esto es necesario crear un nuevo registro en el backend de cms. La columna tag será el identificador para poderlo mostrar en el frontend.</p>

    <div class="table-well well well-lg">
        <p>e.g. tag:contacto</p>
    </div>

    <p>la utilización sería de la siguiente manera</p>

    <div class="table-well well well-lg">
        <p>en /vistas/contacto.php se podrá poner cualquier contenido HTML y en donde se desee mostrar el contenido del cms se tendrá que utilizar la siguiente nomenclatura {{tag}} el cual será igual al nombre del tag teniendo como resultado {{contacto}}.</p>
    </div>

    <h4>
        <a aria-hidden="true" href="#men%C3%BA" class="anchor" id="menú"><span class="octicon octicon-link" aria-hidden="true"></span></a>Menú</h4>

    <p>El menú podrá administrarse desde el backend y podrá tener herencia anidada infinita tomando como padre id_menú.
        Si se utiliza "Main_Category" como padre se mostrará en el menú principal superior y esta será<br /> (o no) padre de otras y así sucesivamente.
        La url será idéntica a como se quiera utilizar</p>

    <div class="table-well well well-lg">
        <p>?s=contacto</p>
    </div>

    <h4>
        <a aria-hidden="true" href="#javascript" class="anchor" id="javascript"><span class="octicon octicon-link" aria-hidden="true"></span></a>javascript</h4>

    <p>La funcionalidad javascript está deberá codificarse dentro de</p>

    <div class="table-well well well-lg">
        <p>/js/vistas.js</p>
    </div>

    <p>Teniendo dos funcionalidades</p>

    <div class="table-well well well-lg">
        <p>global : function(){}</p>
    </div>

    <p>Aquí se condificará todas las acciones generales del sitio.</p>

    <p>Se deberán agregar funciones extras con el nombre de la vista que se quiera ejecutar en particular para todas las funciones que NO sean globales</p>

    <div class="table-well well well-lg">
        <p>e.g.
            global : function(){},
            contacto : function(){ alert("Yo soy el contacto")}</p>
    </div>

    <h4>
        <a aria-hidden="true" href="#css" class="anchor" id="css"><span class="octicon octicon-link" aria-hidden="true"></span></a>css</h4>

    <p>Todos los estilos del sitio deberán estar situados en </p>

    <div class="table-well well well-lg">
        <p>/css/style.css</p>
    </div>

    <h2>
        <a aria-hidden="true" href="#avanzado" class="anchor" id="avanzado"><span class="octicon octicon-link" aria-hidden="true"></span></a>Avanzado</h2>

    <h4>
        <a aria-hidden="true" href="#php" class="anchor" id="php"><span class="octicon octicon-link" aria-hidden="true"></span></a>php</h4>

    <p>Todas las clases deberán nombrarse con el mismo nombre del archivo en mayúsculas y podrán ser ejecutadas con un controlador genérico de la siguiente manera</p>

    <div class="table-well well well-lg">
        <p>/lib/Execute.php?e=ClaseParaEjecutar/metodoParaEjecutar</p>
    </div>

    <p>Pudiendo agregar como parametro </p>

    <div class="table-well well well-lg">
        <p>/lib/Execute.php?e=ClaseParaEjecutar/metodoParaEjecutar/parametro1/parametro2&amp;back=1</p>
    </div>

    <p>esto se convertirá en una llamada similar a</p>

    <div class="table-well well well-lg">
        <p>ObjetoClaseParaEjecutar-&gt;metodoParaEjecutar(parametro1,parametro2);</p>
    </div>

    <p>Para cuando se requiere regresar de manera automática a la página que invoca el servicio (utilizando back=1)</p>

    <h3>
        <a aria-hidden="true" href="#implementaci%C3%B3n-administrador" class="anchor" id="implementación-administrador"><span class="octicon octicon-link" aria-hidden="true"></span></a>Implementación Administrador</h3>

    <p>El administrador deberá ser previamente configurado de la siguiente manera</p>

    <div class="table-well well well-lg">
        <p>/admin/config/menu.xml</p>
    </div>

    <p>Contiene la estructura de menú necesaria para cada rol de cada usuario administrador (véase archivo menu.xml)</p>

    <p>La notación para generar módulos dentro del administrador será de la siguiente manera</p>

    <div class="table-well well well-lg">
        <p>subitemLink: ?s=tabla-admin</p>
    </div>

    <p>La cual generará un administrador de altas bajas y cambios para la tabla seleccionada</p>
</section>

<div>&nbsp;</div>
<div>&nbsp;</div>