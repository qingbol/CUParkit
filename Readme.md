# CUParkit

## Authors
Jack Tabb  
Partner: Qingbo Lai  
Oct 25th, 2018  
CPSC 4620 DBMS  

## Note
The 3 folders that form the backend are config, models, and api.
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