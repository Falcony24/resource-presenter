const resources = [
  { id: 1, name: 'Oil' },
  { id: 2, name: 'Natural Gas' },
  { id: 3, name: 'Copper' },
  { id: 4, name: 'Gold' },
  { id: 5, name: 'Wheat' }
];

const conflicts = [
  { id: 1, name: 'Gulf War', region: 'Bliski Wschód', start_date: '1990-08-02', end_date: '1991-02-28' },
  { id: 2, name: 'Ukraine Conflict', region: 'Europa Wschodnia', start_date: '2022-02-24' },
  { id: 3, name: 'Darfur Conflict', region: 'Afryka', start_date: '2003-02-26', end_date: '2009-07-14' },
  { id: 4, name: 'South China Sea Dispute', region: 'Azja', start_date: '2010-01-01' },
  { id: 5, name: 'Water Conflict in Middle East', region: 'Bliski Wschód', start_date: '2014-06-01', end_date: '2015-12-01' }
];

const conflictResourceImpact = [
  { id: 1, conflict_id: 1, resource_id: 1, impact_type: 'Price Spike' },
  { id: 2, conflict_id: 2, resource_id: 1, impact_type: 'Price Increase' },
  { id: 3, conflict_id: 2, resource_id: 2, impact_type: 'Price Spike' },
  { id: 4, conflict_id: 2, resource_id: 5, impact_type: 'Price Spike' },
  { id: 5, conflict_id: 3, resource_id: 4, impact_type: 'Price Increase' },
  { id: 6, conflict_id: 4, resource_id: 3, impact_type: 'Price Spike' },
  { id: 7, conflict_id: 5, resource_id: 2, impact_type: 'Price Increase' }
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
    { date: '2022-04-01', price: 7.0 },

    { date: '2015-01-01', price: 2.7 },
    { date: '2015-12-01', price: 3.0 },
    { date: '2014-06-01', price: 2.5 }
  ],
  3: [
    { date: '2010-01-01', price: 7000 },
    { date: '2010-06-01', price: 7100 },
    { date: '2011-01-01', price: 7200 },
    { date: '2022-01-01', price: 9000 },
    { date: '2022-02-24', price: 9100 },
    { date: '2022-03-01', price: 9200 }
  ],
  4: [
    { date: '2003-01-01', price: 350 },
    { date: '2003-02-26', price: 360 },
    { date: '2004-01-01', price: 400 },
    { date: '2009-07-14', price: 480 }
  ],
  5: [
    { date: '2022-01-01', price: 200 },
    { date: '2022-02-24', price: 350 },
    { date: '2022-03-01', price: 400 },
    { date: '2022-04-01', price: 420 }
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

const conflictRegionSelect = document.getElementById('conflictRegion');
const resourceSelect = document.getElementById('resource');
const startDateInput = document.getElementById('startDate');
const endDateInput = document.getElementById('endDate');
const canvas = document.getElementById('priceChart');
const ctx = canvas.getContext('2d');
let chart;

document.addEventListener('DOMContentLoaded', () => {
  populateConflictRegions();
  populateResources();
});

function populateConflictRegions() {
  const regions = [...new Set(conflicts.map(c => c.region))];
  regions.forEach(region => {
    const option = document.createElement('option');
    option.value = region;
    option.textContent = region;
    conflictRegionSelect.appendChild(option);
  });
}

function populateResources() {
  const selectedRegion = conflictRegionSelect.value;
  resourceSelect.innerHTML = '<option value="">Wybierz surowiec</option>';
  if (!selectedRegion) return;
  const filteredConflicts = conflicts.filter(c => c.region === selectedRegion);
  const conflictIds = filteredConflicts.map(c => c.id);
  const relatedResourceIds = conflictResourceImpact
    .filter(impact => conflictIds.includes(impact.conflict_id))
    .map(impact => impact.resource_id);
  const uniqueResourceIds = [...new Set(relatedResourceIds)];
  resources.forEach(resource => {
    if (uniqueResourceIds.includes(resource.id)) {
      const option = document.createElement('option');
      option.value = resource.id;
      option.textContent = resource.name;
      resourceSelect.appendChild(option);
    }
  });
}

function getConflictAnnotations(resourceId) {
  const selectedRegion = conflictRegionSelect.value;
  if (!selectedRegion) return [];
  const filteredConflicts = conflicts.filter(c => c.region === selectedRegion);
  const conflictIds = filteredConflicts.map(c => c.id);
  const impacts = conflictResourceImpact.filter(impact =>
    impact.resource_id === parseInt(resourceId) &&
    conflictIds.includes(impact.conflict_id)
  );
  const annotations = [];
  impacts.forEach(impact => {
    const conflict = conflicts.find(c => c.id === impact.conflict_id);
    annotations.push({
      type: 'line',
      xMin: new Date(conflict.start_date),
      xMax: new Date(conflict.start_date),
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
        xMin: new Date(conflict.end_date),
        xMax: new Date(conflict.end_date),
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

function renderChart(resourceId) {
  let data = priceData[resourceId] || [];

  data = data.slice().sort((a, b) => new Date(a.date) - new Date(b.date));

  const startDate = startDateInput.value ? new Date(startDateInput.value) : null;
  const endDate = endDateInput.value ? new Date(endDateInput.value) : null;
  const filteredData = data.filter(d => {
    const dataDate = new Date(d.date);
    if (startDate && dataDate < startDate) return false;
    if (endDate && dataDate > endDate) return false;
    return true;
  }).map(d => ({
    x: new Date(d.date),
    y: d.price
  }));

  if (!filteredData.length) {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    return;
  }

  if (chart) {
    chart.destroy();
  }

  chart = new Chart(ctx, {
    type: 'line',
    data: {
      datasets: [{
        label: `${resources.find(r => r.id === parseInt(resourceId)).name} Price`,
        data: filteredData,
        borderColor: 'blue',
        fill: false
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        x: {
          type: 'time',
          time: {
            unit: 'month',
            tooltipFormat: 'yyyy-MM-dd',
          },
          title: {
            display: true,
            text: 'Data'
          }
        },
        y: {
          title: {
            display: true,
            text: 'Cena'
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

conflictRegionSelect.addEventListener('change', () => {
  populateResources();
  resourceSelect.value = '';
  if (chart) chart.destroy();
});

resourceSelect.addEventListener('change', (e) => {
  const resourceId = e.target.value;
  if (resourceId) {
    renderChart(resourceId);
  } else if (chart) {
    chart.destroy();
  }
});

startDateInput.addEventListener('change', () => {
  const resourceId = resourceSelect.value;
  if (resourceId) {
    renderChart(resourceId);
  }
});

endDateInput.addEventListener('change', () => {
  const resourceId = resourceSelect.value;
  if (resourceId) {
    renderChart(resourceId);
  }
});
