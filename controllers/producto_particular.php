<?php
define('p', '../');
require p.'assets/session_start.php';
require p.'assets/database.php';

/*
require_once 'assets/database.php';

session_start();
if (!loggedin){
    include 'login.php';
    exit;   
}




*/

/*
https://www.youtube.com/watch?v=tG7ffaiUVPo
https://recharts.org/en-US/api/LineChart
https://babeljs.io/repl#?browsers=&build=&builtIns=false&corejs=3.21&spec=false&loose=false&code_lz=PTCWFsAcHsCcBcAEAlApgQwMZIGa2uIgESwbZEDcAUCBDAogN6IAKArqQMIEwB2qvJAF9EeAsVJZ4lGmChwkzTugSoAzqHS8A4rFAATADSIAMqgDmAo6dD9jJ26k4ALFfGNo1fDQDcn0QXRHWGMAFWhoABt4UEhjAA0AQQAPUDVjAE0UtJExQhJUTFcENRlMALUkVEQAXhQyeAA6TEl4VABRSNRwAXhqKhw2XmxQAMRIAApbSDZ4AEpGKkRlxHLeNSjURsjocyneGfnqFcRSeA5eRGnZ6iEqKh8VVYC2wQAjaGTaxH1oTDYeoJGgBHNioWAATwAyqgutg4BMAOQAYjWr3giLm1DWGy6212SIA7nAANa2cyY_o4pCQdCWNTfRYnRE-NLwdAAfUs_Fg6EiiIAXIgJnMagA-JknFZdXCRRzob5oKQAEQA8gBZZqtVDICLwCa_f6Apqg8HQ2GFeAIlHmXk4UDlOX8dCYrFLKXLGU_AKzBl1RKwXkQxqQfBW-AQyBbcDoSDNPmRA1_AG9EFgyEwuFW2CJSKJxGNX68WaY4zJcVK7BqzUtDBtXXQfXJOZuj3LHGbfF7Iu-1ttnBOjCNUi8fTgiYAHgc_CKbkQj0iYJqkrbKwA2oxeOgekLESw6dVEojDGwfEKACwABmvhkgZ8QACYr5fDNv4EKnzehIZN9vULv90sRAACFj1PIUAGZrxfO8hQARgggBOAAOV9wHfR8Hzgl9v1_HdED3A9EE4MD7wfaDb3vFCbzfD8H0QnCfy3fDCKA5VSI_AB2ZCYPvJDL1Q2jHwo3DmP_AjAOqdoOMQODkIYyiLx4l8hKw5C4MMUS_wAoiADEZIffjFMQCDlLQjCHwAVi_JjtIkojtBkiDzwU2DEHPKCVPQj9sMYgBdd0PSEYAxT7D0cDgYUvXLS8KGSCce3gNRtgEcx4GcOKAGpMoWQLV29YskrXZI_OHKxxwnZV0HZFhQHUec-SXFd8pODdEDE3ddGgNhIEQI9jAXMEL2vRBcPauzES6nqQOPBrF3EzzRp_caWKm3qSIGxqFpGsaOoItbEHYzb5o_HbDAClrlhEEK5jyk47lXM4Llk44VjuKh3sGYYYjGSx4FpICJgBgQ_1yk4OzxHY9mBsSwtEVB4CKCYiGANF8DzcE1GAIhMphv9MoLSBnEgWbmpOHp0ugfQBSIbR2lCIhDDulZazHQRNEiNRdzUP8AFo4FAcxbFm5nlnAKnxMRHmen5vQhd4Y9RdWLBnEl3hoF5zAVdQRX7tuk5GnSgQJgmUgvAqVA5lqMVTnUbwtjaZJ9RbQ3Vd4E3nHgcBIjN-3RQlJW0V6D5kkaWweQACVCdUTBqT3vd9i3Xo9YG1DXPGej8kVk8QPKhDmeNEecE3wXwWArfFJhA4qTsoYmUu4Dhk4ntgS5Yrzt13tkXme97vv-4HweB_VIJLkkxBKjYHAcCH2e59nqhMEidA1AZadCmKKonasBlKyadguB4AJeirvKRzHWARSrx6EeeiYlYnNBZxKRpPG8UA_G4QJgkQQkDHSmoRBfIAFIiCIFVoLT2gCQFEDFErE4j8N5uGSuvFwbh4ErD_voABjBrKXgepdCB5goGME8gQlq-hqroGXOlNIIZ8CQGSoNVA5D8oxlgPLZcZNLpWkgEKSyTNLpSjlp7SCL4MEei6DgCy4ihEnA-PAK04B-GCMukIVhq44FCMQc_JKjRlCqA0FoXQBgJ7wHwCSVAVU1DFCDIAiCJkwEhQkYgHRm9kpJFSAySh7IADSqAISALEk4rRl03HIMaFkLxiBnHaKfu4xo4QogxF6rEsJ8SIlmG5PoGJoSWrhJfuvRAEYoyAPFurK0_AwE-PQP4wJRA7xgMqBY1AgDkTIQ6eefQyEwFSA_lYxsXDThCmQqNa6eT8oFL0UUkprSiDlMbMfapVC6mANPE08x0BLFtOQg-LWiF9AhJcROYAGTCmODQQgCZCDTlIJfm_Co_Sv7smCNclYcM7hd2pLbUc4JEgjD8FCVwUZvhAwYWoCuNtJTfOQIkZUABJRIAA5b4I90qNBYPCmJskeKvW-cwTAyRjCYAhMYcABhEi8HMF0Yw4dwTIHQPoUAbB0iIG6m0WADKmUsuMJUNwlLqWoGMFYAVNLRCgDzMYWkEIdiMqleCTAvRjpglGt8UM0BGF4oqEgDQlw6houcI0XVExeawoRcixAAAqRA5L9Cistlq9YSByh-kQAa5o0A1AmrNYilF1rbX2r7N8tQXw6iEsQJlYU7L6WMuZQySN2ErbWpdY6yoE8ITfBJRGqNswY3cvjbJS8SaJ62FTUgcAobVhfEjRMaNnLY0suzVBYtKb3TfPABmsNGaa11q5XGptRarUlt4GWxAqBK0VuzRMF1iAxR1EvIgAA_LJRAQpeZwWLQ-B8o6AnfA7aOx28BKVFEimGz1s751LoInyhAiJV0ESsIifoywW6XHvggs5ejzBvKmclQ9iByyMEJSIQJQGIQiH0KB5CIhD3HucHAMpBh9BdDAfaPMy40ORCEG85YjBpWyv0I0MSGjXG3N0X-8d8Af2fuSjCeEsBA6AeA4HUDJKSPLDpfW_Ny5ON9pZextluauNxuXL2htagBM3qPVSroy4pP2oEyKmTrTGBKcFQJzDGGJVYeZmkj9dy9F0ezIx5czHVwktM-BpW8nlNyfZAgBTSs1OydU6ORzq5ePidE0JvjBaABsAmxPccYEF_tCb8FK004wTDJG9MrF_SGaqzgfjLgAAbqgACSMBDd-LLahwMmCyxW3LjAO1CEK6p5IJWAlCFSyIZpWyVMxfFehog6sqm5OZglzAoBYBL2qIS5c46RAWdU-B04y4Hy5G01pvM9XNnbLa0szrHoEv_sA-OqdM652IAXcuuC9713FrglNxAoGavFMo3BhDjBYPDHg7AabrXkQQVe7AxgqWWAADVEBZeYbVoQJyaOG0o9RgzFGnYAaG9W4U23L37cOxuodJ2QNDfG5B5cckYNXfuzdu7J7HstciG0xCpPYFKw-xMBlbRfuMCBgqk-1rfIFytLpUAyRUD6AmA-OYQhgFzDq11sjCTD0TKB-Dxo373Sd36OO-gzrl6r0OlQ2q9VKM73qFIDFHB_DyH4IIU-yw-U07qM1Ppfh4W_OSEKWRo1n1st4Kr9oghwSgo5LSq3kLr4rFoclNQCMoTsjaBMbh5vUCW7HNbq4VvVFXT7EIe359xxW2aq-4UXXgcPPWE8l4o9XdYIAUA68oDwGoEgfAaBxfyergS6ry5SAC_OGXM-EQRCSEt5w_F4HquXFh4j-Omhzg6HG62H3q3AmThh6BbGFTSecwAtQNPqME-Vg1MH3Q9VjDGj_ZcYNog1lQG7_qQfogLjPPBb8xFoRoWWXLh4iv5YmmiDtM6d00_QiamrKIMw9_l0Ajqm6n92dw5XX2SgCCdxd0ewwTixuW7zqnrx_WFwiSz18H8G_h5AmXjw-nuBoEtQGCGBGDGBjGmAPBFGakeFgEQGoT-mBiRFZD5S5AEHBD5EpCVgoNEEHAVDqD3mrC1DrB1D1CBiTCNFTFNAzAtHoyRGRGIKpV5CJldCbhWAHHlDKl-UvinEcF0TFBOXXi0LhmwPuBkNoLmEtWAHuBoNIJZDZE5G5GYP5DmCAA&debug=false&forceAllTransforms=false&shippedProposals=false&circleciRepo=&evaluate=false&fileSize=false&timeTravel=false&sourceType=module&lineWrap=true&presets=es2015%2Creact%2Cstage-2&prettier=false&targets=&version=7.19.2&externalPlugins=&assumptions=%7B%7D

https://www.chartjs.org/docs/latest/

PowerShell.exe -NoProfile 
Set-ExecutionPolicy -ExecutionPolicy Bypass
npx babel --presets @babel/preset-react --watch ./main.jsx -o ./main.js
*/
if(intval(entries("SELECT (perms & 2)!=2 FROM users WHERE id = ${_SESSION["id"]}", true)[0][0])){
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
    
        
    <div class="colcont" id='main_donuts'>
      <div class="rowcont" id='maingraph'>
        
          <span>
            <select name="date-select" id="date-select" onchange="updatePP()">
              <option value="hoy" >hoy</option>
              <option value="ayer">ayer</option>
              <option value="semana">ultima semana</option>
              <option value="mes" default>ultimo mes</option>
              <option value="todo">todo</option>
            </select>

          </span>
        
        <div style="width:100%;height:max(30vh, 100%)" class="colcont">
          <div id="graficolinea">
            a
          </div>
          <div style="" class="rowcont" id="masdatos">
            <br>
          <span>Total</span>
            <div style="display:flex;color:red;align-items:flex-end;" id="totalventas"><span>100$</span><span style="font-size:0.7rem;white-space:nowrap;">▼ 15%</span></div>
            <span>C. Ventas</span>
            <div style="display:flex;color:green;align-items:flex-end;" id="cantventas"><span>10$</span><span style="font-size:0.7rem;white-space:nowrap;">▲ 30%</span></div>
            <br>
            <br>
            <br>
            <br>
          </div>
        </div>
      </div>
      <div style="width:50%" class="rowcont" id='ingredientes'>
        <span>Ingredientes</span>
        <table style="width:100%;display:block;" class="" id='compras_recientes_content'>
        
        </table>
      </div>
    </div>
    
  </div>

</div>


</div>