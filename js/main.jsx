//import React from "react";
//import { PureComponent } from "react";
//import { CartesianGrid, Legend, Line, LineChart, ResponsiveContainer, Tooltip, XAxis, YAxis} from "recharts";
const e = React.createElement;
//var ptrigcount=0;
function p(input){
    console.log(input);
    return input;
}

var flinea;
var donuts;
var stonks;
var stockgraphs;





var contentbox = document.querySelector('#content');
console.log('working');

const pages = {
    'vista_general': (fecha="hoy")=>{  ///////////VISTA GENERAL//////////////////////////



        fetch("./api/vista_general.php?rango="+fecha, {
            method:"GET",
            credentials: 'same-origin', 
            mode: 'same-origin',
            cache: 'no-cache',
        })
        .then((response) => response.text()).then((htmlresponse)=>{
            apiresponse=JSON.parse(htmlresponse);
            
            //CREAR ROOTS DE REACT SI NO ESTAN CREADAS
            if (!document.querySelector('#graficolinea').firstElementChild ){
                flinea = ReactDOM.createRoot(document.querySelector('#graficolinea'));
                donuts = Array.prototype.map.call(document.querySelectorAll('.donut'), x=>ReactDOM.createRoot(x));
                //donuts = Array.prototype.map.call(document.querySelectorAll('.donut'), x=>gengraph(x));
                //donuts = Array.prototype.map.call(document.querySelectorAll('.donut'), x=>new ApexCharts(x, {chart: {id: `donutChart${x}`}}));
                stonks = document.querySelectorAll('.stockinfo');
                stockgraphs = Array.prototype.map.call(stonks, x=>ReactDOM.createRoot(x.children[0]));
            } 
            
            
            //console.log(donuts);

            //ARMAR GRAFICO DE LINEA PRINCIPAL
            flinea.render(<Linechart value={
                apiresponse[0].map(x=>{
                    return {name:x["fecha_grupo"], monto:Number(x["preciofinal"])}
                })
            }/>);

            donutdata=apiresponse[1];
            //ARMAR GRAFICOS DE DONAS

            
            for (let x=0;x<donuts.length;x++){
                donuts[x].render(<DataPies value={
                    apiresponse[1][x].map(x=>{
                        return {name:x["name"], value:Number(x["count"])}
                    })
                } />)
            }
            /*
            for (let x=0;x<donuts.length;x++){
                donuts[x].updateSeries([44, 55, 13, 43, 22])
            }
*/
            //ARMAR GRAFICOS DE STOCK
            for (let x=0;x<stockgraphs.length;x++){
                stockgraphs[x].render(<Stockchart value={
                    [{name: 'Page A',uv: 4000,pv: 2400,amt: 2400,},{name: 'Page B',uv: 3000,pv: 1398,amt: 2210,},{name: 'Page C',uv: 2000,pv: 9800,amt: 2290,},{name: 'Page D',uv: 2780,pv: 3908,amt: 2000,},{name: 'Page E',uv: 1890,pv: 4800,amt: 2181,},{name: 'Page F',uv: 2390,pv: 3800,amt: 2500,},{name: 'Page G',uv: 3490,pv: 4300,amt: 2100,},]
                }/>)
            }

            //document.querySelector("#date-select").addEventListener('change', updateVistaGeneral(), false);

            //ARMAR DATOS DE COMPTA
            let ventas=document.querySelector("#totalventas");
            let nventas=document.querySelector("#cantventas");
      
      
            ventas.childNodes[0].innerHTML="$"+apiresponse[2]["total"][0];
            ventas.childNodes[1].innerHTML=(apiresponse[2]["total"][1]>0 ? "▲":"▼")+Math.round(apiresponse[2]["total"][1])+"%";
            ventas.style.color=apiresponse[2]["total"][1]>0 ? "green":"red";
      
            nventas.childNodes[0].innerHTML=+apiresponse[2]["cantidad"][0];
            nventas.childNodes[1].innerHTML=(apiresponse[2]["cantidad"][1]>0 ? "▲":"▼")+Math.round(apiresponse[2]["cantidad"][1])+"%";
            nventas.style.color=apiresponse[2]["cantidad"][1]>0 ? "green":"red";

            //ARMAR COMPRAS RECIENTES
            let recientes = document.querySelector("#compras_recientes_content");
            let tmpelstr="";
            apiresponse[4].forEach(element => {
                tmpelstr+=`
                <tr class="" style="width:100%;">
                    <td class="receientescell" style="width:25%">
                        <span>${element["fecha_y_hora"].substr(0,10)}</span><br>
                        <span style="font-size:0.9rem;color:gray;">${element["fecha_y_hora"].substr(10,10)}</span>
                    </td>
                    <td  class="receientescell" style="width:50%">
                        ${element["name"]} ${ (element["cantidad"]>1 ? `<span>×${element["cantidad"]}</span>`:"") }
                    </td>
                    <td class="receientescell" style="color:green;width:25%">
                        $ ${element["precio"]}
                    </td>
                
                </tr>
                `
                
                /*
                childnode = document.createElement("div");
                childnode.classList.add("colcont");

                recientes?.appendChild(
                    childnode
                );
                console.log(element);*/
            });
            recientes.innerHTML= tmpelstr;
            

            return 1;
        

            

        }).catch((error) => {
            console.log(error);
            return 0;
        });



    }, 
    'vista_productos': (filter="none")=>{ //////////////////////////////////////////PRODUCTOS///////////////////////////////

        fetch("./api/vista_productos.php?filter="+filter, {
            method:"GET",
            credentials: 'same-origin', 
            mode: 'same-origin',
            cache: 'no-cache',
        })
        .then((response) => response.text()).then((htmlresponse)=>{
            apiresponse=JSON.parse(htmlresponse);
            

            let recientes = document.querySelector("#compras_recientes_content");
            let tmpelstr=`<tr class="" style="width:100%;">
            <th class="receientescell" style="">Nombre</th>
            <th class="receientescell" style="">Precio</th>
            <th class="receientescell" style="">Precio</th>
            <th class="receientescell" style="">n. de Ventas</th>
            <th class="receientescell" style="">Monto de Ventas</th>
            <th class="receientescell" style=""></th>

        </tr>`;
            apiresponse[0].forEach(element => {
                tmpelstr+=`
                <tr class="" style="width:100%;">
                    <td class="receientescell" style="">
                        <span>${element["name"]}</span><br>
                        <span style="font-size:0.9rem;color:gray;">${element["cat"]}</span>
                    </td>

                    <td class="receientescell" style="color:green;">
                        $ ${element["price"]}
                    </td>
                    <td id="graph${element["id"]}" class="receientescell" style="color:green;">
                        $ ${element["price"]}
                    </td>
                    <td class="receientescell" style="color:green;">
                         ${element["totalunidades"]==null ?0:element["totalunidades"] }
                    </td>
                    <td class="receientescell" style="color:green;">
                        $ ${Math.round(element["totalprecio"]*100)/100}
                    </td>
                    <td>
                    <button type="button" class="btn btn-primary" style="display:inline;" onclick="updatePP(${element["id"]})">Ver Mas</button>
                    </td>
                
                </tr>
                `
                

            });
            recientes.innerHTML= tmpelstr;
            

            return 1;
        

            

        }).catch((error) => {
            console.log(error);
            return 0;
        });


    },

    'vista_ingredientes': ()=>{ //////////////////////////////////////////PRODUCTOS///////////////////////////////

        fetch("./api/vista_ingredientes.php", {
            method:"GET",
            credentials: 'same-origin', 
            mode: 'same-origin',
            cache: 'no-cache',
        })
        .then((response) => response.text()).then((htmlresponse)=>{
            apiresponse=JSON.parse(htmlresponse);
            

            let recientes = document.querySelector("#compras_recientes_content");
            let tmpelstr=`<tr class="" style="width:100%;">
            <th class="receientescell" style=";">id</th>                
            <th class="receientescell" style=";">name</th>                
            <th class="receientescell" style=";">stock</th>                
            <th class="receientescell" style=";">veces usado</th>                
           

        
        </tr>`;
            apiresponse.forEach(element => {
                tmpelstr+=`
                <tr class="" style="width:100%;">
                    <td class="receientescell" style="color:green;">
                        ${element["id"]} 
                    </td>                
                    <td class="receientescell" style="">
                        <span>${element["name"]}</span><br>
                    </td>

                    <td class="receientescell" style="color:green;">
                         ${element["stock"]} ${element["unit"]}
                    </td>
                    <td class="receientescell" style="color:green;">
                         ${element["totalunidades"]==null ?0:element["totalunidades"] }
                    </td>

                
                </tr>
                `
                

            });
            recientes.innerHTML= tmpelstr;
            

            return 1;
        

            

        }).catch((error) => {
            console.log(error);
            return 0;
        });


    },




    'producto_particular': (producto=0, fecha="mes")=>{},
    'vista_usuario': (producto=0, fecha="mes")=>{},




}

