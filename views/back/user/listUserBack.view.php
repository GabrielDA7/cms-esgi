<form action="<?= DIRNAME.USER_LIST_BACK_LINK;?>" method="POST">
        <label for="userName">  Pseudo           </label> <input type="text"     name="userName">  </br>
        <label for="name">      Prenom           </label> <input type="text"     name="name">      </br>
        <label for="firstName"> Nom              </label> <input type="text"     name="firstName"> </br>
        <label for="email">     Email            </label> <input type="email"    name="email">     </br>
        <label for="age">       Age              </label> <input type="number"   name="age">       </br>
        <input type="submit" name="submit" value="rechercher">
</form>

<table>
        <tr>
                <th>Id</th>
                <th>Pseudo</th>
                <th>Prenom</th>
                <th>Nom</th>
                <th>Age</th>
                <th>Supprimer</th>
                <th>Editer</th>
        </tr>
        <?php foreach ($users as $user) { ?>
                <tr>
                        <th><?= $user->getId(); ?></th>
                        <th><?= $user->getUserName(); ?></th>
                        <th><?= $user->getName(); ?></th>
                        <th><?= $user->getFirstName(); ?></th>
                        <th><?= $user->getAge(); ?></th>
                        <th>
                                <form action="<?= DIRNAME.USER_DELETE_LINK;?>" method="POST">
                                        <input type="hidden" value="<?= $user->getId(); ?>" name="id">
                                        <input type="submit" name="submit" value="X">
                                </form>
                        </th>
                        <th>
                                <form action="<?= DIRNAME.USER_EDIT_BACK_LINK;?>" method="POST">
                                        <input type="hidden" value="<?= $user->getId(); ?>" name="id">
                                        <input type="submit" name="submit" value="edit">
                                </form>
                        </th>
                </tr>
        <?php } ?>
</table>