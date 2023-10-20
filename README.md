# TestCorsinf

Prueba Tecnica

## Respuesta a la pregunta 2

Como solventaría el siguiente caso
La empresa XYZ tiene en una tabla 10000 registros los cuales se muestran en una web, como Realizaría la exportación en formato csv de estos datos desde la web y evitar el fallo de tiempo de espera.

Existen varias recmendaciones:

1. La más común, realizar paginación al momento de exportar el csv.
2. Exportar por lotes, divide la catidad de registros por lotes más pequeños como por ejemplo de los 1000 lotes de 150.

3. Progrmación Asincrona, con la programación asincrona, podemos ayudar al usuario ha realizar otras tareas q necesita mientras se preparan los registros a ser descargados

---

Explicacion del codigo

El proyecto se separa en difentes carpetas como son la carpeta de:

Vistas - quien posee las vistas , la logica js y el style css cada logica se trata por separado

Models - Son los archivos que poseen las clases para instanciarlas en objetos y posee sus metodos que actuan con la base de datos

Migrations - Son archivo en donde se define la tabla que se va a generar en la base de datos

Libraries - Caperta que tiene las librerias necesarias como fpdf para generar reporte en pdf

exec - carpeta que contiene un script de php para ejecutar las migraciones y asi crear las tablas de usuarios y clientes, esta se peude ejecutar ingresando a la direccion de ese archivo en el terminal o navegador

Controllers - carpeta que contiene los controladores de cada modelo el cual permite interactuar con el frontend al recibir una peticion http

ConnecBD - es una clase de configuración, para obtener la conexión a la base de datos, ahi adentro estan los valores por defecto para vincular el proyecto a la bd.

api - Caperta que contiene los archivos que hacen enrutador para las solicitues http del forntend con las funciones del controlador

para ingresar a la pagina de del crud es en la caperta localhost\Views\index\index.php esto en un servidor apache

--------------------------no se completo-----------------------------

-No se realizaron los estilos
-No se realizo el reporte en Excel
-Falto el procedimiento Almacenado
-No se considero la base de datos sql server proporcionada por el documento, no me fije hasta que fue muy tarde