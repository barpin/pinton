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

?>

<div style="width:100%;height:auto;" class="colcont">


  <div class="rowcont sidebar">
    <div class="col-1">
      
    </div>
  </div>
    
  <div class="rowcont allcontentdiv">
    
    
      <div style="overflow:auto;" class="rowcont overflow-auto" id='lista_productos'>
        <h2>Productos</h2>
        <table style="width:100%;display:block;" class="" id='compras_recientes_content'>
        
        </table>
      </div>
    
    
  </div>

</div>


</div>