<?php
require '../config/database.php';
function ajoutEtudiant($matricule, $nom, $prenom, $genre, $dateNaiss, $telephone, $adresse, $promotion, $licence, $annee){
    $pdo=database();
    $insertion=$pdo->PREPARE("INSERT INTO etudiant(matricule, nom, prenom, genre, dateNaiss, telephone, adresse, promotion, licence, annee, photo) VALUES(?, ? , ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $insertion->execute(array($matricule, $nom, $prenom, $genre, $dateNaiss, $telephone, $adresse, $promotion, $licence, $annee, "student1.jpg"));
    return true;
}
function telExiste($telephone){
    $pdo=database();
    $verif=$pdo->PREPARE("SELECT*FROM etudiant WHERE telephone = ?");
    $verif->execute(array($telephone));
    return $verif->rowCount();
}
function matiereExiste($libele){
    $pdo=database();
    $verif=$pdo->PREPARE("SELECT*FROM matiere WHERE libele = ?");
    $verif->execute(array($libele));
    return $verif->rowCount();
}
function EmailExiste($email){
    $pdo=database();
    $verif=$pdo->PREPARE("SELECT*FROM user WHERE email = ?");
    $verif->execute(array($email));
    return $verif->rowCount();
}
function getEtudiants(){
    $etudiants = "SELECT * FROM etudiant";
    return $etudiants;    
}
function deleteEtudiant($matricule) {
    $pdo = database(); 
    $sql = $pdo->prepare("DELETE FROM etudiant WHERE matricule = ?");
    $sql->execute(array($matricule));
    $pdo = null;
    return true;
}
function getNumberOfStudents(){
    $pdo = database();
    $sql = "SELECT COUNT(*) AS total FROM etudiant";
    $result = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    $total = $result['total'];
    return $total;
}
function getStudentsHomme() {
    $pdo = database(); 
    $sql = "SELECT COUNT(*) AS total FROM etudiant WHERE genre='homme'";
    $result = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    $total = $result['total'];
    return $total;
}
function getStudentsFemme() {
    $pdo = database(); 
    $sql = "SELECT COUNT(*) AS total FROM etudiant WHERE genre='Femme'";
    $result = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    $total = $result['total'];
    return $total;
}
function updateStudent($nom, $prenom, $genre, $dateNaiss, $telephone, $adresse, $promotion, $licence, $annee, $matricule){
    $pdo = database();
    $update = $pdo->prepare("UPDATE etudiant SET nom=?, prenom=?, genre=?, dateNaiss=?, telephone=?, adresse=?, promotion=?, licence=?, annee=? WHERE matricule=?");
    $update->execute(array($nom, $prenom, $genre, $dateNaiss, $telephone, $adresse, $promotion, $licence, $annee, $matricule));
    return true;  
}
function generateMatricule($nom, $prenom){
    $nom = strtoupper(substr($nom, 0, 2));
    $prenom = strtoupper(substr($prenom, 0, 2));
    $pdo =database();
    $sql = "SELECT COUNT(*)  AS total FROM etudiant";
    $result = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    $nombre_enregistrements = $result['total'] + 1;
    $number = str_pad($nombre_enregistrements, 3, '0', STR_PAD_LEFT);
    $matricule = $nom.$prenom.$number;
    return $matricule;
}
function deleteAneeScolaire($code) {
    $pdo = database(); 
    $sql = $pdo->prepare("DELETE FROM annee_univer WHERE code = ?");
    $sql->execute(array($code));
    $pdo = null;
    return true;
}
// =========Debut partie annee Sclaires ================
function getAnneScolaire(){
    $pdo = database();
    $sql = "SELECT * FROM annee_univer";
    $result = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    $pdo = null;
    return $result;   
}
function updateAnneeScolaire( $dateDebut, $dateFin, $code){
    $pdo = database();
    $update = $pdo->prepare("UPDATE annee_univer SET  dateDebut=?, dateFin=? WHERE code=?");
    $update->execute(array($dateDebut, $dateFin, $code));
    return true;    
}
function ajoutAnneeScolaire($libele, $dateDebut, $dateFin){
    $pdo=database();
    $insertion=$pdo->PREPARE("INSERT INTO annee_univer(code, dateDebut, dateFin) VALUES(?, ?, ?)");
    $insertion->execute(array($libele, $dateDebut, $dateFin));
    return true;    
}
// =========Debut partie annee Promotion ================
function ajoutPromotion( $libele, $dateDebut, $dateFin){
    $pdo=database();
    $insertion=$pdo->PREPARE("INSERT INTO promotion(code, dateDebut, dateFin) VALUES(?, ?, ?)");
    $insertion->execute(array($libele, $dateDebut, $dateFin));
    return true;   
}
function getPromotion(){
    $pdo = database(); 
    $sql = "SELECT * FROM promotion";
    $result = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    $pdo = null;
    return $result;    
}
function deletePromotion($code) {
    $pdo = database(); 
    $sql = $pdo->prepare("DELETE FROM promotion WHERE code = ?");
    $sql->execute(array($code));
    $pdo = null;
    return true;
}
function updatePromotion($dateDebut, $dateFin, $code){
    $pdo = database();
    $update = $pdo->prepare("UPDATE promotion SET dateDebut=?, dateFin=? WHERE code=?");
    $update->execute(array($dateDebut, $dateFin, $code));
    return true;      
}
function getNumberOfPromotion(){
    $pdo = database();
    $sql = "SELECT COUNT(*) AS total FROM promotion";
    $result = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    $total = $result['total'];
    return $total;
}
// ===================Partie semestre ======================
function ajoutMatiere($libele, $semestre, $description){
    $pdo = database();
    $insertion = $pdo->PREPARE("INSERT INTO matiere(libele, semestre, descrip) VALUE (?, ?, ?)");
    $insertion ->execute(array($libele, $semestre, $description));
    return true;
}
function getMatiere(){
    $sql = 
    "SELECT 
        matiere.code,
        matiere.libele, 
        semestre.libele as semestre, 
        matiere.descrip 
    FROM 
        matiere 
    INNER JOIN 
        semestre ON matiere.semestre=semestre.code";

    return $sql;
}
function deleteMatiere($code){
    $pdo = database();
    $sql = $pdo->prepare("DELETE FROM matiere WHERE code=?");
    $sql ->execute(array($code));
    $pdo=null;
    return true;
}
function updateMatiere($libele, $semestre, $description, $code){
    $pdo = database();
    $update = $pdo->PREPARE("UPDATE matiere SET libele=?, semestre=?, descrip=? WHERE code=?");
    $update->execute(array($libele, $semestre, $description, $code));
    return true;
}
// ===================Partie enseignant ======================
function ajoutEnseignant($matricule, $nom, $prenom, $genre, $telephone, $adresse, $matiere, $diplome, $status){
    $pdo=database();
    $insertion=$pdo->PREPARE("INSERT INTO enseignant(matricule, nom, prenom, genre, telephone, adresse, matiere, diplome, status_en) VALUES(?,?,?,?,?,?,?,?,?)");
    $insertion->execute(array($matricule, $nom, $prenom, $genre, $telephone, $adresse, $matiere, $diplome, $status));
    return true;
}
function generateMatriculeEnseignant($nom, $prenom){
    $nom = strtoupper(substr($nom, 0, 2));
    $prenom = strtoupper(substr($prenom, 0, 2));
    $pdo =database();
    $sql = "SELECT COUNT(*)  AS total FROM enseignant";
    $result = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    $nombre_enregistrements = $result['total'] + 1;
    $number = str_pad($nombre_enregistrements, 3, '0', STR_PAD_LEFT);
    $matricule = $nom.$prenom.$number;
    return $matricule;
}
function getEnseignant(){
    $enseignant =
     "SELECT 
            enseignant.matricule, 
            enseignant.nom, 
            enseignant.prenom, 
            enseignant.genre, 
            enseignant.telephone, 
            enseignant.adresse, 
            matiere.libele as matiere,
            enseignant.diplome, 
            enseignant.status_en
        FROM 
            enseignant 
        INNER JOIN 
            matiere ON enseignant.matiere = matiere.code";
    return $enseignant;    
}
function updateEnseignant($nom, $prenom, $genre, $telephone, $adresse, $matiere, $diplome, $status, $matricule){
    $pdo = database();
    $update = $pdo->prepare("UPDATE enseignant SET nom=?, prenom=?, genre=?, telephone=?, adresse=?, matiere=?, diplome=?, status_en=? WHERE matricule=?");
    $update->execute(array($nom, $prenom, $genre, $telephone, $adresse, $matiere, $diplome, $status, $matricule));
    return true;   
}
function deleteEnseignant($matricule) {
    $pdo = database(); 
    $sql = $pdo->prepare("DELETE FROM enseignant WHERE matricule = ?");
    $sql->execute(array($matricule));
    $pdo = null;
    return true;
}
function getNumberOfEnseignant(){
    $pdo = database();
    $sql = "SELECT COUNT(*) AS total FROM enseignant";
    $result = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    $total = $result['total'];
    return $total;
}
function telExisteEnseignant($telephone){
    $pdo=database();
    $verif=$pdo->PREPARE("SELECT*FROM enseignant WHERE telephone = ?");
    $verif->execute(array($telephone));
    return $verif->rowCount();
}
// ===================Partie Note ======================
function ajoutNote($moyenne, $enseignant, $etudiant, $matiere){
    $pdo=database();
    $insertion=$pdo->PREPARE("INSERT INTO note(moyenne, enseignant, etudiant,matiere) VALUES(?, ?, ?, ?)");
    $insertion->execute(array($moyenne, $enseignant, $etudiant, $matiere));
    return true;
}
function getNote(){
    $notes = 
    "SELECT 
            note.code, 
            etudiant.matricule,
            CONCAT(enseignant.prenom, ' ', enseignant.nom) AS nomEnseignant, 
            CONCAT(etudiant.prenom, ' ', etudiant.nom) AS nomEtudiant,
            matiere.libele as nomMatiere, 
            note.moyenne
        FROM 
            note 
        INNER JOIN 
            enseignant ON note.enseignant = enseignant.matricule
        INNER JOIN
            etudiant ON note.etudiant = etudiant.matricule 
        INNER JOIN 
            matiere ON note.matiere = matiere.code";

return $notes;
}
function deleteNote($code) {
    $pdo = database(); 
    $sql = $pdo->prepare("DELETE FROM note WHERE code = ?");
    $sql->execute(array($code));
    $pdo = null;
    return true;
}
function updateNote($enseignant, $etudiant, $matiere, $moyenne, $code){
    $pdo = database();
    $update = $pdo->PREPARE("UPDATE note SET moyenne=?, enseignant=?, etudiant=?, matiere=? WHERE code=?");
    $update->execute(array($enseignant, $etudiant, $matiere, $moyenne, $code));
    return true;
}
function verifyNoteExiste($etudiant, $matiere){
    $pdo = database();
    $sql = $pdo->prepare("SELECT COUNT(*) FROM note  WHERE etudiant = ? AND matiere = ?");
    $sql ->execute(array($etudiant, $matiere));
    $result = $sql->fetch(PDO::FETCH_COLUMN);
    if($result > 0){
        return true;
    }else{
        return false;
    }
}
// ===================Partie Semestre ======================
function ajoutSemestre($libele, $dateDebut, $dateFin){
    $pdo=database();
    $insertion=$pdo->PREPARE("INSERT INTO semestre(libele, dateDebut, dateFin) VALUES(?, ?, ?)");
    $insertion->execute(array($libele, $dateDebut, $dateFin));
    return true;    
}
function getSemestre(){
    $pdo = database();
    $sql = "SELECT * FROM semestre";
    $result = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    $pdo = null;
    return $result;
}
function deleteSemestre($code) {
    $pdo = database(); 
    $sql = $pdo->prepare("DELETE FROM semestre WHERE code = ?");
    $sql->execute(array($code));
    $pdo = null;
    return true;
}
function updateSemestre($semestre, $dateDebut, $dateFin, $code){
    $pdo = database();
    $update = $pdo->PREPARE("UPDATE semestre SET libele=?, dateDebut=?, dateFin=? WHERE code=?");
    $update->execute(array($semestre, $dateDebut, $dateFin, $code));
    return true;
}
function getNoteSemestrielle($promotion, $semestre){
    $pdo = database();
    $sql = $pdo->query(
        "SELECT 
            etudiant.matricule,
            etudiant.prenom,
            etudiant.nom,
            note.moyenne,
            matiere.libele AS matiere,
            etudiant.promotion,
            semestre.libele as semestre,
            etudiant.annee
        FROM 
            note
        INNER JOIN 
            etudiant ON note.etudiant = etudiant.matricule
        INNER JOIN 
            matiere ON note.matiere = matiere.code
        INNER JOIN 
            semestre ON matiere.semestre = semestre.code
        WHERE
            promotion = '$promotion'
        AND 
            semestre.code = '$semestre'");
        return $sql ->fetchAll(PDO::FETCH_ASSOC);
}
// ===================Partie salle ======================
function ajoutSalle($salle, $capacite, $emplacement){
    $pdo=database();
    $insertion=$pdo->PREPARE("INSERT INTO salle(libele, capacite, emplacement) VALUES(?, ?, ?)");
    $insertion->execute(array($salle, $capacite, $emplacement));
    return true;    
}
function getSalle(){
    $pdo = database();
    $sql = "SELECT * FROM salle";
    $result = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    $pdo = null;
    return $result;
}
function deleteSalle($code) {
    $pdo = database(); 
    $sql = $pdo->prepare("DELETE FROM salle WHERE code = ?");
    $sql->execute(array($code));
    $pdo = null;
    return true;
}
function updateSalle($salle, $capacite, $emplacement, $code){
    $pdo = database();
    $update = $pdo->PREPARE("UPDATE salle SET libele=?, capacite=?, emplacement=? WHERE code=?");
    $update->execute(array($salle, $capacite, $emplacement, $code));
    return true;
}
// ===================Partie emploie du temps ======================
function ajoutEmplois($enseignant, $promotion, $licence, $matiere, $salle, $joure, $heure){
    $pdo=database();
    $insertion=$pdo->PREPARE("INSERT INTO emploi_temps(enseignant, matiere, promotion, niveau, salle, jour, heur) VALUES(?, ?, ?, ?, ?, ?, ?)");
    $insertion->execute(array($enseignant, $matiere, $promotion, $licence, $salle, $joure, $heure));
    return true;    
}
function getEmploie(){
    $result =
    "SELECT
        emploi_temps.code,
        CONCAT(enseignant.prenom, '  ', enseignant.nom) AS nomEnseignant, 
        emploi_temps.promotion,
        matiere.libele AS matiere,
        salle.libele AS salle,
        emploi_temps.jour,
        emploi_temps.heur,
        emploi_temps.niveau
    FROM
        emploi_temps
    INNER JOIN
        enseignant ON emploi_temps.enseignant = enseignant.matricule
    INNER JOIN
        matiere ON emploi_temps.matiere = matiere.code
    INNER JOIN 
        salle ON emploi_temps.salle = salle.code";

    return $result;
}
function deleteEmplois($code) {
    $pdo = database(); 
    $sql = $pdo->prepare("DELETE FROM emploi_temps WHERE code = ?");
    $sql->execute(array($code));
    $pdo = null;
    return true;
}
function updateEmplois($enseignant, $matiere, $promotion, $licence, $salle, $joure, $heure, $code){
    $pdo = database();
    $update = $pdo->PREPARE("UPDATE emploi_temps SET enseignant=?, matiere=?, promotion=?, niveau=?, salle=?, jour=?, heur=? WHERE code=?");
    $update->execute(array($enseignant, $matiere, $promotion,$licence, $salle, $joure, $heure ,$code));
    return true;
}
function getEmploiSemestrielle($promotion, $semestre, $licence){
    $pdo = database();
    $sql = $pdo->query(
        "SELECT 
            emploi_temps.code,
            CONCAT(enseignant.prenom, ' ', enseignant.nom) AS nomEnseignant, 
            matiere.libele as matiere,
            salle.libele as salle,
            emploi_temps.jour,
            emploi_temps.heur,
            emploi_temps.niveau,
            emploi_temps.promotion,
            semestre.libele as semestre
        FROM 
            emploi_temps
        INNER JOIN 
            enseignant ON emploi_temps.enseignant = enseignant.matricule
        INNER JOIN 
            matiere ON emploi_temps.matiere = matiere.code
        INNER JOIN 
            salle ON emploi_temps.salle = salle.code
        INNER JOIN 
            semestre ON matiere.semestre = semestre.code
        WHERE
            emploi_temps.promotion = '$promotion'
        AND 
            matiere.semestre = '$semestre'
        AND
            emploi_temps.niveau = '$licence'");
        return $sql ->fetchAll(PDO::FETCH_ASSOC);
}
function get_emploie_etudiant($promotion, $licence){
    $pdo = database();
    $sql = $pdo->query(
        "SELECT 
            emploi_temps.code,
            CONCAT(enseignant.prenom, ' ', enseignant.nom) AS nomEnseignant, 
            matiere.libele as matiere,
            salle.libele as salle,
            emploi_temps.jour,
            emploi_temps.heur,
            emploi_temps.niveau,
            emploi_temps.promotion
        FROM 
            emploi_temps
        INNER JOIN 
            enseignant ON emploi_temps.enseignant = enseignant.matricule
        INNER JOIN 
            matiere ON emploi_temps.matiere = matiere.code
        INNER JOIN 
            salle ON emploi_temps.salle = salle.code
        WHERE
            emploi_temps.promotion = '$promotion'
        AND
            emploi_temps.niveau = '$licence'");
        return $sql ->fetchAll(PDO::FETCH_ASSOC);
}
function verifyEmploisExiste($jour, $heur, $salle){
    $pdo = database();
    $sql = $pdo->prepare("SELECT COUNT(*) FROM emploi_temps WHERE jour=? AND heur=? AND salle=?");
    $sql -> execute(array($jour, $heur, $salle));
    $result = $sql->fetch(PDO::FETCH_COLUMN);
    if($result > 0){
        return true;
    }else{
        return false;
    }
}
function getNoteSemestrielleByEtudiant($matricule){
    $pdo = database();
    $sql = $pdo->prepare(
        "SELECT 
            etudiant.matricule,
            etudiant.prenom,
            etudiant.nom,
            note.moyenne,
            matiere.libele AS matiere,
            semestre.libele AS semestre
        FROM 
            note
        INNER JOIN 
            etudiant ON note.etudiant = etudiant.matricule
        INNER JOIN 
            matiere ON note.matiere = matiere.code
        INNER JOIN 
            semestre ON matiere.semestre = semestre.code
        INNER JOIN 
            promotion ON etudiant.promotion = promotion.code
        WHERE
            etudiant.matricule = ?");
    $sql->execute([$matricule]); 
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}
function ajoutUtilisateur($nom, $prenom, $telephone, $email, $password, $droit){
    $pdo=database();
    $insertion=$pdo->PREPARE("INSERT INTO user(nom, prenom, telephone, email, pass_word, droit, photo) VALUES(?,?,?,?,?,?,?)");
    $insertion->execute(array($nom, $prenom, $telephone, $email, $password, $droit, "user.jpg"));
    return true;
}
function getUser(){
    $sql = "SELECT * FROM user";
    return $sql;
}
function telExisteUser($telephone){
    $pdo=database();
    $verif=$pdo->PREPARE("SELECT*FROM user WHERE telephone = ?");
    $verif->execute(array($telephone));
    return $verif->rowCount();
}
function deleteUser($id) {
    $pdo = database(); 
    $sql = $pdo->prepare("DELETE FROM user WHERE id = ?");
    $sql->execute(array($id));
    $pdo = null;
    return true;
}
function updateUser($nom, $prenom, $telephone, $email, $password, $droit, $id){
    $pdo = database();
    $update = $pdo->PREPARE("UPDATE user SET nom=?, prenom=?, telephone=?, email=?, pass_word=?, droit=? WHERE id=?");
    $update->execute(array($nom, $prenom, $telephone, $email, $password , $droit, $id));
    return true;
}
function updateUserProfil($nom, $prenom, $telephone, $email, $id){
    $pdo = database();
    $update = $pdo->PREPARE("UPDATE user SET nom=?, prenom=?, telephone=?, email=? WHERE id=?");
    $update->execute(array($nom, $prenom, $telephone, $email, $id));
    return true;
}
function getNumberUser(){
    $pdo = database();
    $sql = "SELECT COUNT(*) AS total FROM user";
    $result = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    $total = $result['total'];
    return $total;
}
function connexion($email, $password) {
    $pdo = database();
    $connexion = $pdo->prepare("SELECT * FROM user WHERE email=? AND pass_word=?");
    $connexion->execute(array($email, $password));
    return $connexion->rowCount();
}
function userProfil(){
    $pdo = database();
    $profils =$pdo->prepare("SELECT * FROM user WHERE email = ?");
    $profils->execute(array($_SESSION['email']));
    return $profils->fetch(PDO::FETCH_ASSOC);
}
function userProfilEtudiant(){
    $pdo = database();
    $etudiants = $pdo->prepare("SELECT 
        etudiant.matricule, 
        etudiant.nom, 
        etudiant.prenom, 
        etudiant.genre, 
        etudiant.dateNaiss, 
        etudiant.telephone, 
        etudiant.adresse, 
        etudiant.promotion, 
        etudiant.licence, 
        etudiant.annee
    FROM 
        etudiant 
    WHERE matricule=?");
        $etudiants->execute(array($_SESSION['email']));
        $resuslt=$etudiants->fetch(PDO::FETCH_ASSOC);
    return $resuslt;
}

function verifyPassWord($password){
    $pdo = database();
    $email = $_SESSION['email'];
    $connexion = $pdo->prepare("SELECT * FROM user WHERE email=? AND pass_word=?");
    $connexion ->execute(array($email, $password));
    return $connexion->rowCount();
}
function updatePassWord($password){
    $pdo = database();
    $email = $_SESSION['email'];
    $update = $pdo->prepare("UPDATE user SET pass_word=? WHERE email=?");
    $update -> execute(array($password, $email));
    return true;
}
function ajoutHistorique($id_user, $date, $heure, $action){
    $pdo = database();
    $insertion = $pdo->prepare("INSERT INTO historique(id_user, date, heure, action) VALUES (?, ?, ?, ?) ");
    $insertion->execute(array($id_user, $date, $heure, $action));
    return true;
}
function getHistorique(){
    $historique = 
    "SELECT 
            historique.id, 
            CONCAT(user.prenom ,' ',user.nom) as names,
            historique.date,
            historique.heure,
            historique.action
        FROM 
            historique 
        INNER JOIN 
            user ON historique.id_user = user.id";
    return $historique;
}
function reinitialiser($email){
    $pdo = database();
    $profils =$pdo->prepare("SELECT * FROM user WHERE email = ?");
    $profils->execute(array($email));
    return $profils->fetch(PDO::FETCH_ASSOC);

}

function genererPassWord($longueur = 8){
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $longueurCaratere = strlen($caracteres);
    $password = '';
    for($i = 0; $i < $longueur; $i++){
        $password .=$caracteres[rand(0, $longueurCaratere - 1)];
    }
    return $password;
}
function ajoutInscription($etudiant,$annee, $licence, $date){
    $pdo = database();
    $insertion = $pdo->prepare("INSERT INTO inscription(etudiant, annee, licence, date) VALUES (?, ?, ?, ?)");
    $insertion->execute(array($etudiant, $annee, $licence, $date));
    return true;
}
function updateEtudiantInscrit($etudiant, $annee, $licence, $date, $id){
    $pdo = database();
    $update = $pdo->prepare("UPDATE inscription SET etudiant=?, annee=?, licence=?, date=? WHERE id=?");
    $update->execute(array($etudiant,  $annee, $licence, $date, $id));
    return true;  
}
function verifyLicenceExiste($etudiant, $licence){
    $pdo = database();
    $verif = $pdo -> prepare("SELECT * FROM inscription WHERE licence=? AND etudiant=?");
    $verif -> execute(array($licence, $etudiant));
    return $verif->rowCount();
} 
function getEtudiantInscrits(){
    $result =
    "SELECT
        inscription.id,
        CONCAT(etudiant.prenom, ' ', etudiant.nom) AS etudiant,
        inscription.annee,
        inscription.date,
        inscription.licence
    FROM
        inscription
    INNER JOIN
        etudiant ON inscription.etudiant = etudiant.matricule";
    return $result;
}
function deleteInscription($id) {
    $pdo = database(); 
    $sql = $pdo->prepare("DELETE FROM inscription WHERE id = ?");
    $sql->execute(array($id));
    $pdo = null;
    return true;
}
function getNumberInscrit($matricule){
    $pdo = database();
    $sql = "SELECT COUNT(*) AS total FROM inscription WHERE etudiant='$matricule'";
    $result = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    $total = $result['total'];
    return $total;
}
function noteIndividuelEtudiant($matricule){
    $pdo = database();
    $query = 
    "SELECT 
        etudiant.matricule,
        note.code,
        note.moyenne,
        matiere.libele as matiere,
        semestre.libele as semestre,
        etudiant.annee
    FROM 
        note 
    INNER JOIN 
        matiere ON note.matiere = matiere.code
    INNER JOIN 
        semestre ON matiere.semestre = semestre.code
    INNER JOIN 
        etudiant ON note.etudiant = etudiant.matricule
    WHERE etudiant = '$matricule'"; 
   
    return $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
}
// function noteIndividuelEtudiant($matricule){
//     $pdo = database();
//     $query = 
//     "SELECT 
//         note.code,
//         note.moyenne,
//         matiere.libele as matiere,
//         semestre.libele as semestre,
//         inscription.annee
//     FROM 
//         note 
//     INNER JOIN 
//         matiere ON note.matiere = matiere.code
//     INNER JOIN 
//         semestre ON matiere.semestre = semestre.code
//     INNER JOIN 
//         inscription ON note.etudiant = inscription.etudiant
//     WHERE inscription.etudiant = '$matricule'
//     GROUP BY note.code"; 
   
//     return $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
// }
function annee_scolaire($matricule){
    $pdo = database();
    $sql = "SELECT annee FROM inscription WHERE etudiant = '$matricule'";
    return $pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
}
function note_etudiant($matricule){
    $pdo = database();
    $sql = "SELECT COUNT(*) AS total FROM note WHERE etudiant='$matricule'";
    $result = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    $total = $result['total'];
    return $total;
}
function securite($name){
    $name = trim($name);
    $name = stripcslashes($name);
    $name = strip_tags($name);
    return $name;
}
function pourcentage($matricule) {
    $pdo = database();
    $sql = "SELECT moyenne FROM note WHERE etudiant = '$matricule'";
    $result = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    $somme = 0;
    $pourcentageMoyenne = 0;
    foreach($result as $note) {
        $somme += $note['moyenne'];
    }
    
    if ($result > 0) {
        $barèmeMoyenne = 10;
        $moyenne = $somme / 40;
        $pourcentageMoyenne = round(($moyenne / $barèmeMoyenne) * 100, 2);
    } else {
        $pourcentageMoyenne = 0;
    }

    return $pourcentageMoyenne; 
}

