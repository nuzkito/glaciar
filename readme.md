# Glaciar

Glaciar es una plataforma de cursos online open source creada con Laravel.

## Instalación
Para poder instalar Glaciar se requiere tener instalado PHP 7 y MySQL (u otra base de datos compatible), más los requisitos necesarios de Laravel.

Clona el proyecto e instala las dependencias
```
git clone https://github.com/abalozz/glaciar.git
cd glaciar
composer install
```

Edita el fichero .env y agrega los datos de configuración de la base de datos
```
DB_HOST=localhost
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

Si fuese necesario, configura los permisos del directorio `storage` para que el usuario del servidor web pueda escribir en él.
