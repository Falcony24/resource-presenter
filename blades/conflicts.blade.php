

<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <title>Konflikty zbrojne</title>
  <link rel="stylesheet" href="{{ asset('css/table.css') }}">
</head>
<body>
<nav>
  <a href="{{ url('index.html') }}">Główna</a> |
  <a href="{{ url('api/conflicts') }}">Zobacz konflikty</a> |
  <a href="{{ url('api/commoditiesTypes') }}">Zobacz dane surowców</a> |
  <a href="{{ url('analizy.html') }}">Analizy</a>
</nav>

<h1>Lista konfliktów zbrojnych</h1>

<div class="filters">
  <input type="text" id="searchInput" placeholder="Szukaj konfliktu..." onkeyup="filterConflicts()">
  <div class="filter-date">
    <label for="startDateFilter">Data rozpoczęcia</label>
    <input type="date" id="startDateFilter" onchange="filterConflicts()">
  </div>
  <div class="filter-date">
    <label for="endDateFilter">Data zakończenia</label>
    <input type="date" id="endDateFilter" onchange="filterConflicts()">
  </div>
</div>

<table>
  <thead>
    <tr>
      <th>Miejsce konfliktu</th>
      <th>Data rozpoczęcia</th>
      <th>Data zakończenia</th>
    </tr>
  </thead>
  <tbody id="conflictsTableBody">
    @foreach($conflicts as $conflict)
      <tr>
        <td>{{ $conflict->location }}</td>
        <td>{{ $conflict->start_date }}</td>
        <td>{{ $conflict->end_date }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

<div class="pagination" id="pagination"></div>

<style>
/* (pełna sekcja style pozostaje taka sama jak wcześniej – jeśli chcesz, mogę ją usunąć dla uproszczenia lub skrócić) */
</style>

<script>
    const conflicts = @json($conflicts); // Musi zawierać: location, start_date, end_date

    const conflictsPerPage = 30;
    let currentPage = 1;
    let filteredConflicts = conflicts;

    function renderConflictsPage(page) {
        const tableBody = document.getElementById('conflictsTableBody');
        tableBody.innerHTML = '';

        const start = (page - 1) * conflictsPerPage;
        const end = start + conflictsPerPage;
        const pageConflicts = filteredConflicts.slice(start, end);

        pageConflicts.forEach(conflict => {
            const row = document.createElement('tr');

            const tdLocation = document.createElement('td');
            tdLocation.textContent = conflict.location;

            const tdStartDate = document.createElement('td');
            tdStartDate.textContent = conflict.start_date;

            const tdEndDate = document.createElement('td');
            tdEndDate.textContent = conflict.end_date ?? 'trwa';

            row.appendChild(tdLocation);
            row.appendChild(tdStartDate);
            row.appendChild(tdEndDate);

            tableBody.appendChild(row);
        });

        renderPagination();
    }

    function renderPagination() {
        const paginationDiv = document.getElementById('pagination');
        paginationDiv.innerHTML = '';

        const totalPages = Math.ceil(filteredConflicts.length / conflictsPerPage);
        if (totalPages <= 1) return;

        const maxButtons = 10;
        let startPage = Math.floor((currentPage - 1) / maxButtons) * maxButtons + 1;
        let endPage = Math.min(startPage + maxButtons - 1, totalPages);

        if (startPage > 1) {
            const prevEllipsis = document.createElement('button');
            prevEllipsis.textContent = '...';
            prevEllipsis.onclick = () => {
                currentPage = startPage - 1;
                renderConflictsPage(currentPage);
            };
            paginationDiv.appendChild(prevEllipsis);
        }

        for (let i = startPage; i <= endPage; i++) {
            const btn = document.createElement('button');
            btn.textContent = i;
            if (i === currentPage) btn.classList.add('active');
            btn.onclick = () => {
                currentPage = i;
                renderConflictsPage(currentPage);
                window.scrollTo(0, 0);
            };
            paginationDiv.appendChild(btn);
        }

        if (endPage < totalPages) {
            const nextEllipsis = document.createElement('button');
            nextEllipsis.textContent = '...';
            nextEllipsis.onclick = () => {
                currentPage = endPage + 1;
                renderConflictsPage(currentPage);
            };
            paginationDiv.appendChild(nextEllipsis);

            const lastPageBtn = document.createElement('button');
            lastPageBtn.textContent = totalPages;
            if (currentPage === totalPages) lastPageBtn.classList.add('active');
            lastPageBtn.onclick = () => {
                currentPage = totalPages;
                renderConflictsPage(currentPage);
            };
            paginationDiv.appendChild(lastPageBtn);
        }
    }

    function filterConflicts() {
        const searchInput = document.getElementById('searchInput').value.toLowerCase();
        const startDateFilter = document.getElementById('startDateFilter').value;
        const endDateFilter = document.getElementById('endDateFilter').value;

        filteredConflicts = conflicts.filter(conflict => {
            if (!conflict.location.toLowerCase().includes(searchInput)) return false;
            if (startDateFilter && conflict.start_date < startDateFilter) return false;
            if (endDateFilter) {
                if (conflict.end_date && conflict.end_date !== 'trwa' && conflict.end_date > endDateFilter) {
                    return false;
                }
            }
            return true;
        });

        currentPage = 1;
        renderConflictsPage(currentPage);
    }

    filterConflicts();
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

table {
  table-layout: fixed;
}

th:nth-child(1),
td:nth-child(1) {
  width: 40%;
}

th:nth-child(2),
td:nth-child(2) {
  width: 30%;
}

th:nth-child(3),
td:nth-child(3) {
  width: 30%;
}

td {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

body {
  overflow-y: scroll;
}


</style>
</body>
</html>
