# Uteach

## c'est le projet annuel pour 3IW de ESGI

                              |PROD|
-- 1 --
$uri = preg_replace("/\//", '', urldecode($uri[0]), 1);
in index.php->getUriExploded()

-- 2 --
if (isHttpProtocole()) {
  RedirectUtils::redirectProtocoleHTTPS();
}
in index.php

-- 3 --
conf.inc.php
INSTALLATION -> FALSE

-- 4 --
Remove aaa and aaaa function in index.php

                              |SERVER|

php.ini
  post_max_size = 500M
  upload_max_filesize = 500M

PHP > 7  


                              |BACK|


paypal

premium
  new function in userDelegate
  new column in table video / trainning / chapter -> premium (boolean)
  getByID -> checkPremium Status (synchrone) + check publish status

premium / status check authorisation

views evolution
statisitc premium

Add table infos (Facebook / Twitter / Linkedin / Footer text)

replace space by underscore (file)

view logs (see all logs files and can download them)

-- DONE -- Problem AJAX : url = dirname + "ajax/list?object=" + object + "&page=" + page + "&sort=" + order + "&columnName=" + column_name +"&itemsPerPage=" + itemsPerPage + "&
            status=1";
           avec itemsPerPage = 10 retourne + de resultat
-- DONE -- RSS only when page contains items
-- DONE -- parametersController (BDD)
-- DONE -- reset password email
-- DONE -- Creer nouvelle fct dans le ajaxController pour listeCommentaire qui prend en compte l'id
-- DONE -- remove form check from list because ajax
-- DONE -- secure the search ajax (if object is user he can get all the user data)
-- DONE -- Refactoring objectDelegate
-- DONE -- search :
           create a search config on all classes to set the possible columns to search (It's to not search with id column with a string for example)
-- DONE -- search bar action
-- DONE -- remove live form video.class
-- DONE -- Corriger back add video
-- DONE -- rename the files where there are moved in the server (ex create a folder wich is named formation and put the formations into it and
           give a name like formation + id) -> do for the object class a function who return the file path (ex : video is : DIR . public.video . etc)
-- DONE -- Ajouter author a chapter
-- DONE -- Modifier author avec id (trainning)
-- DONE -- change date to dateInserted
-- DONE -- User add ->setAvatar with default image
-- DONE -- Recherche author
           if getColumns contains user_id search in user where author = query and id = user_id
-- DONE -- Ajout et edition auteurs => session
-- DONE -- Statistics
            create table statistic / viewed_trainning / viewed_chapter / viewed_video
            create statisticDelegate OR in getById() insert in table
            every going to statistic page -> insert stat OR every day ?
            statistic page get the latest stat
            set machine ip
-- DONE -- publish content (chapter / trainning / video)
            status in db 0 disabled 1 enabled
            ajax list front -> don't show disabled
-- DONE -- FIXE le recherche pour les commentaires ( AJAX :http://localhost/uteach/ajax/search?object=comment&search=1&column_name=report )

                              |FRONT|

Ajouter form/list pour premium
Ajouter form parameters
Afficher list reported comments back
Afficher plus de commentaire load_data_comment
add a label which is the key of the input where it is a SELECT (for the installation : back template / front template we don't know)
Edit profile CSS
View edit
go to profile when click on user(userame / avatar) in comment -> route = user/user?id=x
add button or href to see RSS flux -> see files in bin/xml/
installation -> css (conf.inc.php -> set INSTALLATION_DONE to FALSE)
statistic :put aaa($this->data); in indexController statisticAction above view
vue parameters edit dbname / dbhost / dbuser / dbport / language


!!! REGARDER SI LES BUGS VIENNENT PAS DE MR GABRIEL DAOUD !!!


-- SEE LATER -- Comment use modal
-- SEE LATER -- VOIR l'input de recherche au dessu des listes (trainning user chatper etc) une requete est envoyée a chaque lettre tapper arreter les requetes quand il n'y a pas de       --resultats et que l'utilisateur continue de tapper (ne pas faire de requtes inutiles)

-- DONE -- Ajouter la gestion de pagination pour la recherche
-- DONE -- Search nav bar 3 search ajax request :training / chapter / video get the 3 lists and print them view search.view.php (not created) index/search
-- DONE -- List comments
-- DONE -- home page ajax list with item = 5 and order = desc / columns=dateInserted
-- DONE -- publish content add hidden input with name=status and value = 1 or 0 depend on actual status
-- DONE -- Add edition tools
-- DONE -- errors == false print "the content has been added"
-- DONE -- 404 page
-- DONE -- modify every references to author in js file and replace by element.user.userName
-- DONE -- VOIR element.trainning.title pour mettre le titre de la formation du chapitre voir le resulat du json (trainning a ete ajouté)