function getpage (pagename){
    console.log(pagename);
    fetch("./controllers/"+pagename+'.php', {
        method:"GET",
        credentials: 'same-origin', 
        mode: 'same-origin',
        cache: 'no-cache',
    })
    .then((response) => response.text()).then((htmlresponse)=>{
        contentbox.innerHTML=htmlresponse;
        pages[pagename]();
    
    }).catch((error) => {
        console.log(error);
        return 0;
    });
}

function getRandomColor() { //TODO: better colors
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}

async function updatePP(producto, fecha='mes'){
    var dselele= (document.getElementById("date-select"));
    if (dselele){
        fecha=dselele.value;
    }
    console.log(dselele)
    getpage('producto_particular');
    fetch(`./api/producto_particular.php?producto=${producto}&rango=`+fecha, {
        method:"GET",
        credentials: 'same-origin', 
        mode: 'same-origin',
        cache: 'no-cache',
    })
    .then((response) => response.text()).then((htmlresponse)=>{
        apiresponse=JSON.parse(htmlresponse);
        
        //CREAR ROOTS DE REACT SI NO ESTAN CREADAS
        if (!document.querySelector('#graficolinea').firstElementChild ){
            flinea = ReactDOM.createRoot(document.querySelector('#graficolinea'));
            donuts = Array.prototype.map.call(document.querySelectorAll('.donut'), x=>ReactDOM.createRoot(x));
            //donuts = Array.prototype.map.call(document.querySelectorAll('.donut'), x=>gengraph(x));
            //donuts = Array.prototype.map.call(document.querySelectorAll('.donut'), x=>new ApexCharts(x, {chart: {id: `donutChart${x}`}}));
            stonks = document.querySelectorAll('.stockinfo');
            stockgraphs = Array.prototype.map.call(stonks, x=>ReactDOM.createRoot(x.children[0]));
        } 
        
        
        //console.log(donuts);

        //ARMAR GRAFICO DE LINEA PRINCIPAL
        flinea.render(<Linechart value={
            apiresponse[0].map(x=>{
                return {name:x["fecha_grupo"], monto:Number(x["preciofinal"])}
            })
        }/>);

        /*
        //ARMAR GRAFICOS DE STOCK
        for (let x=0;x<stockgraphs.length;x++){
            stockgraphs[x].render(<Stockchart value={
                [{name: 'Page A',uv: 4000,pv: 2400,amt: 2400,},{name: 'Page B',uv: 3000,pv: 1398,amt: 2210,},{name: 'Page C',uv: 2000,pv: 9800,amt: 2290,},{name: 'Page D',uv: 2780,pv: 3908,amt: 2000,},{name: 'Page E',uv: 1890,pv: 4800,amt: 2181,},{name: 'Page F',uv: 2390,pv: 3800,amt: 2500,},{name: 'Page G',uv: 3490,pv: 4300,amt: 2100,},]
            }/>)
        }*/

        //ARMAR DATOS DE COMPTA
        let ventas=document.querySelector("#totalventas");
        let nventas=document.querySelector("#cantventas");
    
    
        ventas.childNodes[0].innerHTML="$"+apiresponse[1]["total"][0];
        ventas.childNodes[1].innerHTML=(apiresponse[1]["total"][1]>0 ? "▲":"▼")+Math.round(apiresponse[1]["total"][1])+"%";
        ventas.style.color=apiresponse[1]["total"][1]>0 ? "green":"red";
    
        nventas.childNodes[0].innerHTML=+apiresponse[1]["cantidad"][0];
        nventas.childNodes[1].innerHTML=(apiresponse[1]["cantidad"][1]>0 ? "▲":"▼")+Math.round(apiresponse[1]["cantidad"][1])+"%";
        nventas.style.color=apiresponse[1]["cantidad"][1]>0 ? "green":"red";

        document.getElementById("date-select").attributes.onchange.nodeValue=`updatePP(${producto})`;
        document.getElementById("date-select").value=fecha;
        

        let recientes = document.querySelector("#compras_recientes_content");
        let tmpelstr="";
        apiresponse[2].forEach(element => {
            tmpelstr+=`
            <tr class="" style="width:100%;">
                <td class="receientescell" style="">
                    <span>${element["name"]}</span>
                   
                </td>

                <td class="receientescell" style="color:green;">
                ${element["amount"]} ${element["unit"]}
                </td>
                
            
            </tr>
            `
            

        });
        recientes.innerHTML= tmpelstr;


        return 1;
    

        

    }).catch((error) => {
        console.log(error);
        return 0;
    });
//}
//

}

