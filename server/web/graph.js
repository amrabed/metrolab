var co = {
  x: [1, 2, 3, 4],
  y: [0, 0, 0, 0],
  mode: 'scatter',
  name: 'CO'
};

var temperature = {
  x: [1, 2, 3, 4],
  y: [6, 15, 1, 29],
  mode: 'scatter',
  name: 'Temperature'
};

var pressure = {
  x: [1, 2, 3, 4],
  y: [16, 5, 11, 9],
  mode: 'scatter',
  name: 'Pressure'
};

var humidity = {
  x: [1, 2, 3, 4],
  y: [16, 1, 0, 9],
  mode: 'scatter',
  name: 'Humidity'
};

var layout_co = {
  xaxis: {
    title: 'Timestamp',
    showgrid: false,
    zeroline: false
  },
  yaxis: {
    title: 'PPM',
    showgrid: false,
    zeroline: false
  }};

var layout_temp = {
  xaxis: {
    title: 'Timestamp',
    showgrid: false,
    zeroline: false
  },
  yaxis: {
    title: 'C',
    showgrid: false,
    zeroline: false
  }};
var layout_pres = {
  xaxis: {
    title: 'Timestamp',
    showgrid: false,
    zeroline: false
  },
  yaxis: {
    title: 'hPA',
    showgrid: false,
    zeroline: false
  }};
var layout_humid = {
  xaxis: {
    title: 'Timestamp',
    showgrid: false,
    zeroline: false
  },
  yaxis: {
    title: '%',
    showgrid: false,
    zeroline: false
  }};

var data = [co, temperature, pressure, humidity];

Plotly.newPlot('tester', data, layout_co);
//Plotly.newPlot('temperature', temperature, layout_temp);
//Plotly.newPlot('pressure', pressure, layout_pres);
//Plotly.newPlot('humidity', humidity, layout_humid);


Plotly.d3.json('https://plot.ly/~DanielCarrera/13.json', function(figure){
  var trace = {
    x: figure.data[0].x, y: figure.data[0].y, z: figure.data[0].z,
    type: 'contour', autocolorscale: false,
    colorscale: [[0,"rgb(  0,  0,  0)"],[0.3,"rgb(230,  0,  0)"],[0.6,"rgb(255,210,  0)"],[1,"rgb(255,255,255)"]],
    reversescale: true, zmax: 2.5, zmin: -2.5
  };
  var layout = {
    title: 'turbulence simulation',
    xaxis: {title: 'radial direction', showline: true, mirror: 'allticks', ticks: 'inside'},
    yaxis: {title: 'vertical direction', showline: true, mirror: 'allticks', ticks: 'inside'},
    margin: {l: 40, b: 40, t: 60},
    annotations: [{
      showarrow: false,
      text: 'Credit: Daniel Carrera',
      x: 0, y: 0, xref: 'paper', yref: 'paper'
    }]
  }
  Plotly.newPlot('tester2', [trace], layout, {showLink: false});
});
