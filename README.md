# Simple Todos App Using Laravel 8 and Vuejs

this repo is an example of todo app which show basic implementation of vue and laravel

## Project Setup
there are 2 apps in the repo
<ul>
    <ol>Vue (client side)</ol>
    <ol>Laravel (backend/server side)</ol>
</ul>

### laravel setup
create database in mysql / mariaDB e.g <i>tododb</i>

setup your .env
```sh
DB_DATABASE=tododb
DB_USERNAME=root
DB_PASSWORD=
```
download all vendors
```sh
composer i
```
create tables for app
```sh
php artisan migrate
```
and for last run the backend
```sh
php artisan serve
```

### vue setup
download all node modules
```sh
npm i
```
if you find problem with npm i add --legacy-peer-deps
```sh
npm i --legacy-peer-deps
```

run frontend
```sh
npm run dev
```