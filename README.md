# Sistema Web para la Gestión y Seguimiento de Trabajos en Río Tollo :seedling:

El sistema web se desarrolla con la intención de facilitar el **seguimiento** y **gestión** de los trabajos realizados en un vivero de plantas. Mediante la asignación de roles a los usuarios de la aplicación, cada uno de los integrantes de la empresa puede realizar sus diferentes tareas de control o reporte.

## :pushpin: Índice
* Estado del Proyecto
* Tecnologías Empleadas
* Instrucciones de Instalación
* Funcionamiento  de la Aplicación
* Estructura del Proyecto
* Derechos de Autor y Licencias
* Contacto

## :chart_with_downwards_trend: Estado del Proyecto
:construction: Proyecto en construcción :construction: </br>
Actualmente el proyecto se encuentra en una **version 1** con las implementaciones de las funcionalidades establecidas en la planificación inicial.
Se puede acceder a los contenidos de la aplicación y gestionar trabajos y personal de la empresa si se cuenta con una cuenta válida para el inicio de sesión.

## :computer: Tecnologías Empleadas
* **Front End:**
  * **HTML** - lenguaje de marcado para la estructura base de la web.
  * **SCSS** - preprocesador de CSS para la incoporación de estilos en la web.
  * **JavaScript** - lenguaje de programación de entorno cliente.
  
* **Back End:**
  * **PHP** - lenguaje de programación de entorno servidor.
  
