var resources = [];

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

console.log(resources)

const conflicts = [
  { id: 1, name: 'Gulf War', start_date: '1990-08-02', end_date: '1991-02-28' },
  { id: 2, name: 'Ukraine Conflict', start_date: '2022-02-24' }
];

const conflictResourceImpact = [
  { id: 1, conflict_id: 1, resource_id: 1, impact_type: 'Price Spike' },
  { id: 2, conflict_id: 2, resource_id: 1, impact_type: 'Price Increase' },
  { id: 3, conflict_id: 2, resource_id: 2, impact_type: 'Price Spike' }
];

const priceData = {
  1: [
    { date: '1990-01-01', price: 20 },
    { date: '1990-08-01', price: 22 },
    { date: '1990-08-15', price: 35 },
    { date: '1990-09-01', price: 40 },
    { date: '2022-01-01', price: 80 },
    { date: '2022-02-24', price: 95 },
    { date: '2022-03-01', price: 110 }
  ],
  2: [
    { date: '2022-01-01', price: 3.5 },
    { date: '2022-02-24', price: 4.0 },
    { date: '2022-03-01', price: 6.5 },
    { date: '2022-04-01', price: 7.0 }
  ],
  3: [
    { date: '2022-01-01', price: 9000 },
    { date: '2022-02-24', price: 9100 },
    { date: '2022-03-01', price: 9200 }
  ]
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
const timeRangeSelect = document.getElementById('timeRange');
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
  const impacts = conflictResourceImpact.filter(impact => impact.resource_id === parseInt(resourceId));
  const annotations = [];

  impacts.forEach(impact => {
    const conflict = conflicts.find(c => c.id === impact.conflict_id);

    annotations.push({
      type: 'line',
      xMin: conflict.start_date,
      xMax: conflict.start_date,
      borderColor: 'red',
      borderWidth: 2,
      label: {
        content: `${conflict.name} start: ${impact.impact_type}`,
        display: true,
        position: 'start',
        backgroundColor: 'rgba(255, 99, 132, 0.8)',
        color: 'white'
      }
    });

    if (conflict.end_date) {
      annotations.push({
        type: 'line',
        xMin: conflict.end_date,
        xMax: conflict.end_date,
        borderColor: 'green',
        borderWidth: 2,
        label: {
          content: `${conflict.name} end`,
          display: true,
          position: 'start',
          backgroundColor: 'rgba(75, 192, 192, 0.8)',
          color: 'white'
        }
      });
    }
  });

  return annotations;
}

function filterPriceDataByTimeRange(data, range) {
  const [startYear, endYear] = range.split('-').map(Number);
  return data.filter(d => {
    const year = new Date(d.date).getFullYear();
    return year >= startYear && year <= endYear;
  });
}

function renderChart(resourceId) {
  const selectedRange = timeRangeSelect.value;
  const data = priceData[resourceId] || [];
  if (chart) chart.destroy();

  if (!data.length) {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    return;
  }

  const filteredData = filterPriceDataByTimeRange(data, selectedRange);

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
            text: 'Price'
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
    const resourceId = e.target.value;
    const resourceName = resources.find((elem) => {
        elem.id === resourceId
    }).name;

    if (priceData.resourceId === undefined) {
        const units = await fetch(`/commodityUnits/${resourceName}`);

        units.forEach((elem) => {

        });
        await fetch()
    }

    if (resourceId) {
        renderChart(resourceId);
    }
});

timeRangeSelect.addEventListener('change', (e) => {
  const resourceId = resourceSelect.value;
  if (resourceId) {
    renderChart(resourceId);
  }
});

// document.addEventListener('DOMContentLoaded', () => {
//   populateResources();
// });
