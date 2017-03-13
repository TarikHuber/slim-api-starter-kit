# Slim API Starter Kit

Below you will find some information on how to perform common tasks.<br>

## Table of Contents

- [Description](#description)
- [Features](#features)
- [Installation](#instalaltion)
  - [Clone repository](#clone-repository)
  - [Folder Structure](#folder-structure)
  - [Install composer packages](#install-composer-packages)
  - [Create Database](#create-database)
  - [Setup settings](#setup-settings)
  - [Setup environment](#setup-environment)
- [Usage](#usage)
  - [Postman](#postman)
  - [First usage](#first-usage)
  - [Setup clients](#setup-clients)
- [Advanced usage](#adcanced-usage)
  - [Validation](#validation)
  - [Pagination](#pagination)
  - [Filtering](#filtering)
  - [Sorting](#sorting)
  - [Client change](#clkient-change)
  - [Localisation](#localisation)
- [Contibuting](#contibuting)

## Description

Slim API starter Kit is divided into two parts:

* `api-lib` is a global composer package that contains vital libraries for this applcation to work properly
* `slim-api-starter-kit` is a skeleton with the basic and minimal folder structure for this project to run properly

This allows us to update vital parts of the project even if the skeleton is out of date. It is also possible to use the skeleton without the api-lib.

## Features

Why could this project be interesting to you? Well , it has some features that come with it:
* **standardised validation**(#validation) there is a standardised validation with a strict defined pattern
* **pagination**(#pagination) every table has automatically integrated pagination
* **filtering**(#filtering) every table has automaticallyintegrated filtering
* **sorting**(#sorting) every table has automatically integrated sorting
* **authentication** authentication is integrated over the routes
* **authorisation** authentication can be given and taken for every route call
* **client based** (#client-change) authentication can be given and taken for every route call
* **localisation** (#localisation) integrated localisation

## Installation

### Clone repository

For the instalation we need to clone this github project a forked version of it:

```bash
git clone https://github.com/TarikHuber/slim-api-starter-kit your_project_name
```

You can change the "your_project_name" to any name you want.

### Folder Structure

After creation, your project should look like this:

```
  your_project_name/
  app/
    Controllers/
    Helpers/
    Localisation/
    Middleware/
    Models/
    Scopes/
    Validation/
  src/
    routes/
    dependencies.php
    routes.php
    validation.php
    templates/
  v1/
    index.php
  .gitignore
  composer.json
  LICENSE
  README.md
```

### Install composer packages

After successfully cloning the project we need to install all composer dependencies using this command:

```bash
composer install
```

Of course composer has to be setup properly for this command. More about how to setup composer you can find [here](https://getcomposer.org/doc/00-intro.md).

### Create Database

The application needs a database to store the data. Because we use a PDO it should work with any kind of database you chose but I have never tested anithing else than mysql. The api-lib has integrated Authorisation and Authentication and because of that some tables are required with a specific column structure. It is no problem to add more columns to this base tables but columns shuld not be deleted from them. The will recognise the new columns and you can work with them withoud changing any code in the project.

To make it easy I have created a folder i with all templates needed to help you setup this project. In the folder "templates" there is a file "inital_db.sql" witch has the needed database. If you are using mysql just import that file and your database structure is ready to be used.

### Setup settings

The credentials for the database need to be stored somewhere in the project. Because we don't want to share them over public repos with github the settings will be ignored. You have to create a "settings.php" file in the "src" folder. To make it easy we also have a template file in the templates folder. Just copy it into the src folder and adjust the database credentials.

It is very importand to not change the template structure! You can add more settings but don't rename or delete the setting keys from the template file. The project expects them to exists.

### Setup environment

The last thing we need to do is to setu the application environment for sending any request to the application folder to the "your_project_name/v1/index.php" file. Every environment has his own tricks on how to set it up. In my case I'm using nginx and I had to do something like this to make the environment akt like it should:

```bash

...other setting...

location /your_project_name/ {
  try_files $uri $uri/ /your_project_name/v1/index.php?$query_string;
}

...other setting...

```

## Usage

If you have done everithing right the application should now be ready to run. Don't freak out if it doesn't wirk on the first try. Sometimes the database credentials are wrong or there is just a typing error, or the settings are not in the right folder or corrupted, or the composer dependencies are not installed correctly or none of them are installed. Anything can happen. No mather if everithing is working fine or not you will need a tool to test the application. I prefer to use [Postman](https://www.getpostman.com/). You can use any other tool like Advanced Rect Clent Application ARC or if you like to use FireFox some other FireFox Plug-In. Thats fully up to you. I will continue with Postman because I like Chrome and as REST Plug-In i like Postman.

### Postman

If you chose to use Postman I have greate news for you. In the templates folder there is a file "Slim API.postman_collection.json". It contains every API call you can make on this application in this early stage. Just open postman and import the file. After that you will need to setup a environment with two variables: `app` and `api-key`. The app variable should contain the full path to your application until it comes to v1. For example if your application has this link to the index.php file:

```bash
https://api.my_domain.com/my_project/v1/index.php
```

your app variable shuold be:

```bash
https://api.my_domain.com/my_project
```

The `api-key` variable should the api key you get from signing in with the Auth/Signin call or by geting the key from the database directly. It is importand to put `Bearer ` before the key. The whitespace is also required. Even if this project doesn't reale support other Auth methods and it just removes this prefix in the code I put it in to not have to change later all my applications if i deside to use more than one Auth method.

### First usage

So if you have done the installation correctly, setup the environment and prepared Postman for the first calls what should you do first?
The database is emtpy. There is no default user! So we need to signup to your application. We do it by calling the "SignUp" call in the Auth folder in the imported calls in Postman or by calling `my_project_name/auth/signup` with the body parameters: name, email, password, confirm_password.

If the call is successfull you should have a response like this:

```json
{
  "error": false
}
```

If you would try to signin right now there would apear this response:

```json
{
  "error": true,
  "error_id": 20120,
  "error_message": "User not activated",
  "error_details": {
    "email": "User not activated"
  }
}
```


We have to give your user acces to the other parts of the application. Go to the database and the table `users`, find your user and set the values to `admin` and `active` to 1. Now you should be able to signin. For that call the "SignIn" call in the Postman folder or `my_project_name/auth/signin` with the body parameters: email, password. If the signin is successfull we should recieve a response like this:

```json

{
  "error": false,
  "user": {
    "name": "demo",
    "admin": 1,
    "email": "demo@demo.com",
    "api_key": "8e369875156e3eb7518fdff58ca03ed0",
    "clients": []
  }
}
```

Here we can get now our `api-key` for all the other API calls.

### Setup clients

The application is designed to be client based. The same application can be used by multiple clients wuth the same code and database without having access to data of other clients. If needed you can add to one user multiple clients so he can switch between them.

**Note: It is importand to know that a user even if he has admin rights can't do anithing if he is not asigned to a client. Even if he is an admin and is asignet do a client he has no access to other clienst. But a admin user has the rights to add any clients to him. So be carefull with making users admin!**

Because of all that we have to create a new client and asign him to our user. For that we go to the database and create a client. We need there just a name. And in the `client_user` table we create a new row with the right values for `client_id` and `user_id`. They should be both 1 for the firts created user and client.

If we sign in now we should have a response like this:

```json
{
  "error": false,
  "user": {
    "name": "demo",
    "admin": 1,
    "email": "demo@demo.com",
    "api_key": "8e369875156e3eb7518fdff58ca03ed0",
    "clients": [
      {
        "id": 1,
        "created_at": "2017-03-13 16:50:04",
        "updated_at": "2017-03-13 16:50:04",
        "deleted_at": null,
        "name": "Client 1",
        "pivot": {
          "user_id": 1,
          "client_id": 1
        },
        "grants": [
          ""
        ]
      }
    ]
  }
}
```

Now we are able to manipulate all data over the REST API calls.

## Advanced usage

We will show the advanced usage on the items table and hes coresponding API calls.


### Validation

We can play a little bit with our application. There is a table called `items`. Everithing is setup for it to work. We can create a new item by calling POST call to the items path. If you make a mistake in the body parameters you will recieve a response like this:

```json
{
  "error": true,
  "error_id": 20301,
  "error_message": "Validation failed!",
  "error_details": {
    "name": [
      "Name must not be empty"
    ],
    "number": [
      "Number must not be empty"
    ],
    "ean": [
      "Ean must not be empty",
      "Ean is not a valid EAN"
    ]
  }
}
```

Now we can see that we need 3 parameters to send: name, number and ean.
The EAN has no right validation, it just has to be 14 chars long.
If we add the missing parameters we will recive a response like this:

```json
{
  "error": false,
  "item": {
    "id": 1,
    "created_at": "2017-03-13 16:57:37",
    "updated_at": "2017-03-13 16:57:37",
    "deleted_at": null,
    "client_id": 1,
    "factor": 1,
    "name": "Item 1",
    "number": "123456",
    "ean": "12345678912345"
  }
}
```

If we chnage only the name and try to create another item we will recieve a response like this:

```json
{
  "error": true,
  "error_id": 20301,
  "error_message": "Validation failed!",
  "error_details": {
    "number": [
      "Number is already in use"
    ],
    "ean": [
      "Ean is already in use"
    ]
  }
}
```

The name, number and ean can't repeat them selve in two diferent items.

### Pagination

Let us now make more items. Just change always the name, number and ean and send the PUT request. After adding some more items if we send a GET request to the items path we will recieve a response like this:

```json
{
  "error": false,
  "totals": {
    "rows": 4,
    "pages": 1
  },
  "items": [
    {
      "id": 1,
      "created_at": "2017-03-13 16:57:37",
      "updated_at": "2017-03-13 16:57:37",
      "deleted_at": null,
      "client_id": 1,
      "factor": 1,
      "name": "Item 1",
      "number": "123456",
      "ean": "12345678912345"
    },
    {
      "id": 2,
      "created_at": "2017-03-13 17:01:55",
      "updated_at": "2017-03-13 17:01:55",
      "deleted_at": null,
      "client_id": 1,
      "factor": 1,
      "name": "Item 2",
      "number": "1234567",
      "ean": "12345678912344"
    },
    {
      "id": 3,
      "created_at": "2017-03-13 17:02:03",
      "updated_at": "2017-03-13 17:02:03",
      "deleted_at": null,
      "client_id": 1,
      "factor": 1,
      "name": "Item 3",
      "number": "12345678",
      "ean": "12345678912343"
    },
    {
      "id": 4,
      "created_at": "2017-03-13 17:02:09",
      "updated_at": "2017-03-13 17:02:09",
      "deleted_at": null,
      "client_id": 1,
      "factor": 1,
      "name": "Item 4",
      "number": "123456789",
      "ean": "12345678912342"
    }
  ]
}
```

You probably noticed the part in the response with the totals:

```json
{
...
  "totals": {
    "rows": 4,
    "pages": 1
  },
...
}
```

It is no problem to call all rows from a table if the application stays small. But what if you have thousands, hundred-thousands or milions of rows in a table. Would you call all of them? Of course not. In most cases such large tables are called with a pagination. In our application there is a default pagination. The application will always return a max number of 15 rows if you don't make any pagination settings in the call.

Thats why we always have this `totals` part in our GET responses. It shows us how mutch rows the table realy has and on wtch `page` we are.

To change the number of recived rows and/or the page we can use request parameters:
* **perPage** with this one we can define how mutch rows we want to have in a page
* **page** with this one we can define what page we want to load

For example if we add to our items table 16 rows of different items we can make a call like this `{{app}}/v1/items?perPage=2`:

```json
{
  "error": false,
  "totals": {
    "rows": 16,
    "pages": 8
  },
  "items": [
    {
      "id": 1,
      "created_at": "2017-03-13 16:57:37",
      "updated_at": "2017-03-13 16:57:37",
      "deleted_at": null,
      "client_id": 1,
      "factor": 1,
      "name": "Item 1",
      "number": "123456",
      "ean": "12345678912345"
    },
    {
      "id": 2,
      "created_at": "2017-03-13 17:01:55",
      "updated_at": "2017-03-13 17:01:55",
      "deleted_at": null,
      "client_id": 1,
      "factor": 1,
      "name": "Item 2",
      "number": "1234567",
      "ean": "12345678912344"
    }
  ]
}
```

As we can see we have the first two rows from 16.

Now let us call a diferent page `{{app}}/v1/items?perPage=2&page=5`:

```json
{
  "error": false,
  "totals": {
    "rows": 16,
    "pages": 8
  },
  "items": [
    {
      "id": 9,
      "created_at": "2017-03-13 17:23:19",
      "updated_at": "2017-03-13 17:23:19",
      "deleted_at": null,
      "client_id": 1,
      "factor": 1,
      "name": "Item 9",
      "number": "3234567812",
      "ean": "32345678912349"
    },
    {
      "id": 10,
      "created_at": "2017-03-13 17:23:27",
      "updated_at": "2017-03-13 17:23:27",
      "deleted_at": null,
      "client_id": 1,
      "factor": 1,
      "name": "Item 10",
      "number": "4234567812",
      "ean": "42345678912349"
    }
  ]
}
```

There we have it :)
If we try to call a page over the maximum number of pages `{{app}}/v1/items?perPage=2&page=9` we will just get a empty array:

```json
{
  "error": false,
  "totals": {
    "rows": 16,
    "pages": 8
  },
  "items": []
}
```

All this is automatically integrated if we use the BaseModel and Base_Controller from the **api-lib**.


### Filtering

One of the main features is the filtering posibillites this project is giving to us. We can use the parameters in a GET call to filter the data we recive. For that there is a single parameter in witch we can define all filter requirements and it's name **q**.

Let us see it in a example calle `{{app}}/v1/items?q=name:?Item 1` :

```json
{
  "error": false,
  "totals": {
    "rows": 8,
    "pages": 1
  },
  "items": [
    {
      "id": 1,
      "created_at": "2017-03-13 16:57:37",
      "updated_at": "2017-03-13 16:57:37",
      "deleted_at": null,
      "client_id": 1,
      "factor": 1,
      "name": "Item 1",
      "number": "123456",
      "ean": "12345678912345"
    },
    {
      "id": 10,
      "created_at": "2017-03-13 17:23:27",
      "updated_at": "2017-03-13 17:23:27",
      "deleted_at": null,
      "client_id": 1,
      "factor": 1,
      "name": "Item 10",
      "number": "4234567812",
      "ean": "42345678912349"
    },
    {
      "id": 11,
      "created_at": "2017-03-13 17:23:34",
      "updated_at": "2017-03-13 17:23:34",
      "deleted_at": null,
      "client_id": 1,
      "factor": 1,
      "name": "Item 11",
      "number": "5234567812",
      "ean": "52345678912349"
    },
    {
      "id": 12,
      "created_at": "2017-03-13 17:23:42",
      "updated_at": "2017-03-13 17:23:42",
      "deleted_at": null,
      "client_id": 1,
      "factor": 1,
      "name": "Item 12",
      "number": "6234567812",
      "ean": "62345678912349"
    },
    {
      "id": 13,
      "created_at": "2017-03-13 17:23:49",
      "updated_at": "2017-03-13 17:23:49",
      "deleted_at": null,
      "client_id": 1,
      "factor": 1,
      "name": "Item 13",
      "number": "7234567812",
      "ean": "72345678912349"
    },
    {
      "id": 14,
      "created_at": "2017-03-13 17:23:58",
      "updated_at": "2017-03-13 17:23:58",
      "deleted_at": null,
      "client_id": 1,
      "factor": 1,
      "name": "Item 14",
      "number": "8234567812",
      "ean": "82345678912349"
    },
    {
      "id": 15,
      "created_at": "2017-03-13 17:24:14",
      "updated_at": "2017-03-13 17:24:14",
      "deleted_at": null,
      "client_id": 1,
      "factor": 1,
      "name": "Item 15",
      "number": "9334567812",
      "ean": "93345678912349"
    },
    {
      "id": 16,
      "created_at": "2017-03-13 17:24:22",
      "updated_at": "2017-03-13 17:24:22",
      "deleted_at": null,
      "client_id": 1,
      "factor": 1,
      "name": "Item 16",
      "number": "9434567812",
      "ean": "94345678912349"
    }
  ]
}
```

We just filtered the table with the requirement `name LIKE '%Item 1%'` and as we can see we have all items that have "Item 1" in they'r name.
Let us now make a more complex call `{{app}}/v1/items?q=name:?Item 1;number:=5234567812`:

```json
{
  "error": false,
  "totals": {
    "rows": 1,
    "pages": 1
  },
  "items": [
    {
      "id": 11,
      "created_at": "2017-03-13 17:23:34",
      "updated_at": "2017-03-13 17:23:34",
      "deleted_at": null,
      "client_id": 1,
      "factor": 1,
      "name": "Item 11",
      "number": "5234567812",
      "ean": "52345678912349"
    }
  ]
}
```

Multiple filter params can seperated with the **;** char.
Now we have all items that are matching the filtering requirement `name LIKE '%Item 1%' AND number='5234567812'`.

The pagination and filtering parameters can be combined so that wecan make calls like this `{{app}}/v1/items?q=name:?Item 1;number:?45678&perPage=2`:

```json
{
  "error": false,
  "totals": {
    "rows": 7,
    "pages": 4
  },
  "items": [
    {
      "id": 10,
      "created_at": "2017-03-13 17:23:27",
      "updated_at": "2017-03-13 17:23:27",
      "deleted_at": null,
      "client_id": 1,
      "factor": 1,
      "name": "Item 10",
      "number": "4234567812",
      "ean": "42345678912349"
    },
    {
      "id": 11,
      "created_at": "2017-03-13 17:23:34",
      "updated_at": "2017-03-13 17:23:34",
      "deleted_at": null,
      "client_id": 1,
      "factor": 1,
      "name": "Item 11",
      "number": "5234567812",
      "ean": "52345678912349"
    }
  ]
}
```

Here are all possible operators that can be used in the filter:
* **:=** - =
* **:!=** - !=
* **:<** - <
* **:>** - >
* **:<=** - <=
* **:>=** - >=
* **:<>** - <>
* **:?** - like
* **:!?** - not like
* **:isNULL** - is null


### Sorting

Sorting is also possible by using GET parameters:
* **order** defines if the order is ASC or DESC
* **sort** defines the field or the fields seperated by a `,` to sort on

Let us make an Example call `{{app}}/v1/items?q=name:?Item 1;number:?45678&perPage=2&order=desc&sort=created_at`:

```json
{
  "error": false,
  "totals": {
    "rows": 7,
    "pages": 4
  },
  "items": [
    {
      "id": 16,
      "created_at": "2017-03-13 17:24:22",
      "updated_at": "2017-03-13 17:24:22",
      "deleted_at": null,
      "client_id": 1,
      "factor": 1,
      "name": "Item 16",
      "number": "9434567812",
      "ean": "94345678912349"
    },
    {
      "id": 15,
      "created_at": "2017-03-13 17:24:14",
      "updated_at": "2017-03-13 17:24:14",
      "deleted_at": null,
      "client_id": 1,
      "factor": 1,
      "name": "Item 15",
      "number": "9334567812",
      "ean": "93345678912349"
    }
  ]
}
```

As we can see the rows are sorted DESC on the created_at column.

### Client change

To change the current client on a call we just set a Header key **Client** to the ID of the Client we want.

### Localisation

To change the current language in a call we just set a Header key **locale** to the locale we want. In this starter kit we have some translations in the `app/Localisation` folder for the english (en.php) and german (de.php) language.

## Contributing

Every help no mather if it is a kritik, suggestion or pull request is welkome :)
