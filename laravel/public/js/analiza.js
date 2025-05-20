var resources = [];

let startDateFilter = document.getElementById('startDateFilter');
let endDateFilter = document.getElementById('endDateFilter');

let startDate;
let endDate;

window.addEventListener('DOMContentLoaded', () => {
    startDateFilter = document.getElementById('startDateFilter');
    endDateFilter = document.getElementById('endDateFilter');

    startDateFilter.addEventListener('change', (e) => {
        startDate = e.target.value;
        if(startDate && endDate && startDate < endDate && resourceSelect.value){
            renderChart(resourceSelect.value);
        }
    });

    endDateFilter.addEventListener('change', (e) => {
        endDate = e.target.value;
        if(startDate && endDate && startDate < endDate && resourceSelect.value){
            renderChart(resourceSelect.value);
        }
    });
});

async function getCommodities(){
    await fetch('/api/commoditiesTypes')
        .then(response => response.json())
        .then(data => {
            data.forEach((elem, index) => {
                resources.push({
                    id: index,
                    name: elem.name
                })
            });
            populateResources();
        }).catch(e => {
            console.log(e)
        });
}

getCommodities();


const conflicts = [
  // { id: 1, name: 'Gulf War', start_date: '1990-08-02', end_date: '1991-02-28' },
  // { id: 2, name: 'Ukraine Conflict', start_date: '2022-02-24' }
];

window.conflicts.forEach((e) => {
    conflicts.push({
        id: e.id,
        name: e.name,
        start_date: e.start_date,
        end_date: e.end_date
    })
})

const conflictResourceImpact = [
  // { id: 1, conflict_id: 1, resource_id: 1, impact_type: 'Price Spike' },
  // { id: 2, conflict_id: 2, resource_id: 1, impact_type: 'Price Increase' },
  // { id: 3, conflict_id: 2, resource_id: 2, impact_type: 'Price Spike' }
];

const priceData = {
  // 1: [
  //   { date: '1990-01-01', price: 20 },
  //   { date: '1990-08-01', price: 22 },
  //   { date: '1990-08-15', price: 35 },
  //   { date: '1990-09-01', price: 40 },
  //   { date: '2022-01-01', price: 80 },
  //   { date: '2022-02-24', price: 95 },
  //   { date: '2022-03-01', price: 110 }
  // ],
  // 2: [
  //   { date: '2022-01-01', price: 3.5 },
  //   { date: '2022-02-24', price: 4.0 },
  //   { date: '2022-03-01', price: 6.5 },
  //   { date: '2022-04-01', price: 7.0 }
  // ],
  // 3: [
  //   { date: '2022-01-01', price: 9000 },
  //   { date: '2022-02-24', price: 9100 },
  //   { date: '2022-03-01', price: 9200 }
  // ]
};

Chart.register(
  Chart.LineController,
  Chart.LineElement,
  Chart.PointElement,
  Chart.LinearScale,
  Chart.TimeScale,
  Chart.CategoryScale,
  Chart.Title,
  Chart.Tooltip,
  Chart.Legend,
  window['chartjs-plugin-annotation']
);

const resourceSelect = document.getElementById('resource');
const canvas = document.getElementById('priceChart');
const ctx = canvas.getContext('2d');
let chart;

function populateResources() {
  resources.forEach(resource => {
    const option = document.createElement('option');
    option.value = resource.id;
    option.textContent = resource.name;
    resourceSelect.appendChild(option);
  });
}