* **Herramientas:**  
  * **[GitHub](https://github.com/)** - control de versiones y almacenamiento de archivos del proyecto.
  * **[Visual Studio Code](https://code.visualstudio.com/)** ( y extensiones ) - editor de código fuente.
  * **[XAMPP](https://www.apachefriends.org/es/index.html) + MySQL** - sistema de gestión de la base de datos.
  * **[InfinityFree](https://www.infinityfree.com/)** - servicio de alojamiento web.
  * **[Bootstrap](https://getbootstrap.com/)** - framework que facilita la creación de páginas web _responsive_.
  * **[Composser](https://getcomposer.org/)** - gestor de dependencias para PHP.
  * **[Leaflet](https://leafletjs.com/)** - biblioteca de JavaScript para la creación de mapas web.
  * **[DomPdf](https://github.com/dompdf/dompdf)** - compilador de HTML a PDF.
  * **[Datatables](https://datatables.net/)** - librería de mejora del comportamiento de las tablas.
  
## :wrench: Instrucciones de Instalación
El usuario puede ejecutar el proyecto de **dos** formas diferentes:
1. Instalación del proyecto en una máquina **local**:
Para ejecutar el proyecto de forma local (con la posibilidad de ver el código fuente del mismo), deben seguirse los siguientes pasos:
- Realizar una previa instalación de [XAMPP](https://www.apachefriends.org/es/index.html), en caso de no tenerlo, para la gestión y acceso a la base de datos.
- Iniciar la aplicación de XAMPP y activar los módulos de "Apache" y "MySQL".
- Copiar el _link_ de este repositorio.
  ```plaintext
  https://github.com/azucenaSantos/Gestion-RioTollo.git
- Clonar el repositorio en la carpeta "htdocs" creada tras la instalación de XAMPP.
  ```plaintext
  git clone https://github.com/azucenaSantos/Gestion-RioTollo.git
- Antes de ejecutar el proyecto, instalamos el gestor de independencias "Composer" desde el siguiente link:
   ```plaintext
  https://getcomposer.org/.
- Una vez instalado, en la raíz del proyecto clonado ejecutamos el siguiente comando:
  ```plaintext
  composer install    
- Finalmente, para poder ejecutar el proyecto, se escribe el siguiente _link_ en el navegador que se desee usar.
  ```plaintext
  localhost/Gestion-RioTollo
- Al acceder a la aplicación, se requiere una instalación previa de la base de datos. Para realizarla, tan solo es necesario iniciar la instalación con los valores por defecto que se asignan en el formulario.
- Tras finalizar la instalación, se redrige al usuario a la pantalla de "Inicio de Sesión"; podrá acceder a la web con credenciales de usuario válidas.
  
3. Ejecución del proyecto en el **servidor**:
Para ejecutar el proyecto en el servidor online tan sólo es necesario Acceder al dominio de [Gestion-Rio-Tollo](https://gestion-riotollo.free.nf/) e iniciar sesión con una cuenta de usuario válida. </br>
_Cuentas de usuario de prueba:_

| Rol  | Usuario | Contraseña |
| ------------- | ------------- | ------------- |
| Jefe  | pecarlos  | carlos123 |
| RRHH  | fepatricia | patricia123 |
| Coordinadora  | esrosa | rosa123 |

## :interrobang: Funcionamiento de la Aplicación 
El sistema permite que los integrantes de la empresa inicien sesión y realicen dentro de la aplicación diferentes tareas dependiendo del rol asignado.
## Funcionalidades comunes
* Inicio de Sesión.
* Cambio de Contraseña.
* Cierre de Sesión.

### Funcionalidades de los **Jefes**
* Añadir, modificar y eliminar trabajos de la base de datos.
* Añadir, modificar y eliminar grupos de trabajos de la base de datos.
* Visualizar los procesos de los trabajos en las diferentes zonas que conforman el terreno de la empresa.

### Funcionalidades del departamento de **RRHH**
* Añadir, modificar y eliminar coordinadores(as) y/o trabajadores(as).
* Añadir, modificar y eliminar jefes(as) y/o integrantes del departamento de RRHH.

### Funcionalidades de los **Coordinadores(as)**
* Reportar un trabajo realizado.
* Visualizar el parte de trabajos asociados a él/ella.

* ### Funcionalidades de los **Trabajadores(as)**
* Visualizar el parte de trabajos asociados a él/ella.

### Flujo de uso de la aplicación
* Acceso a la página de _login_.
* Inicio de sesión (y cambio de contraseña si es su primer inicio de sesión).
* Navegación a través de los apartados asignados según su rol.
* Realizar diferentes acciones según el apartado al que acceda.
* Cierre de sesión.

## :mag: Estructura del Proyecto
La organización de carpetas y archivos de este proyecto se realiza siguiendo el siguiente esquema:
```plaintext
📁 Gestion-RioTollo/
 ┣ 📁 assets/
 ┃ ┣ 📁 css/
 ┃ ┣ 📁 img/
 ┃ ┣ 📁 js/
 ┃ ┗ 📁 lib/
 ┃   ┗ 📁 side-by-side-multiselect/
 ┃      ┣ 📁 css/
 ┃      ┗ 📁 js/
 ┣ 📁 controller/
 ┃ ┣ 📁 functions/
 ┃ ┃ ┣ 📄 formFunctions.php
 ┃ ┃ ┗ 📄 ...
 ┃ ┣ 📄 controller.php 
 ┃ ┗ 📄 ... 
 ┣ 📁 db/
 ┃ ┗ 📄 database.php
 ┣ 📁 public/
 ┃ ┣ 📁 pdfs/
 ┃ ┃ ┗ 📄 --> pdfs de los partes
 ┃ ┣ 📄 index.php
 ┃ ┗ 📄 instalacion.php
 ┣ 📁 vendedor/
 ┃ ┗ 📁 ... (contenido composser + dompdf)
 ┣ 📁 view/
 ┃ ┣ 📁 errores/
 ┃ ┃ ┗ 📄 errorAceso.php
 ┃ ┣ 📁 coordinador/
 ┃ ┃ ┣ 📄 coordinador.php
 ┃ ┃ ┣ 📄 parte.php
 ┃ ┃ ┗ 📄 ...
 ┃ ┣ 📁 jefe/
 ┃ ┃ ┗ 📄 ...
 ┃ ┣ 📁 rrhh/
 ┃ ┃ ┗ 📄 ...
 ┃ ┣ 📁 sesion/
 ┃ ┃ ┗ 📄 ...
 ┃ ┣ 📄 header.php 
 ┃ ┗ 📄 footer.php
 ┣ 📄 .gitignore
 ┣ 📄 LICENSE.md
 ┣ 📄 composer.json
 ┣ 📄 composer.lock
 ┣ 📄 README.md
 ┗ 📄 index.php
```

En el esquema se contemplan las carpetas y los archivos suficientes para comprender la estructura del proyecto.

## :unlock: Derechos de Autor y Licencias
Este repositorio está sujeto a la licencia **MIT License**. Se permite el uso, copia, modificación y distribución del mismo.

## :iphone: Contacto
Para contactar conmigo puedes utilizar las siguientes redes sociales.
¡Estaré encantada de hablar contigo! :smile:
* [Azu en LinkedIn](https://www.linkedin.com/in/azucenasantos/)
* [Azu en Correo](mailto:azu.santos.ete@gmail.com)

### _Agradecimientos:_
<p align="left">
  <a href="https://github.com/robotaleh">
      <img src="https://avatars.githubusercontent.com/u/20188736?v=4" alt="Imagen de ejemplo" width="70"/>
  </a>
  <a href="https://riotollo.com/empresa/">
      <img src="assets/img/logo.jpg" alt="Imagen de ejemplo" width="70"/>  
  </a>
</p>
