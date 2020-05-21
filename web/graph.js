Plotly.d3.csv('data.csv', function(rows){
columns = ['CO level', 'Ozone level', 'Temperature', 'Pressure', 'Humidity'];
function unpack(rows, key) {
  return rows.map(function(row) { return row[key]; });
}

function getData(column, name, yaxis) {
    return {
      mode: 'lines',
      x: unpack(rows, 'timestamp'),
      y: unpack(rows, column),
      name: name,
      yaxis: yaxis
    };
}

var layout = {
  xaxis: {
    title: 'Timestamp',
    showgrid: false,
    zeroline: false
  },
  yaxis: {
    title: 'PPM',
    range: [0,1],
    domain: [0, 0.15]
  },
  yaxis2: {
    title: 'PPM',
    zeroline: false,
    domain: [0.2, 0.35]
  },
  yaxis3: {
    title: 'C',
    zeroline: false,
    domain: [0.4, 0.55]
  },
  yaxis4: {
    title: 'Pa',
    zeroline: false,
    domain: [0.6, 0.75]
  },
  yaxis5: {
    title: '%',
    zeroline: false,
    domain: [0.8, 1]
  },
  legend: {
    traceorder: "reversed"
  }
};


var data = [getData('co', 'CO level', 'y'),
  getData('ozone', 'Ozone level', 'y2'),
  getData('temperature', 'Temperature', 'y3'),
  getData('pressure', 'Pressure', 'y4'),
  getData('humidity', 'Humidity', 'y5')
];

Plotly.newPlot('graph', data, layout);
});
