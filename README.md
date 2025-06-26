# PreubaTecnicaVendy

## ¿Qué archivo php.ini usar?

- **php.ini-development**: recomendado para desarrollo local. Incluye configuraciones útiles para depuración y muestra errores.
- **php.ini-production**: recomendado para entornos de producción. Oculta errores y aplica configuraciones más seguras.

Para desarrollo en tu máquina, usa `php.ini-development` y renómbralo a `php.ini`. Luego habilita las extensiones necesarias como `mysqli`.

## ¿Cómo desplegar en tu host local?

1. Instala [XAMPP](https://www.apachefriends.org/es/index.html), [WampServer](https://www.wampserver.com/) o cualquier servidor local con PHP y MySQL.
2. Copia la carpeta del proyecto a la carpeta `htdocs` (XAMPP) o `www` (WampServer).
3. Renombra `php.ini-development` a `php.ini` y habilita las extensiones necesarias (como `mysqli`).
4. Inicia Apache y MySQL desde el panel de control de tu servidor local.
5. Accede a `http://localhost/PreubaTecnicaVendy` desde tu navegador.
6. Si la aplicación requiere base de datos, importa el archivo `.sql` correspondiente usando phpMyAdmin.

## ¿Cómo desplegar usando el servidor embebido de PHP (puerto 8000)?

1. Abre una terminal y navega a la carpeta del proyecto `inventario_textil`:
   ```
   cd inventario_textil
   ```
2. Verifica que la extensión mysqli esté habilitada:
   ```
   php -m | grep mysqli
   ```
   Si no aparece "mysqli" en la lista, sigue los pasos de la nota siguiente.

3. Ejecuta el servidor:
   ```
   php -S localhost:8000
   ```
4. Accede a `http://localhost:8000` desde tu navegador.

> **Nota importante para el error de mysqli:**  
> Si recibes el error `Class "mysqli" not found in ...db.php`, sigue estos pasos:
>
> 1. Localiza tu archivo php.ini actual:
>    ```
>    php --ini
>    ```
> 2. Abre el archivo php.ini y busca la línea:
>    ```
>    ;extension=mysqli
>    ```
> 3. Elimina el punto y coma para habilitar la extensión:
>    ```
>    extension=mysqli
>    ```
> 4. Guarda el archivo y reinicia el servidor PHP
> 5. Si el error persiste, asegúrate de que estás usando el php.ini correcto ejecutando:
>    ```
>    php -i | findstr "mysqli"
>    ```

## Solución de problemas de conexión a MySQL

Si recibes el error "No se puede establecer una conexión ya que el equipo de destino denegó expresamente dicha conexión", sigue estos pasos:

1. Asegúrate que el servicio MySQL esté corriendo:
   - En XAMPP: Inicia MySQL desde el panel de control
   - En línea de comandos, verifica el estado:
     ```
     mysqladmin -u root -p ping
     ```
   - Si el servicio no responde, inícialo:
     ```
     net start MySQL80
     ```

2. Verifica que puedes conectarte a MySQL:
   ```bash
   mysql -u root -p
   ```
   Si la conexión es exitosa, verás el prompt de MySQL: `mysql>`

3. Verifica las credenciales en `db.php`:
   - Usuario por defecto: `root`
   - Contraseña por defecto: `` (vacía)
   - Host: `localhost` o `127.0.0.1`
   - Puerto por defecto: `3306`

4. Crea e importa la base de datos:
   ```sql
   CREATE DATABASE IF NOT EXISTS inventario_textil;
   USE inventario_textil;
   SOURCE ruta/al/archivo/inventario_textil.sql;
   ```

5. Si persiste el error:
   - Verifica que el firewall no esté bloqueando el puerto 3306
   - Intenta usar `127.0.0.1` en lugar de `localhost`
   - Asegúrate que el usuario tenga permisos:
     ```sql
     GRANT ALL PRIVILEGES ON inventario_textil.* TO 'root'@'localhost';
     FLUSH PRIVILEGES;
     ```

> **Nota:** Para XAMPP, los servicios deben iniciarse en este orden:
> 1. Apache
> 2. MySQL
> 3. Servidor PHP (`php -S localhost:8000`)

## Despliegue con Docker

1. Instala [Docker Desktop](https://www.docker.com/products/docker-desktop/)
2. Desde la terminal, navega a la carpeta del proyecto:
   ```bash
   cd PreubaTecnicaVendy
   ```
3. Levanta los contenedores:
   ```bash
   docker-compose up -d
   ```
4. Accede a la aplicación en:
   - Web: http://localhost:8000
   - MySQL: localhost:3307 (usuario: root, contraseña: secret)

> **Nota:** Si el puerto 3307 está ocupado, modifica el puerto en `docker-compose.yml`

## Pasos para ejecutar el proyecto

### Opción 1: Usando Docker (recomendado)
1. Abre una terminal y navega hasta la carpeta del proyecto:
   ```bash
   cd c:\Users\levi\Documents\PreubaTecnicaVendy
   ```

2. Ejecuta los contenedores:
   ```bash
   docker-compose up -d
   ```

3. Espera aproximadamente 30 segundos para que MySQL inicie completamente

4. Abre en tu navegador:
   ```
   http://localhost:8000
   ```

### Opción 2: Usando XAMPP
1. Inicia XAMPP Control Panel
2. Inicia los servicios de Apache y MySQL
3. Copia la carpeta del proyecto a:
   ```
   C:\xampp\htdocs\PreubaTecnicaVendy
   ```
4. Abre en tu navegador:
   ```
   http://localhost/PreubaTecnicaVendy/inventario_textil
   ```

### Opción 3: Usando el servidor PHP incorporado
1. Abre una terminal y navega hasta la carpeta del proyecto:
   ```bash
   cd c:\Users\levi\Documents\PreubaTecnicaVendy\inventario_textil
   ```

2. Inicia el servidor PHP:
   ```bash
   php -S localhost:8000
   ```

3. Abre en tu navegador:
   ```
   http://localhost:8000
   ```

### Verificación
- Para verificar que todo funciona correctamente, visita:
  ```
  http://localhost:8000/test_conexion.php
  ```
- Si ves "✅ Conexión a MySQL exitosa", todo está configurado correctamente
- Si hay errores, revisa la sección "Solución de problemas" más arriba
