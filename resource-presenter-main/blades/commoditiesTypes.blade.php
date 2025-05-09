<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <title>Surowce</title>
</head>
<body>

<nav>
  <a href="{{ url('/') }}">Główna</a> |
  <a href="{{ url('api/conflicts') }}">Zobacz konflikty</a> |
  <a href="{{ url('api/commoditiesTypes') }}">Zobacz dane surowców</a> |
  <a href="{{ url('/analizy') }}">Analizy</a>
</nav>

<h1>Lista surowców</h1>

<div class="filters">
  <input type="text" id="searchInput" placeholder="Szukaj surowca..." onkeyup="filterResources()">
</div>


<table>
  <thead>
    <tr>
      <th>Nazwa</th>
      <th>Opis</th>
    </tr>
  </thead>
  <tbody id="resourcesTableBody">
    <!-- Dynamicznie wstawiane wiersze będą tutaj -->
  </tbody>
</table>

<div class="pagination" id="pagination"></div>

<script>
  // Dane surowców przekazane przez kontroler
  const resources = @json($commodityTypes); // Laravel generuje JSON dla $commodityTypes

  let currentPage = 1;
  const resourcesPerPage = 30;

// Funkcja renderująca stronę surowców
function renderResourcesPage(page, filteredResources) {
  const tableBody = document.getElementById('resourcesTableBody');
  tableBody.innerHTML = ''; // Resetowanie tabeli

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

  renderPagination(filteredResources);
}

// Funkcja renderująca paginację
function renderPagination(filteredResources) {
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
      renderResourcesPage(currentPage, filteredResources);
      window.scrollTo(0, 0); // Przewiń do góry po zmianie strony
    };
    paginationDiv.appendChild(btn);
  }
}

// Funkcja filtrująca zasoby
function filterResources() {
  const searchInput = document.getElementById('searchInput').value.toLowerCase();

  const filteredResources = resources.filter(resource => {
    return resource.name.toLowerCase().includes(searchInput);
  });

  currentPage = 1; // Resetowanie do pierwszej strony po filtracji
  renderResourcesPage(currentPage, filteredResources);
}

// Inicjalizacja początkowego renderowania
renderResourcesPage(currentPage, resources);

</script>
<style>
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

:root {
  --main-bg: #efe7d8;
  --accent: #80734e;
  --accent-dark: #5e5437;
  --text: #80734e;
  --white: #fff;
}

body {
  font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
  background: var(--main-bg);
  min-height: 100vh;
  color: var(--text);
  padding: 32px 0;
}

nav {
  list-style: none;
  padding: 0;
  margin: 0;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 50px;
  background: #928c61;
  display: flex;
  justify-content: flex-end;
  gap: 16px;
  z-index: 1000;
  box-shadow: 0 2px 12px rgba(128, 115, 78, 0.10);
}

body {
  padding-top: 66px;
}

nav a {
  line-height: 50px;
  height: 100%;
  font-size: 16px;
  display: inline-flex;
  text-decoration: none;
  text-transform: uppercase;
  text-align: center;
  color: #efe7d8;
  cursor: pointer;
  padding: 0 20px;
  transition: background-color 0.3s ease;
}

nav a:hover {
  background-color: #3D3D3B;
}
h1 {
  text-align: center;
  font-size: 2.3em;
  margin-bottom: 28px;
  letter-spacing: 1px;
  color: var(--accent-dark);
}

input[type="text"], input[type="date"], select {
  padding: 12px 16px;
  margin: 0 8px 24px 0;
  border: 1px solid var(--accent);
  border-radius: 6px;
  background: var(--white);
  font-size: 1em;
  color: var(--text);
  transition: border-color 0.2s, box-shadow 0.2s;
  outline: none;
  box-shadow: 0 1px 3px rgba(128, 115, 78, 0.06);
}

input[type="text"]:focus, input[type="date"]:focus, select:focus {
  border-color: var(--accent-dark);
  box-shadow: 0 2px 8px rgba(128, 115, 78, 0.13);
}

table {
  width: 96%;
  margin: 0 auto;
  border-collapse: separate;
  border-spacing: 0;
  background: var(--white);
  border-radius: 14px;
  box-shadow: 0 4px 32px rgba(128, 115, 78, 0.08);
  overflow: hidden;
}

th, td {
  padding: 18px 14px;
  text-align: left;
  font-size: 1.06em;
}

th {
  background: var(--accent);
  color: var(--white);
  font-weight: 600;
  letter-spacing: 0.5px;
  border-bottom: 3px solid var(--main-bg);
}

tr {
  border-bottom: 1px solid var(--main-bg);
  transition: background 0.18s;
}

tr:hover {
  background: #f5f0e6;
}

tbody tr:last-child {
  border-bottom: none;
}

@media (max-width: 900px) {
  table, thead, tbody, th, td, tr {
    display: block;
  }
  thead tr {
    display: none;
  }
  tr {
    margin-bottom: 18px;
    box-shadow: 0 2px 8px rgba(128, 115, 78, 0.07);
    border-radius: 8px;
    background: var(--white);
  }
  td {
    padding: 14px 18px;
    position: relative;
    text-align: right;
  }
  td:before {
    content: attr(data-label);
    position: absolute;
    left: 18px;
    top: 14px;
    font-weight: bold;
    color: var(--accent);
    text-align: left;
  }
}

input, select {
  transition: box-shadow 0.2s, border-color 0.2s;
}
.filters {
  width: 96%;
  margin: 0 auto 24px auto;
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  justify-content: flex-start;
  align-items: flex-end;
}

.filter-date {
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.filter-date label {
  font-size: 0.95em;
  color: #80734e;
  margin-bottom: 2px;
  font-weight: 500;
}

@media (max-width: 600px) {
  .filters, table {
    width: 100%;
    font-size: 1em;
  }
}


@media (min-width: 601px) and (max-width: 900px) {
  .filters, table {
    width: 98%;
    font-size: 1.07em;
  }
}


@media (min-width: 901px) {
  .filters, table {
    width: 96%;
    font-size: 1.1em;
  }
}
.pagination {
  margin: 32px 0 16px 0;
  display: flex;
  justify-content: center;
  gap: 10px;
  align-items: center;
}

.pagination button {
  min-width: 44px;
  height: 44px;
  padding: 0 18px;
  border: 2px solid #80734e;
  border-radius: 10px;
  background: #efe7d8;
  color: #80734e;
  font-size: 1.08rem;
  font-weight: 500;
  cursor: pointer;
  transition:
    background 0.2s,
    color 0.2s,
    border-color 0.2s,
    box-shadow 0.2s;
  box-shadow: 0 2px 6px rgba(128, 115, 78, 0.08);
  outline: none;
  position: relative;
  letter-spacing: 0.04em;
}

.pagination button:hover:not(.active) {
  background: #928c61;
  color: #efe7d8;
  border-color: #928c61;
  box-shadow: 0 4px 14px rgba(128, 115, 78, 0.15);
}

.pagination button.active {
  background: linear-gradient(90deg, #80734e 0%, #928c61 100%);
  color: #efe7d8;
  font-weight: 700;
  border-color: #80734e;
  box-shadow: 0 2px 12px #80734e44;
  z-index: 1;
}

.pagination button:disabled {
  opacity: 0.5;
  cursor: not-allowed;
  background: #efe7d8;
  color: #b3a989;
  border-color: #efe7d8;
  box-shadow: none;
}

</style>
</body>
</html>
