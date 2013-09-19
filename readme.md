## Scraper

Necesitaba Scrapear contenido que esta protegido por un formulario de Login, y hacer el mismo proceso para todos los usuarios de la base de datos

## Permite

- Hace curl post con los credenciales del usuario para pasar el formularion de logueo
- Crea un archivo Cookie.txt donde esta la cookie que se usará durante el scraping
- Scrapear el contenido para cada uno de los usuarios que estan en la BD
- Enviar un email con el resultado del Scraping (Usando GMail)


## Usandolo 
- Git clone https://github.com/animista01/Scraper.git 
- Copia lo a la carpeta donde esté tu servidor local 
- Configurar app/config/app.php , app/config/mail.php , app/config/database.php