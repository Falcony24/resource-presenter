// Przykładowe dane
const resources = [
  {
    id: 1,
    name: "Ropa naftowa",
    description: "Główny surowiec energetyczny"
  },
  {
    id: 2,
    name: "Złoto",
    description: "Surowiec inwestycyjny"
  },
  {
    id: 3,
    name: "Gaz ziemny",
    description: "Surowiec energetyczny"
  },
  {
    id: 4,
    name: "Miedź",
    description: "Surowiec przemysłowy"
  }
];

// Dodaj więcej danych testowych
for(let i=5; i<=50; i++) {
  resources.push({
    id: i,
    name: `Surowiec #${i}`,
    description: `Opis surowca testowego #${i}`
  });
}

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
