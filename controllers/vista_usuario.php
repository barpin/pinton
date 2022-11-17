<?php
define('p', '../');
require p.'assets/session_start.php';
require p.'assets/database.php';

/*

*/
if(intval(entries("SELECT (perms & 4)!=4 FROM users WHERE id = ${_SESSION["id"]}", true)[0][0])){
  ?>
  <div style="width:100%;height:auto;text-align:center;align-items:center;font-size:3rem;color:darkgray;" class="colcont">No tienes permiso para acceder a este recurso.</div>
<?php
    exit;
};
$assoc=entries("SELECT * FROM users WHERE id = ${_SESSION["id"]}")[0];
?>

<div style="width:100%;height:auto;" class="colcont">


  <div class="rowcont sidebar">
    <div class="col-1">
      
    </div>
  </div>
    
  <div class="rowcont allcontentdiv">
    
    
      <div style="overflow:auto;" class="rowcont overflow-auto" id='lista_productos'>
        <b>Mail</b>: <?= $assoc["email"] ?>
      </div>
      <b>Permisos</b>
      <div style="overflow:auto;" class="rowcont overflow-auto" id='lista_productos'>
        <?php
        //var_dump("SELECT * FROM categories WHERE ((SELECT perms from users where id = ${_SESSION["id"]})) & (POW(2,id))");
        foreach (entries("SELECT * FROM categories WHERE ((SELECT perms from users where id = ${_SESSION["id"]})) & (POW(2,id))") as $perm){
        //var_dump($perm);}
        ?>
        <span> <?= $perm["name"] ?>
</span>
                <?php } ?>
      </div>
      <a type="button" class="btn btn-primary" style="display:inline;" href="controllers/logout.php">Desloguearse</a>
    
  </div>

</div>


</div>