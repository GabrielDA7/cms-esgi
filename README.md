# Uteach

## c'est le projet annuel pour 3IW de ESGI

PHP > 7  

TODO


                              |SERVER|

php.ini
  post_max_size = 500M
  upload_max_filesize = 500M


                              |BACK|

Recherche author 
  if getColumns contains user_id search in user where author = query and id = user_id 


RSS
paypal
publish content (chapter / trainning)
Statistics
parametersController (varibles.scss)
Ajout et edition auteurs => session
replace space by underscore (file)

passowrd -> sha1 + grain de sel

Remove database columns from objects (problem when object db is used more than once)

for the parts find a way to save the location of the videos and the pictures  
  ex : %image1% will be replace by  

-- SEE LATER -- find a way the change the working of setReferencedObjectsColumns() in objectDelegate  
                We have to get the refernced object with a join query

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

                              |FRONT|

VOIR l'input de recherche au dessu des listes (trainning user chatper etc) une requete est envoyée a chaque lettre tapper
  arreter les requetes quand il n'y a pas de resultats et que l'utilisateur continue de tapper (ne pas faire de requtes inutiles)


Search nav bar
	3 search ajax request :
		training / chapter / video
	get the 3 lists and print them
	view search.view.php (not created)

home page
  ajax list with item = 5 and order = desc / columns=dateInserted


errors == false print "the content has been added"

add a label which is the key of the input where it is a SELECT
  (for the installation : back template / front template we don't know)

Edit profile CSS
View edit

List comments
Comment use modal

Add edition tools

404 page

-- DONE -- modify every references to author in js file and replace by element.user.userName
-- DONE -- VOIR element.trainning.title pour mettre le titre de la formation du chapitre voir le resulat du json (trainning a ete ajouté)
