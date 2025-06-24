# 🌍 Countries GraphQL API - Backend Laravel

Este proyecto backend fue desarrollado con Laravel y GraphQL. Expone un API que permite consultar información de países y registrar logs de acceso en una base de datos PostgreSQL. Además, calcula la densidad demográfica de cada país de forma automática.

## 🚀 Tecnologías utilizadas

-   PHP
-   Laravel
-   Lighthouse
-   PostgreSQL
-   Composer
-   GraphQL Playground

## ⚙️ Instalación

1. Clona el repositorio:
   git clone [text](https://github.com/jsvg2000/geodensity_backend.git)
   cd geodensity_backend

2. Instala dependencias:
   composer install

3. Instala dependencias:
   cp .env.example .env
   php artisan key:generate

4. Configura tu base de datos PostgreSQL en el archivo .env.

5. Ejecuta las migraciones:
   php artisan migrate

6. Inicia el servidor:
   php artisan serve

## 🎯 Uso del proyecto

1. Accede al endpoint GraphQL desde: [text](http://localhost:8000/graphql)
2. 📡 Endpoints GraphQL disponibles
   2.1. Consulta de países
   query {
   countries {
   name
   population
   area
   density
   }
   }
   2.2. Registro de logs
   query {
   getLogs(startDate: "2025-06-24", endDate: "2025-06-24") {
   id
   username
   num_countries_returned
   countries_details
   }
   }
