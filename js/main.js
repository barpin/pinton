//import React from "react";
//import { PureComponent } from "react";
//import { CartesianGrid, Legend, Line, LineChart, ResponsiveContainer, Tooltip, XAxis, YAxis} from "recharts";
const e = React.createElement;

function p(input) {
  console.log(input);
  return input;
}

var contentbox = document.querySelector('#content');
console.log('working');
const pages = {
  'vista_general': () => {
    let flinea = ReactDOM.createRoot(document.querySelector('#graficolinea'));
    let donuts = Array.prototype.map.call(document.querySelectorAll('.donut'), x => ReactDOM.createRoot(x));
    let stonks = document.querySelectorAll('.stockinfo');
    let stockgraphs = Array.prototype.map.call(stonks, x => ReactDOM.createRoot(x.children[0]));
    console.log(donuts);
    flinea.render( /*#__PURE__*/React.createElement(Linechart, {
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

    for (let x = 0; x < donuts.length; x++) {
      donuts[x].render( /*#__PURE__*/React.createElement(DataPies, {
        value: [{
          name: 'A1',
          value: 100
        }, {
          name: 'A2',
          value: 300
        }, {
          name: 'B1',
          value: 100
        }, {
          name: 'B2',
          value: 80
        }, {
          name: 'B3',
          value: 40
        }, {
          name: 'B4',
          value: 30
        }, {
          name: 'B5',
          value: 50
        }, {
          name: 'C1',
          value: 100
        }, {
          name: 'C2',
          value: 200
        }, {
          name: 'D1',
          value: 150
        }, {
          name: 'D2',
          value: 50
        }]
      }));
    }

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

    return 1;
  }
};

function getpage(pagename) {
  console.log(pagename);
  fetch("/controllers/" + pagename + '.php', {
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
} //----------------------------------Main Page stuff------------------------------------


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
        top: 5,
        right: 30,
        left: 20,
        bottom: 5
      }
    }, /*#__PURE__*/React.createElement(Recharts.CartesianGrid, {
      strokeDasharray: "3 3"
    }), /*#__PURE__*/React.createElement(Recharts.XAxis, {
      dataKey: "name"
    }), /*#__PURE__*/React.createElement(Recharts.YAxis, null), /*#__PURE__*/React.createElement(Recharts.Tooltip, null), /*#__PURE__*/React.createElement(Recharts.Legend, null), /*#__PURE__*/React.createElement(Recharts.Line, {
      type: "monotone",
      dataKey: "pv",
      stroke: "#8884d8",
      activeDot: {
        r: 8
      }
    }), /*#__PURE__*/React.createElement(Recharts.Line, {
      type: "monotone",
      dataKey: "uv",
      stroke: "#82ca9d"
    })));
  }

}

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
