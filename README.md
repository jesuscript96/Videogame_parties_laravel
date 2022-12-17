<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About the proyect

Este proyecto consiste en una estructura Backend completa (DDBB+PHP+Laravel) con una APIREST para el desarrollo de una aplicación web LFG que permita que los empleados puedan contactar con otros compañeros para formar grupos para jugar a un videojuego, con el objetivo de poder compartir un rato de ocio afterwork. Se ha hecho uso de una autenticación en forma de jwt a través de un middleware para restringir las funcionalidades según el tipo de usuario.

## Las funcionalidades de la app

● F.1 Los usuarios se pueden registrar a la aplicación, estableciendo un usuario/contraseña.
● F.2 Los usuarios pueden autenticarse a la aplicación haciendo login.
● F.3 Los usuarios pueden crear Partídas (grupos) para un determinado videojuego. (requiere bearer auth de usuario logeado)
● F.4 Los usuarios pueden buscar Partídas seleccionando un videojuego. (requiere bearer auth de usuario logeado)
● F.5 Los usuarios pueden entrar y salir de una Party. (requiere bearer auth de usuario logeado)
● F.6 Los usuarios pueden enviar mensajes a la Party. (requiere bearer auth de usuario logeado)
● F.7 Los mensajes que existan en una Party se visualizan como un chat común. (requiere bearer auth de usuario logeado)
● F.8 Los usuarios pueden introducir y modificar sus datos de perfil, por ejemplo, su name y nickname. (requiere bearer auth de usuario logeado)
● F.9 Los usuarios pueden hacer logout de la aplicación web. (requiere bearer auth de usuario logeado)

A continuación la colección de POSTMAN para poder testear los endpoints:

https://drive.google.com/file/d/1ZfWcflbPviDyw8tFZeYFFAeg-I4RvKRd/view?usp=sharing

Además, la aplicación está preparada para más funcionalidades que se encuentran en el archivo "api.php".

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
