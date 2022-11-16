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
      sidebar
    </div>
  </div>
    
  <div class="rowcont allcontentdiv">
    
        
    <div class="colcont" id='main_donuts'>
      <div class="rowcont" id='maingraph'>
        
          <span>
            <select name="dog-names" id="dog-names">
              <option value="hoy" default>Todas</option>
              <option value="ayer">filtro categoria</option>
              <option value="semana">filtro precio</option>
            </select>
            las 
            <select name="dog-names" id="dog-names">
              <option value="hoy" default>ventas</option>
              <option value="ayer">reabastecimientos</option>
              <option value="semana">ultima semana</option>
            </select>
            <select name="date-select" id="date-select" onchange="updateVistaGeneral()">
              <option value="hoy" default>hoy</option>
              <option value="ayer">ayer</option>
              <option value="semana">ultima semana</option>
              <option value="mes">ultimo mes</option>
              <option value="todo">todo</option>
              <option value="rango">entre {} y {}</option>
            </select>

          </span>
        
        <div style="width:100%;height:max(30vh, 100%)" class="colcont">
          <div id="graficolinea">
            a
          </div>
          <div style="" class="rowcont" id="masdatos">
          <span>Total</span>
            <div style="display:flex;color:red;align-items:flex-end;" id="totalventas"><span>100$</span><span style="font-size:0.7rem;white-space:nowrap;">▼ 15%</span></div>
            <span>C. Ventas</span>
            <div style="display:flex;color:green;align-items:flex-end;" id="cantventas"><span>10$</span><span style="font-size:0.7rem;white-space:nowrap;">▲ 30%</span></div>
            <span>% Mesas</span>
            <div style="display:flex;color:gray;align-items:flex-end;"><span>50%</span><span style="font-size:0.7rem;white-space:nowrap;">■ 0%</span></div>
          </div>
        </div>
      </div>
      <div style="" class="rowcont" id='donuts'>
        <div class="">
          <span>
            Ventas por Categorias
          </span>
        </div>  
        <div style="width:100%;align-content:space-around" class="colcont" id='donutrow1'>
        <div class="donut" id='donut1'>dpnut3</div><div class="donut" id='donut2'>donut4</div>
        </div>
        <div style="width:100%;align-content:space-around" class="colcont" id="donutrow2">
          <div class="donut" id='donut2'>dpnut3</div><div class="donut" id='donut4'>donut4</div>
        </div>
      </div>
    </div>
    <div class="colcont" id='data_recent'>
      <div style="" class="rowcont" id='numberdetails'>
        
        <span>Medio de Pago</span>
        <span>Efectivo</span>
        <div style="width:100%" class="flex flex-row">
          <span>15$</span>
          <span>100$</span>
        </div>
        <span>Tarjeta</span>
        <div style="width:100%" class="flex flex-row">
          <span>100$</span>
          <span>153,5$</span>
        </div>
        <span>MercadoPago</span>
        <div style="width:100%" class="flex flex-row">
          <span>100$</span>
          <span>153,5$</span>
        </div>
      </div>
      <div style="" class="rowcont" id='stock_graphs'>
        <div style="width:100%;height:33%;" class="colcont" id='stockrow1'>
          <div style="width:100%;height:100%;" class="colcont stockinfo" id='stock1'>
            <div>
              stockgraph
            </div>
            <div>
              <span>Quedan</span><br>
              <span>100 kg</span><br>
              <span>de Queso</span>
            </div>
          </div>
          <div style="width:100%;height:100%;" class="colcont stockinfo" id='stock2'>
            <div>
            stockgraph
            </div>
            <div>
            <span>Quedan</span><br>
              <span>100 kg</span><br>
              <span>de Queso</span>
            </div>
          </div>
        </div>  
        <div style="width:100%;height:33%;" class="colcont " id='stockrow2'>
          <div style="width:100%;height:100%;" class="colcont stockinfo" id='stock3'>
            <div>
              stockgraph
            </div>
            <div>
            <span>Quedan</span><br>
              <span>100 kg</span><br>
              <span>de Queso</span>
            </div>
          </div>
          <div style="width:100%;height:100%;" class="colcont stockinfo" id='stock4'>
            <div>
            stockgraph
            </div>
            <div>
            <span>Quedan</span><br>
              <span>100 kg</span><br>
              <span>de Queso</span>
            </div>
          </div>
        </div>  
        <div style="width:100%;height:33%;" class="colcont" id='stockrow3'>
          <div style="width:100%;height:100%;" class="colcont stockinfo" id='stock5'>
            <div>
              stockgraph
            </div>
            <div>
            <span>Quedan</span><br>
              <span>100 kg</span><br>
              <span>de Queso</span>
            </div>
          </div>
          <div style="width:100%;height:100%;" class="colcont stockinfo" id='stock6'>
            <div>
            stockgraph
            </div>
            <div>
            <span>Quedan</span><br>
              <span>100 kg</span><br>
              <span>de Queso</span>
            </div>
          </div>
        </div>  
      </div>
      <div style="max-height:35vh;overflow:auto;" class="rowcont overflow-auto" id='compras_recientes'>
        <span>Prouctos</span>
        <table style="width:100%;display:block;" class="" id='compras_recientes_content'>
        
        </table>
      </div>
    </div>
    
  </div>

</div>


</div>