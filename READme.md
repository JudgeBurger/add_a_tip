# Add_a_tip c'est quoi ?

Add a tip, permet de stocker et de retoruver l'ensemble des trucs et astuces dont vous avez besoin au quotidien, tous les 6 mois, tous les 10 ans ... . <br>

Grâce à un simple système de card, il est possible d'ajouter tous les trucs et astuces dont vous voulez vous souvenir.


# Composition d'une Card : 
#####Name : 
* nom de votre tip
#####Language: 
* le language ou la technologie concernée
#####Description: 
* Une courte description du Tip
#####Picture: 
* Une capture d'écran de votre Tip
####Code: 
* une ligne de code qu'il est possible de copier/coller directement dans votre terminal, votre IDE...

---------------------------------------------------------------------------------------------------------------------------------------------------------

### Fonctionnalités disponible :

* Ajouter un Tip

### Fonctionnalité en cours de developpement :

* Clipboard 

### Fonctionnalité à venir : 

* Créer un Compte personnel
* Ajouter des tips à votre collection
* Effectuer une recherche dans tous vos Tips
* Consulter les Tips de la communauté
* Commenter un tip
* Liker un Tip
* Enregistrer un Tip dans votre collection

---------------------------------------------------------------------------------------------------------------------------------------------------------

 # Installation du projet :
 
* ```git clone https://github.com/JudgeBurger/add_a_tip.git```
 
* ```composer install```

* ```yarn install``` <br>
run ```yarn encore dev --watch```

 
* Copy .env in .env.local and modify User, Password and Database Name
 
* ```bin/console doctrine:database:create``` 

* ```bin/console make:migrations```

* ```bin/console doctrine:migration:migrate```

 # Avant chaque commit : 
 
 * ```php ./vendor/bin/php-cs-fixer fix -v --show-progress=dots``` 
