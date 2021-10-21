# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Clone the repository

    git clone https://github.com/kabengha/Software-Engineer---Coding-challenge.git
   
Switch to the repo folder 

    cd Software-Engineer---Coding-challenge
 
Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env
  
Generate a new application key

    php artisan key:generate


Run the database migrations (**Set the database connection in .env before migrating and create the database **)

    php artisan migrate
   
Start the local development server

     php artisan serve

You can now access the server at http://localhost:8000


## Available commands

###### Category

- [**create**:category](#create-category) ~ Create a new `category` through Artisan
- [**delete**:category](#delete-category) ~ Delete a `category` through Artisan


###### Product

- [**create**:product](#create-product) ~ Create a new `Product` through Artisan
- [**delete**:product](#delete-product) ~ Delete a `Product` through Artisan


###### Example test api
- post
-http://localhost:8000/api/product
- body 
    {
        "name":"product name her",
        "description":"product description",
        "category_id":3,
        "price":12,
        "image":[]
    }

- put
-http://localhost:8000/api/product/['idProduct']
- body 
    {
        "name":"product name her",
        "description":"product description",
        "category_id":3,
        "price":12,
        "image":[]
    }

 - delete
-http://localhost:8000/api/product/['idProduct'] 
