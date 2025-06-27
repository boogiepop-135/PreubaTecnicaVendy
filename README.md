# Sistema de Inventario Textil

Control simple de inventario de telas.

## Instalación

### Opción 1: Docker (Recomendado)
```bash
git clone <repositorio>
cd PreubaTecnicaVendy
docker-compose up -d
```
Abre http://localhost:8000

### Opción 2: Manual
1. Instala XAMPP/WampServer
2. Copia archivos a htdocs/www
3. Importa `sql/esquema.sql`
4. Abre http://localhost/PreubaTecnicaVendy

## Credenciales MySQL
- Host: localhost
- Usuario: root
- Password: (vacío)
- Puerto: 3306

## Estructura
```sql
CREATE TABLE telas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(100) NOT NULL,
    color VARCHAR(50) NOT NULL,
    largo FLOAT NOT NULL,
    fecha_ingreso DATE NOT NULL
);
```
