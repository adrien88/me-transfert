<h2>Envoyez des fichiers</h2>
<form action="$ROUTE/file/send/" method="POST" enctype="multipart/form-data">
    <h3>Vous</h3>
    <fieldset>
        <label for="userlogin"> <b>Votre ID.</b> (pseudo, diminutif, initiales, blase...)</label><br>
        <input type="text" name="userelogin" id="userelogin" placeholder="Culcul la Praline !"><br>

        <label for="useremail"> <b>Votre email !</b> </label><br>
        <input type="email" name="useremail" id="useremail" placeholder="foo.bar@mail.tld"><br>
    </fieldset>

    <h3>Destinataires</h3>
    <fieldset id="addEmail">
        <label for="email_1"><b>Email</b></label><br>
        <input type="email" name="destemail" id="email_1" placeholder="foo.bar@mail.tld">
        <br>
        <!-- <input type="checkbox" id="check">
        <label for="check">Colis livré.s ?</label> -->
    </fieldset>
    <!-- <button onclick="" disabled>+ ajouter un destinataire</button> -->

    <h3>Fichiers</h3>
    <fieldset id="addFile">
        <label for="file_1"><b>Fichier à joindre</b> (2Mb max)</label><br>
        <input type="file" name="files" id="file_1"><br>
        <!-- <label for="file_password_1"><b>Mot de passe</b> </label><br>
        <input type="password" id="file_password_1"> -->
    </fieldset>
    <!-- <button onclick="" disabled>+ ajouter un un fichier</button> -->

    <h3>Envoyer</h3>
    <fieldset>
        <button class="primary" type="submit" onclick="confirm('Confirmation d\'envois')">Envoyer</button>
        <button class="secondary" type="reset" onclick="confirm('Confirmation d\'éffacage')">Effacer</button>
    </fieldset>
</form>