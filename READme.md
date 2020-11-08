# What is Add_a_itp ?

Add a tip, permet de stocker et de retoruver l'ensemble des trucs et astuces dont vous avez besoin au quotidien, tous les 6 mois, tous les 10 ans ... . <br>

Grâce à un simple système de card, il est possible d'ajouter tous les trucs et astuces dont vous voulez vous souvenir.


# Card Composition : 
#####Name : 
* tip name
#####Language: 
* tip language or tech 
#####Description: 
* a short description 
#####Picture: 
* a screenshot of your tip
####Code: 
* lign code

---------------------------------------------------------------------------------------------------------------------------------------------------------

### Features available :

* add a tip in DB
* Clipboard
* Most used languages

### Functionality under development :

* Create a Personal Account

### Feature to come : 

* Add tips to your collection
* Search through all your Tips
* Consult the Community Tips
* Comment on a tip
* Liker a Tip
* Save a Tip in your collection

---------------------------------------------------------------------------------------------------------------------------------------------------------

 # Project installation :
 
* ```git clone https://github.com/JudgeBurger/add_a_tip.git```
 
* ```composer install```

* ```yarn install``` <br>
run ```yarn encore dev --watch```

 
* Copy .env in .env.local and modify User, Password and Database Name
 
* ```bin/console doctrine:database:create``` 

* ```bin/console make:migrations```

* ```bin/console doctrine:migration:migrate```

# Before each Commit : 

* ```php ./vendor/bin/php-cs-fixer fix -v --show-progress=dots```
