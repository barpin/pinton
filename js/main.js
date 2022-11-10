//import React from "react";
//import { PureComponent } from "react";
//import { CartesianGrid, Legend, Line, LineChart, ResponsiveContainer, Tooltip, XAxis, YAxis} from "recharts";
const e = React.createElement;
//var ptrigcount=0;
function p(input) {
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
  'vista_general': (fecha = "hoy") => {
    fetch("./api/vista_general.php?rango=" + fecha, {
      method: "GET",
      credentials: 'same-origin',
      mode: 'same-origin',
      cache: 'no-cache'
    }).then(response => response.text()).then(htmlresponse => {
      apiresponse = JSON.parse(htmlresponse);

      //CREAR ROOTS DE REACT SI NO ESTAN CREADAS
      if (!document.querySelector('#graficolinea').firstElementChild) {
        flinea = ReactDOM.createRoot(document.querySelector('#graficolinea'));
        donuts = Array.prototype.map.call(document.querySelectorAll('.donut'), x => ReactDOM.createRoot(x));
        stonks = document.querySelectorAll('.stockinfo');
        stockgraphs = Array.prototype.map.call(stonks, x => ReactDOM.createRoot(x.children[0]));
      }

      //console.log(donuts);

      //ARMAR GRAFICO DE LINEA PRINCIPAL
      flinea.render( /*#__PURE__*/React.createElement(Linechart, {
        value: apiresponse[0].map(x => {
          return {
            name: x["fecha_grupo"],
            monto: Number(x["preciofinal"])
          };
        })
      }));
      donutdata = apiresponse[1];
      //ARMAR GRAFICOS DE DONAS

      for (let x = 0; x < donuts.length; x++) {
        donuts[x].render( /*#__PURE__*/React.createElement(DataPies, {
          value: apiresponse[1][x].map(x => {
            return {
              name: x["name"],
              value: Number(x["count"])
            };
          })
        }));
      }

      //ARMAR GRAFICOS DE STOCK
      for (let x = 0; x < stockgraphs.length; x++) {
        stockgraphs[x].render( /*#__PURE__*/React.createElement(Stockchart, {
          value: [{
            name: 'Page A',
            uv: 4000,
            pv: 2400,
            amt: 2400
          }, {
            name: 'Page B',
            uv: 3000,
            pv: 1398,
            amt: 2210
          }, {
            name: 'Page C',
            uv: 2000,
            pv: 9800,
            amt: 2290
          }, {
            name: 'Page D',
            uv: 2780,
            pv: 3908,
            amt: 2000
          }, {
            name: 'Page E',
            uv: 1890,
            pv: 4800,
            amt: 2181
          }, {
            name: 'Page F',
            uv: 2390,
            pv: 3800,
            amt: 2500
          }, {
            name: 'Page G',
            uv: 3490,
            pv: 4300,
            amt: 2100
          }]
        }));
      }

      //document.querySelector("#date-select").addEventListener('change', updateVistaGeneral(), false);

      //ARMAR DATOS DE COMPTA
      let ventas = document.querySelector("#totalventas");
      let nventas = document.querySelector("#cantventas");
      ventas.childNodes[0].innerHTML = "$" + apiresponse[2]["total"][0];
      ventas.childNodes[1].innerHTML = (apiresponse[2]["total"][1] > 0 ? "▲" : "▼") + Math.round(apiresponse[2]["total"][1]) + "%";
      ventas.style.color = apiresponse[2]["total"][1] > 0 ? "green" : "red";
      nventas.childNodes[0].innerHTML = +apiresponse[2]["cantidad"][0];
      nventas.childNodes[1].innerHTML = (apiresponse[2]["cantidad"][1] > 0 ? "▲" : "▼") + Math.round(apiresponse[2]["cantidad"][1]) + "%";
      nventas.style.color = apiresponse[2]["cantidad"][1] > 0 ? "green" : "red";

      //ARMAR COMPRAS RECIENTES
      let recientes = document.querySelector("#compras_recientes_content");
      let tmpelstr = "";
      apiresponse[4].forEach(element => {
        tmpelstr += `
                <tr class="" style="width:100%;">
                    <td class="receientescell" style="width:25%">
                        <span>${element["fecha_y_hora"].substr(0, 10)}</span><br>
                        <span style="font-size:0.9rem;color:gray;">${element["fecha_y_hora"].substr(10, 10)}</span>
                    </td>
                    <td  class="receientescell" style="width:50%">
                        ${element["name"]} ${element["cantidad"] > 1 ? `<span>×${element["cantidad"]}</span>` : ""}
                    </td>
                    <td class="receientescell" style="color:green;width:25%">
                        $ ${element["precio"]}
                    </td>
                
                </tr>
                `;

        /*
        childnode = document.createElement("div");
        childnode.classList.add("colcont");
          recientes?.appendChild(
            childnode
        );
        console.log(element);*/
      });

      recientes.innerHTML = tmpelstr;
      return 1;
    }).catch(error => {
      console.log(error);
      return 0;
    });
  }
};
function getpage(pagename) {
  console.log(pagename);
  fetch("./controllers/" + pagename + '.php', {
    method: "GET",
    credentials: 'same-origin',
    mode: 'same-origin',
    cache: 'no-cache'
  }).then(response => response.text()).then(htmlresponse => {
    contentbox.innerHTML = htmlresponse;
    pages[pagename]();
  }).catch(error => {
    console.log(error);
    return 0;
  });
}
function getRandomColor() {
  //TODO: better colors
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}
function updateVistaGeneral() {
  //if (ptrigcount==0){
  //    ptrigcount++
  //} else {
  pages['vista_general'](document.querySelector("#date-select").value);
  //}
  //
}

