Installation Instructions

1.Clone the repository by

  git clone https://github.com/malindawijekoon/malinda-temper-test.git
  
2. Go in to malinda-temper-test directory 

  cd malinda-temper-test
  
3. Download PHP dependancies

  composer install
  
4. Download Javascript Dependancies (make sure the latest node.js version and npm version available in your PC)

  npm install
  
6. create .env file

  copy and duplicate .env.example file to .env file
  
6. Change the configuration data

    - give a name to the database by filling DB_DATABASE 
    - change DB_USERNAME and DB_PASSWORD variables
    
7. Create a database and run migrations

  php artisan migrate
    
7. Generate session key for laravel

  php artisan key:generate
  
8. Install all Javascript dependancies to the project

  npm run dev
  
9. Run the artisan server

php artisan serve

10. Run the Application

type : localhost:8000 in the browser
 
    


