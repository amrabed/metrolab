Plotly.d3.csv('data.csv', function(rows){
columns = ['CO Level', 'Temperature', 'Pressure', 'Humidity'];
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
    domain: [0.05, 0.25]
  },
  yaxis2: {
    title: 'C',
    zeroline: false,
    domain: [0.3, 0.5]
  },
  yaxis3: {
    title: 'Pa',
    zeroline: false,
    domain: [0.55, 0.75]
  },
  yaxis4: {
    title: '%',
    zeroline: false,
    domain: [0.8, 1]
  },
  legend: {
    traceorder: "reversed"
  }
};


var data = [getData('co', 'CO Level', 'y'),
  getData('temperature', 'Temperature', 'y2'),
  getData('pressure', 'Pressure', 'y3'),
  getData('humidity', 'Humidity', 'y4')
];

Plotly.newPlot('graph', data, layout);
});