function updateVistaGeneral(){
        pages['vista_general'](document.querySelector("#date-select").value);
}

//----------------------------------Main Page stuff------------------------------------




  
class DataPies extends React.PureComponent {
  
    render() {
      return (
        <Recharts.ResponsiveContainer width="100%" height="100%">
          <Recharts.PieChart width={60} height={60}>
            <Recharts.Pie data={this.props.value} dataKey="value" cx="50%" cy="50%" innerRadius={25} outerRadius={45} fill="#82ca9d" > //label
                {this.props.value.map((entry, index) => (
                    <Recharts.Cell key={`cell-${index}`} fill={getRandomColor()} />
                ))}
            </Recharts.Pie>
            <Recharts.Tooltip />
            <Recharts.Legend align="right" verticalAlign="bottom" width="150px" iconSize="8px" />

          </Recharts.PieChart>
        </Recharts.ResponsiveContainer>
      );
    }
}
  





class Linechart extends React.PureComponent {

    render() {
        return (
        <Recharts.ResponsiveContainer width="100%" height="100%">
            <Recharts.LineChart
            width={500}
            height={300}
            data={this.props.value}
            margin={{
            //    top: 5,
                right: 30,
            //    left: 20,
            //    bottom: 5,
            }}
            >
            <Recharts.CartesianGrid strokeDasharray="3 3" />
            <Recharts.XAxis dataKey="name" />
            <Recharts.YAxis />
            <Recharts.Tooltip />
            <Recharts.Legend />
            <Recharts.Line type="monotone" dataKey="monto" stroke="#8884d8" activeDot={{ r: 8 }} />
            </Recharts.LineChart>
        </Recharts.ResponsiveContainer>
        );
    }
}
//<Recharts.Line type="monotone" dataKey="uv" stroke="#82ca9d" />


class Stockchart extends React.PureComponent {

    render() {
        return (
        <Recharts.ResponsiveContainer width="100%" height="100%">
            <Recharts.LineChart
            data={this.props.value}

            >
            <Recharts.CartesianGrid />
            <Recharts.Line type="monotone" dataKey="pv" stroke="#8884d8" dot='' />
            </Recharts.LineChart>
        </Recharts.ResponsiveContainer>
        );
    }
}


/*
function mainpage(){
    var a=getpage('vista_general');
        var flinea = ReactDOM.createRoot(p(document.querySelector('#maingraph')));
        flinea.render(<Linechart></Linechart>);
    
}


mainpage()*/


getpage('vista_general');