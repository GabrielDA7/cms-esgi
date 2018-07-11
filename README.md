# Uteach

## c'est le projet annuel pour 3IW de ESGI

PHP > 7  

TODO


                              |BACK|

RSS
search bar (new view / search )
Corriger back add video
Ajouter author a chapter
Modifier author avec id (trainning)
Ajout et edition auteurs => session

Filter ajax ()
passowrd -> sha1 + grain de sel
remove live form video.class
Remove database columns from objects (problem when object db is used more than once)

rename the files where there are moved in the server (ex create a folder wich is named formation and put the formations into it and give a name like formation + id) -> do for the object class a function who return the file path (ex : video is : DIR . public.video . etc)

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

                              |FRONT|

VOIR element.trainning.title pour mettre le titre de la formation du chapitre voir le resulat du json (trainning a ete ajouté)
VOIR l'input de recherche au dessu des listes (trainning user chatper etc) une requete est envoyée a chaque lettre tapper
  arreter les requetes quand il n'y a pas de resultats et que l'utilisateur continue de tapper (ne pas faire de requtes inutiles)

View edit
