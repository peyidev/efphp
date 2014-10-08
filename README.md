# ephp #


## EasyPhp documentaci&oacute;n ##

EasyPhp es una herramienta orientada al r&aacute;pido desarrollo de aplicaciones php orientadas a peque&ntilde;os negocios y sistemas de baja disponibilidad.

### Utilizaci&oacute;n ###

El primer requisito para implementar la herramienta es el modelo de la base de datos.
La base de datos deberá seguir la siguientes reglas

> 1. Las llaves primarias deber&aacute;n llamarse "id"
> 2. Las llaves foraneas deber&aacute;n llamarse "id_tablaQueRelaciona"
> 3. Deber&aacute; tener la columna "nombre" cada tabla que sea relacionada
> e.g.
>>	<table>
		<tr>
			<td>Test</td>
		</tr>
	</table>