## 🚀 Cómo descargar y configurar el proyecto

### 1. Clonar el repositorio

Abre una terminal y ejecuta:

```bash
git clone https://github.com/JavierLuna242/OpenBook.git
cd REPOSITORIO
```
### 2. Instalar dependencias

```bash
composer install
npm install
```
---
### 3. Configurar el entorno

Copia el archivo de entorno de ejemplo y edítalo con tus datos locales:

```bash
cp .env.example .env
php artisan key:generate
```

Abre `.env` y configura:

```env
DB_DATABASE=openbook
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_SCHEME=null
MAIL_HOST=smtp-relay-offshore-southamerica-east-v2.sendinblue.com
MAIL_PORT=587
MAIL_USERNAME=tu_usuario@smtp-brevo.com
MAIL_PASSWORD=tu_api_key_de_brevo
MAIL_FROM_ADDRESS=tu_correo@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```
---
### 4. Crear la base de datos y ejecutar migraciones

```bash
php artisan migrate
```
---

### 5. Enlazar el almacenamiento de archivos

```bash
php artisan storage:link
```

---

### 6. Compilar assets y arrancar el servidor

```bash
npm run dev
php artisan serve
```

La aplicación estará disponible en: `http://localhost:8000`

---

## 🌿 Flujo de trabajo con ramas (Git Branches)

Todos los cambios se trabajan en **ramas separadas** para mantener `main` siempre estable.

### ➕ Crear una nueva rama

```bash
# Siempre parte desde main actualizado
git checkout main
git pull origin main

# Crea y cambia a tu nueva rama
git checkout -b nombre-de-tu-rama
```
### 💾 Guardar y subir cambios

```bash
# Ver qué archivos cambiaste
git status

# Agregar todos los cambios
git add .

# Hacer commit con un mensaje descriptivo
git commit -m "Ejemplo de commit"

# Subir la rama a GitHub
git push origin nombre-de-tu-rama
```

---

### 🔀 Crear un Pull Request

1. Ve a GitHub → tu repositorio.
2. Haz clic en **"Compare & pull request"** (aparece automáticamente tras hacer push).
3. Describe los cambios realizados.
4. Solicita revisión y espera aprobación antes de hacer merge a `main`.

### 🗑️ Eliminar una rama ya fusionada

```bash
# Local
git branch -d nombre-de-tu-rama

# En GitHub (remoto)
git push origin --delete nombre-de-tu-rama
```