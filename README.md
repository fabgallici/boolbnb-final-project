
## Application to find and manage the rental of apartments, made using Laravel MVC Framework. Final Boolean course team project. ##
### Features: ###
* User registration and authentication
* add, remove and edit apartments
* save geographic address location using tomtom api, and show map
* messages/mails to users
* dynamic address/location search with Vue.js
* client side and back-end validation
* page views counter
* apartments graphs with views and messages statistics
* add sponsorship to apartment with Braintree

### Installation: ###
<pre>
$ git clone https://github.com/fabgallici/boolbnb-final-project.git
$ cd boolbnb-final-project
$ composer install
$ composer update
$ npm install
$ cp .env.example .env
edit .env file and set database connection values

$ php artisan key:generate

run db migration with or without seeds:
$ php artisan migrate --seed

$npm run dev    or $ npm run watch

setup local server:
$ php artisan serve

open browser on: http://localhost:8000/

</pre>


![](images/bhootel.jpg)

![](images/bhootel2.jpg)


