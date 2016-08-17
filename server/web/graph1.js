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
  Plotly.plot('tester2', [trace], layout, {showLink: false});
});