function getConflictAnnotations(resourceId) {
  // const impacts = conflictResourceImpact.filter(impact => impact.resource_id === parseInt(resourceId));
  const impacts = conflicts;
  const annotations = [];

  // impacts.forEach(impact => {
  //   // const conflict = conflicts.find(c => c.id === impact.conflict_id);
  //   const conflict = conflicts;
  //
  //   annotations.push({
  //     type: 'line',
  //     xMin: conflict.end_date,
  //     xMax: conflict.start_date,
  //     borderColor: 'blue',
  //     borderWidth: 2,
  //     label: {
  //       content: `${conflict.name} start: ${impact.impact_type}`,
  //       display: true,
  //       position: 'start',
  //       backgroundColor: 'rgba(255, 99, 132, 0.8)',
  //       color: 'white'
  //     }
  //   });
  //
  //   if (conflict.end_date) {
  //     annotations.push({
  //       type: 'line',
  //       xMin: conflict.end_date,
  //       xMax: conflict.end_date,
  //       borderColor: 'green',
  //       borderWidth: 2,
  //       label: {
  //         content: `${conflict.name} end`,
  //         display: true,
  //         position: 'start',
  //         backgroundColor: 'rgba(75, 192, 192, 0.8)',
  //         color: 'white'
  //       }
  //     });
  //   }
  // });

  conflicts.forEach((e) => {
      if(e.start_date > startDate && e.end_date < endDate){
          // var tmp = {};
          // tmp.push({
          //     type: 'line',
          //     xMin: e.start_date, // indeks na osi X lub wartość
          //     xMax: e.start_date,
          //     borderColor: 'red',
          //     borderWidth: 2,
          //     label: {
          //         enabled: true,
          //         content: 'Start',
          //         position: 'start'
          //     }
          // });
          // tmp.push(
          //     {
          //         type: 'line',
          //         xMin: e.end_date,
          //         xMax: e.end_date,
          //         borderColor: 'red',
          //         borderWidth: 2,
          //         label: {
          //             enabled: true,
          //             content: 'End',
          //             position: 'end'
          //         }
          //     }
          // );
          // tmp.push(
          //     {
          //         type: 'box',
          //         xMin: e.start_date,
          //         xMax: e.end_date,
          //         backgroundColor: 'rgb(255,99,132)', // Jasny różowy
          //         borderWidth: 0
          //     }
          // );
          // annotations.push(tmp);
          // annotations.push(
          //     // {
          //     // type: 'line',
          //     // xMin: e.start_date,
          //     // xMax: e.end_date,
          //     // borderColor: 'green',
          //     // borderWidth: 2,
          //     // label: {
          //     //     content: `${e.name}`,
          //     //     display: true,
          //     //     position: 'start',
          //     //     backgroundColor: 'rgba(112,7,131,0.77)',
          //     //     color: 'white'
          //     // }
          //     // {
          //     //     {
          //     //         type: 'line',
          //     //         xMin: e.start_date, // indeks na osi X lub wartość
          //     //         xMax: e.start_date,
          //     //         borderColor: 'red',
          //     //         borderWidth: 2,
          //     //         label: {
          //     //             enabled: true,
          //     //             content: 'Start',
          //     //             position: 'start'
          //     //         }
          //     //     },
          //     //     {
          //     //         type: 'line',
          //     //         xMin: e.end_date,
          //     //         xMax: e.end_date,
          //     //         borderColor: 'red',
          //     //         borderWidth: 2,
          //     //         label: {
          //     //             enabled: true,
          //     //             content: 'End',
          //     //             position: 'end'
          //     //         }
          //     //     },
          //     //     {
          //     //         type: 'box',
          //     //         xMin: e.start_date,
          //     //         xMax: e.end_date,
          //     //         backgroundColor: 'rgb(255,99,132)', // Jasny różowy
          //     //         borderWidth: 0
          //     //     }
          //     // }
          // );
          annotations.push(
              {
                  type: 'line',
                  xMin: e.start_date, // indeks na osi X lub wartość
                  xMax: e.start_date,
                  borderColor: 'red',
                  borderWidth: 2,
                  label: {
                      content: `${e.name}`,
                      display: true,
                      position: 'start',
                      backgroundColor: 'rgba(112,7,131,0.77)',
                      color: 'white'
                  }
              }
          )
          annotations.push(
              {
                  type: 'line',
                  xMin: e.end_date,
                  xMax: e.end_date,
                  borderColor: 'red',
                  borderWidth: 2,
                  label: {
                      enabled: true,
                      content: 'End',
                      position: 'end'
                  }
              }
          )
          annotations.push(
              {
                  type: 'box',
                  xMin: e.start_date,
                  xMax: e.end_date,
                  backgroundColor: 'rgba(255,99,132,0.10)', // Jasny różowy
                  borderWidth: 0
              }
          )
      }
  });

  return annotations;
}

function filterPriceDataByTimeRange(data) {
  return data.filter(d => {
    const date = d.date;
    return date >= startDate && date <= endDate;
  });
}

function renderChart(resourceId) {
  const data = priceData[resourceId] || [];
  if (chart) chart.destroy();

  if (!data.length) {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    return;
  }

  const filteredData = filterPriceDataByTimeRange(data);

  if (filteredData.length === 0) {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    return;
  }

  chart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: filteredData.map(d => d.date),
      datasets: [{
        label: `${resources.find(r => r.id === parseInt(resourceId)).name} Price`,
        data: filteredData.map(d => ({ x: d.date, y: d.price })),
        borderColor: 'blue',
        fill: false
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false, // kluczowe dla responsywności!
      scales: {
        x: {
          type: 'time',
          time: {
            unit: 'year'
          },
          title: {
            display: true,
            text: 'Year'
          }
        },
        y: {
          title: {
            display: true,
            text: 'Price [Index]'
          }
        }
      },
      plugins: {
        annotation: {
          annotations: getConflictAnnotations(resourceId)
        }
      }
    }
  });
}

resourceSelect.addEventListener('change', async (e) => {
    const resourceId = parseInt(e.target.value);
    const resourceName = resources.find((elem) => elem.id === resourceId).name;

    if (priceData[resourceId] === undefined) {
        await fetch(`/api/commodityPrices/IX/${resourceName}`)
            .then(response => response.json())
            .then(data => {
                var tmpArr = [];
                data.forEach((elem) => {
                    tmpArr.push({
                        date: elem.date,
                        price: elem.value
                    })
                })
                priceData[resourceId] = tmpArr;
            })
            .catch((e) => {
                console.log(e);
            });
    }

    if (resourceId) {
        renderChart(resourceId);
    }
});

// timeRangeSelect.addEventListener('change', (e) => {
//   const resourceId = resourceSelect.value;
//   if (resourceId) {
//     renderChart(resourceId);
//   }
// });

// document.addEventListener('DOMContentLoaded', () => {
//   populateResources();
// });
