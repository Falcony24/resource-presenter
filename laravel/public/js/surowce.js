console.log(window.commodities);

var resources = [];

window.commodities.forEach((elem, index) => {
    resources.push({
        id: index,
        name: elem.name,
        description: elem.description
    })
});

const resourcesPerPage = 30;
let currentPage = 1;
let filteredResources = resources;

function renderResourcesPage(page) {
  const tableBody = document.getElementById('resourcesTableBody');
  tableBody.innerHTML = '';

  const start = (page - 1) * resourcesPerPage;
  const end = start + resourcesPerPage;
  const pageResources = filteredResources.slice(start, end);

  pageResources.forEach(resource => {
    const row = `
        <tr>
          <td>${resource.name}</td>
          <td>${resource.description}</td>
        </tr>
      `;
    tableBody.innerHTML += row;
  });

  renderPagination();
}

function renderPagination() {
  const paginationDiv = document.getElementById('pagination');
  paginationDiv.innerHTML = '';

  const totalPages = Math.ceil(filteredResources.length / resourcesPerPage);

  if (totalPages <= 1) return;

  for (let i = 1; i <= totalPages; i++) {
    const btn = document.createElement('button');
    btn.textContent = i;
    if (i === currentPage) btn.classList.add('active');
    btn.onclick = () => {
      currentPage = i;
      renderResourcesPage(currentPage);
      window.scrollTo(0,0);
    };
    paginationDiv.appendChild(btn);
  }
}

function filterResources() {
  const searchInput = document.getElementById('searchInput').value.toLowerCase();

  filteredResources = resources.filter(resource => {
    if (!resource.name.toLowerCase().includes(searchInput)) return false;
    return true;
  });

  currentPage = 1;
  renderResourcesPage(currentPage);
}

// Inicjalizacja strony
filterResources();
const tbody = document.querySelector('table tbody');
const table = document.querySelector('table');
if (tbody.children.length === 0) {
    table.classList.add('empty');
} else {
    table.classList.remove('empty');
}