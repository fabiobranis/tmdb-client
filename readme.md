# Upcoming Movies App  
  
## Overview
This is a simple application to demonstrate how I think about software engineering.
This application is made with PHP in the backend and Javascript/HTML in the front.
The architecture of this application is based on the API X SPA behavior. 
The API responds the requests with json data.
One particular thing about this application is the hosting of the SPA, which is the backend api. I wrote a web route that renders the html template and this template loads the JS scripts of the SPA.

## Prerequisites
PHP 7.2 or higher
Composer
Node.js 12.3.1 or higher
npm 6.9 or higher
Sqlite 3.22.0 or higher

## How to install

 - Clone this repo.
 - Run `cp .env.example .env` and fill the environment variables in order to configure the application
 - Run `composer install` to install the PHP dependencies.
 - Run `npm install` to install Node dependencies.
 - Run `npm run build` to build the front end app.
 - Run `php do.php migrate` to create the database structure
 - Run `php do.php seed` to fetch the API data into database
 - Run `composer start` to serve application in the port 8080
 - Access http://localhost:8080

## About the application structure
I used a very basic approach to make the structure of the application. The requisites are very clear, I should develop and API X SPA application. In order to attend these requisites, I used a very similar approach used by Laravel team. The difference is: i do not made any changes in the webpack. 
Talking about the database layer, I tried to use a very simple approach with a SQL database. I see that the TBDB endpoints that I have to use didn't completely meet my needs in order to filter and paginate the data.
The database layer have the following structure

<img src="https://res.cloudinary.com/dhbfhsmzo/image/upload/v1568157573/tmdb-erd_h5escy.png">  

This is a very simple approach to store the movies and genres and the relate then in a pivotal relationship.
It's a many to many approach, because one movie can have one or more genres and one genre can be in one or more movies.

### Folders structure
In the application folders structure, we have 6 main folders and the root path.
Within the main folders, we have 3 namespaces for backend application: UpcomingMovies, Foundation and Tests.

 - UpcomingMovies: It's the application logic namespace for the backend
 - Foudation: The backend framework of the application 
 - Tests: The unit tests of the backend

To make the front end, we have only one folder which is the front folder.
The other folders are:

 - config: The backend configurations (dependency injection registration, cli commands registration and routes registration.
 - public: Where the backend entry point lives. The html template and the compiled assets are there too.
The files that are in the root folder are:
 - .babelrc: Presets configurations for babel transpiler
 - .env.example: An example for the configuration file
 - .gitignore: To avoid commit unnecessary files and folders
 - composer.json: The backend configurations and dependencies
 - composer.lock: This is very important to composer know which version install when deploying
 - db.sqlite: Our database
 - do.php: Our  cli commands entrypoint
 - package.json: Our front end dependencies and some configurations to run and build the app (front)
 - package-lock.json: Acts like composer.lock for node.js
 - webpack.config.js: The webpack configurations to build the front end app

## About the backend
Libs and frameworks:

Production
 - Slim 4.2 to structure the routes and use the PSR-7 Request/Response implementation
 - Silly-PHP-DI to run the cli commands
 - Slim PSR-7 the PSR-7 Request/Response implementation
 - Slim PHP View to render the PHP page (the SPA start point)
 - PHP-DI to use the IoC container in order to inject my dependencies in a cleaner way
 - Illuminate/Database to use the Eloquent ORM
 - Illuminate/Pagination to use the pagination implementation for Eloquent ORM
 - PHP-Dotenv to fetch the .env files and build the configuration
 
Dev
 - PHPUnit to test my application

I used a tight Objected Oriented approach in this app. In fact, I love to use this approach in every application. 
The web application entry point is the public/index.php. There you'll see few actions like vendor autoloading, Dotenv loading, Databse booting, container building and routes building.
In the same way as the web application, our console application loads the scrips in de do.php file.

The Foundation namespace have the following namespaces:

 - Console - extends the Silly application class, boot the Eloquent and the builds the container
 - Database -  A simple static class to build eloquent
 - File - A simple file reader to read the migrations written in sql
 - HttpClient - A fancy decorator to curl and some builder to help the paginator find the page and filters

The App class extends the AppFactory class from slim to build the application
The ContainerFactory is a factory to build the IoC Container based on the dependencies file.

The UpcomingMovies namespace have the following namespaces:

 - Actions - have the actions for the web app
 - Commands - have the actions for the cli app
 - Models - where lives the Eloquent Models
 - Repositories - well, I have some problems with the Eloquent/Repository combination, but in the approach that I used in this application, these repositories helped-me a lot.
 - Services - Where the services lives
I used a pattern called Action-Doman-Responder to work in this app. It's very simple, I map the routes to the action classes, the actions classes have only __invoke() method and that's it. In this way we have a simple and very cool implementation, because our actions have only one responsibility.

Talking about the models, I used PDO to make my migrations. I done this way only to demonstrate how I can be very independent of the ORM. 
The migrations lives in the Commands namespace, inside the Migrations namespace.
The Integration namespace calls  the seeders for that fetchs the data from TMDB and store in our database.

## About the front end
Libs

Production

 - moment.js because the Date class have some issues to create an instance with the YYYY-MM-DD format
 - react - The main lib of the front end to build reactive components
 - react-dom - Handles the dom for React
 - react-router-dom - To make the SPA routing
 - pure-css To help-me with the grid responsive layout

Dev

 - babel basics dependencies to transpile my application
 - webpack  to build the application with a node.js help
 - webpack-cli to help me in the development
 - copy-webpack-plugin to copy my css ( I didn't used the SASS module to build the front, but I like to use too)

The entry point of the application is the front/index.js. Here I just loaded the main component, React and ReactDom to render the app.
Inside the front folder, we have the css folder with the style (very basic) and the js folder.
The js folder have the src subfolder with the following folders:

 - components - All basic components of the application
 - containers - The main containers that lists the movies and shows the movie selected by the user.
 - helpers - where the helpers functions and classes lives in
 - services - where we have the logic to request the things to the backend

I like to separate the requests from the components and inject them as dependencies. I use this approach with vue.js because I think this can make my code more readable and I don't like to make everything in the same file. 
In this app, in the helpers folder we have the ApiClient class. This class is a simple decorator to fetch api with some implementations to make the client requests more cleaner. This class is injected in the services that will make requests to the backend.
Talking about React, I used a very simple approach. I have some elevated states (the Paginator component and the PageLink component). I use props to pass the values to the child components, and I treid to be very lean.