//----------------------------------Main Page stuff------------------------------------

class DataPies extends React.PureComponent {
  render() {
    return /*#__PURE__*/React.createElement(Recharts.ResponsiveContainer, {
      width: "100%",
      height: "100%"
    }, /*#__PURE__*/React.createElement(Recharts.PieChart, {
      width: 60,
      height: 60
    }, /*#__PURE__*/React.createElement(Recharts.Pie, {
      data: this.props.value,
      dataKey: "value",
      cx: "50%",
      cy: "50%",
      innerRadius: 25,
      outerRadius: 45,
      fill: "#82ca9d"
    }, " //label", this.props.value.map((entry, index) => /*#__PURE__*/React.createElement(Recharts.Cell, {
      key: `cell-${index}`,
      fill: getRandomColor()
    }))), /*#__PURE__*/React.createElement(Recharts.Tooltip, null), /*#__PURE__*/React.createElement(Recharts.Legend, {
      align: "right",
      verticalAlign: "bottom",
      width: "150px",
      iconSize: "8px"
    })));
  }
}
class Linechart extends React.PureComponent {
  render() {
    return /*#__PURE__*/React.createElement(Recharts.ResponsiveContainer, {
      width: "100%",
      height: "100%"
    }, /*#__PURE__*/React.createElement(Recharts.LineChart, {
      width: 500,
      height: 300,
      data: this.props.value,
      margin: {
        //    top: 5,
        right: 30
        //    left: 20,
        //    bottom: 5,
      }
    }, /*#__PURE__*/React.createElement(Recharts.CartesianGrid, {
      strokeDasharray: "3 3"
    }), /*#__PURE__*/React.createElement(Recharts.XAxis, {
      dataKey: "name"
    }), /*#__PURE__*/React.createElement(Recharts.YAxis, null), /*#__PURE__*/React.createElement(Recharts.Tooltip, null), /*#__PURE__*/React.createElement(Recharts.Legend, null), /*#__PURE__*/React.createElement(Recharts.Line, {
      type: "monotone",
      dataKey: "monto",
      stroke: "#8884d8",
      activeDot: {
        r: 8
      }
    })));
  }
}
//<Recharts.Line type="monotone" dataKey="uv" stroke="#82ca9d" />

class Stockchart extends React.PureComponent {
  render() {
    return /*#__PURE__*/React.createElement(Recharts.ResponsiveContainer, {
      width: "100%",
      height: "100%"
    }, /*#__PURE__*/React.createElement(Recharts.LineChart, {
      data: this.props.value
    }, /*#__PURE__*/React.createElement(Recharts.CartesianGrid, null), /*#__PURE__*/React.createElement(Recharts.Line, {
      type: "monotone",
      dataKey: "pv",
      stroke: "#8884d8",
      dot: ""
    })));
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
