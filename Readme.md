# CUParkit

## Authors
Jack Tabb  
Qingbo Lai  
CPSC 4620 / 6620 DBMS  

## Note
The 3 main folders that form the backend are config, models, and api.
The dependency injection is set up so that the php script in the api is the starting point
of the program.

## config
config sets up the connection to the mysql database server with PHP Data Objects (PDO).

## models
models set up the queries to and usage of the mysql database server.  
Each model file can have multiple functions.  
Each model should implement the Create-Read-Update-Delete (CRUD) principle,  
as well as any other functionalities that the api will require.

## api
api is RESTful and grants a front-end client access to the back-end code in the models.  

api's functions abstract away from the details in the model.  
They deal in JSON with the front-end client.

Each model file has a respective api subfolder.  
In that subfolder, various functions are defined as single scripts.  
These functions use and build off of the functionality that is contained in the model files

The app folder is where the frontend code goes. It communicates to the api via  
POST, GET, PUT, etc. with JSON.

## Testing
Postman is helpful for testing the api. The 'test' folder contains the production environment variables and collection of tests.

## Excerpt from our report -- More Detailed Description of Project Structure
The webapp’s HTML communicates to the webapp’s javascript with ajax. The webapp’s javascript then uses XHR to communicate with the RESTful API, which is written in PHP. XHR stands for XmlHttpRequest, which can handle sending and receiving JSON. The webapp and web server communicate to each other with JSON and XHR. The specific libraries we are using to do this in javascript are axios and jquery (and jquery ajax).

Note that it is possible to send and receive HTTP packets without using the webapp / web portal. Postman was used extensively in the development and testing of this api, and can still be used to access it. Other webapps could also communicate with this api.
CRUD stands for Create, Read, Update, and Delete. These are basic functionalities and queries for a database.
PDO stands for PHP Data Objects, which is a set of functionality built into PHP. PDO communicates SQL queries from the PHP code on the web server to the MySQL on the database server. It also takes the responses (errors, successes, etc) from the database server and converts it into PHP-readable stuff.

There is one PHP Class in a script that, when instantiated, can use PHP Data Objects (PDO) to connect from the web server to the MySQL database that is running on the database server. For each table in the MySQL database, there is one PHP file containing a PHP class that defines a data model that implements basic Create, Read, Update, and Delete (CRUD) functionality. All of these files are in the models folder and implement an interface so they have the same structure. The RESTful API is built upon this CRUD functionality and is located in a folder named api. For each data model, there is a subfolder within the api folder. For each function in the data model, there is a PHP script located in the subfolder.

* The config folder houses Database.php, which contains a class that connects to the MySQL database via PDO.
  - The Owner.php file in the models folder is a data model class that has fields corresponding to the Owner table in the database.
  - It implements the interface in model_interface.php, so it is guaranteed to have certain functions.
  - Using an instance of Database.php, it can send SQL queries by using the PDO functionality of the Database object.
* The update.php file in the Owner subfolder in the api folder is a RESTful API endpoint.
  - It is accessible to the webapp.
  - It instantiates the Database class in Database.php. Then, it constructs an Owner object with the Database object. So, it is able to fill data in the Owner data model object and call its member function named “update” that contains an SQL query to be sent using the Database object.
* Authentication is handled with the HTTP basic authentication scheme. The api creates a session when a user logs in. Authorization is implemented in some of the api endpoints, such as delete. In such a case, the api file checks for proper credentials in the session received from the client making the call to the api.
* The backup and restore functionality is also in the api. The database dump file is stored in api/backup.
* The app folder contains the HTML, CSS, and JS files that form the webapp. This folder could theoretically be run on a separate web server from the web server that hosts the RESTful API.
* The bin folder is used with Composer, a package manager for PHP. This project makes use of a library that implements ‘zxcvbn’, a password strength checker.
* Outside of any folder is the manage_tables.php file.
  - It is a script that runs in the command line on the web server.
  - It was used to fill in the tables and test the data models.
  - Its functionality will eventually be placed in the API and available to administrative users via the web portal.
..* The Readme file is also outside of any folder.
