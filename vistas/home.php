<section id="main_content">
    <h2>
        <a aria-hidden="true" href="#easyphp-documentaci%C3%B3n" class="anchor" id="easyphp-documentación"><span class="octicon octicon-link" aria-hidden="true"></span></a>EasyPhp documentación</h2>

    <p>EasyPhp es una herramienta orientada al rápido desarrollo de aplicaciones php orientadas a pequeños negocios y sistemas de baja disponibilidad.</p>

    <h3>
        <a aria-hidden="true" href="#setup" class="anchor" id="setup"><span class="octicon octicon-link" aria-hidden="true"></span></a>Setup</h3>

    <p>El primer requisito para implementar la herramienta es el modelo de la base de datos.
        La base de datos deberá seguir la siguientes reglas</p>

    <blockquote>
        <ol>
            <li>Las llaves primarias deberán llamarse "id"</li>
            <li>Las llaves foraneas deberán llamarse "id_tablaQueRelaciona"</li>
            <li>
                <p>Deberá tener la columna "nombre" cada tabla que sea relacionada
                    e.g.</p>

                <table>
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
                    </tbody></table>

                <p></p>
                <table>
                    <tbody><tr>
                        <td><strong>rol</strong></td>
                    </tr>
                    <tr>
                        <td>id:int(11)</td>
                    </tr>
                    <tr>
                        <td>nombre:varchar(255)</td>
                    </tr>
                    </tbody></table>
            </li>
        </ol>
    </blockquote>

    <p>La configuración general de base de datos y rutas se adaptará en</p>

    <blockquote>
        <p>/lib/Configuracion.php</p>
    </blockquote>

    <h3>
        <a aria-hidden="true" href="#implementaci%C3%B3n-frontend" class="anchor" id="implementación-frontend"><span class="octicon octicon-link" aria-hidden="true"></span></a>Implementación Frontend</h3>

    <p>Una vez configurado el proyecto se podrá acceder como usuario a </p>

    <blockquote>
        <p>BASEURL/index.php</p>
    </blockquote>

    <p>Toda sección que se quiera agregar al usuario se localizará en </p>

    <blockquote>
        <p>/vistas
            e.g. /vistas/contacto.php</p>
    </blockquote>

    <p>Y podrá ser invocada mediante la siguiente ruta</p>

    <blockquote>
        <p>BASEURL/?s=contacto</p>
    </blockquote>

    <h4>
        <a aria-hidden="true" href="#javascript" class="anchor" id="javascript"><span class="octicon octicon-link" aria-hidden="true"></span></a>javascript</h4>

    <p>La funcionalidad javascript está deberá codificarse dentro de</p>

    <blockquote>
        <p>/js/vistas.js</p>
    </blockquote>

    <p>Teniendo dos funcionalidades</p>

    <blockquote>
        <p>global : function(){}</p>
    </blockquote>

    <p>Aquí se condificará todas las acciones generales del sitio.</p>

    <p>Se deberán agregar funciones extras con el nombre de la vista que se quiera ejecutar en particular para todas las funciones que NO sean globales</p>

    <blockquote>
        <p>e.g.
            global : function(){},
            contacto : function(){ alert("Yo soy el contacto")}</p>
    </blockquote>

    <h4>
        <a aria-hidden="true" href="#css" class="anchor" id="css"><span class="octicon octicon-link" aria-hidden="true"></span></a>css</h4>

    <p>Todos los estilos del sitio deberán estar situados en </p>

    <blockquote>
        <p>/css/style.css</p>
    </blockquote>

    <h4>
        <a aria-hidden="true" href="#php" class="anchor" id="php"><span class="octicon octicon-link" aria-hidden="true"></span></a>php</h4>

    <p>Todas las clases deberán nombrarse con el mismo nombre del archivo en mayúsculas y podrán ser ejecutadas con un controlador genérico de la siguiente manera</p>

    <blockquote>
        <p>/lib/Execute.php?e=ClaseParaEjecutar/metodoParaEjecutar</p>
    </blockquote>

    <p>Pudiendo agregar como parametro </p>

    <blockquote>
        <p>/lib/Execute.php?e=ClaseParaEjecutar/metodoParaEjecutar&amp;back=1</p>
    </blockquote>

    <p>Para cuando se requiere regresar de manera automática a la página que invoca el servicio</p>

    <h3>
        <a aria-hidden="true" href="#implementaci%C3%B3n-administrador" class="anchor" id="implementación-administrador"><span class="octicon octicon-link" aria-hidden="true"></span></a>Implementación Administrador</h3>

    <p>El administrador deberá ser previamente configurado de la siguiente manera</p>

    <blockquote>
        <p>/admin/config/menu.xml</p>
    </blockquote>

    <p>Contiene la estructura de menú necesaria para cada rol de cada usuario administrador (véase archivo menu.xml)</p>

    <p>La notación para generar módulos dentro del administrador será de la siguiente manera</p>

    <blockquote>
        <p>subitemLink: ?s=tabla-admin</p>
    </blockquote>

    <p>La cual generará un administrador de altas bajas y cambios para la tabla seleccionada</p>
</section>