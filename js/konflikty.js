
const countryMap = {
  1: "Ukraina",
  2: "Syria",
  3: "Afganistan"
};


const conflicts = [
  {
    id: 1,
    name: "Wojna w Ukrainie",
    start_date: "2014-02-20",
    end_date: "trwa",
    longitude: 31.1656,
    latitude: 48.3794,
    countries_id: [1]
  },
  {
    id: 2,
    name: "Wojna domowa w Syrii",
    start_date: "2011-03-15",
    end_date: "trwa",
    longitude: 38.9968,
    latitude: 34.8021,
    countries_id: [2]
  },
  {
    id: 3,
    name: "Wojna w Afganistanie",
    start_date: "2001-10-07",
    end_date: "2021-08-30",
    longitude: 67.7099,
    latitude: 33.9391,
    countries_id: [3]
  }

];


for(let i=4; i<=50; i++) {
  conflicts.push({
    id: i,
    name: "Konflikt #" + i,
    start_date: "2000-01-01",
    end_date: "trwa",
    longitude: 0,
    latitude: 0,
    countries_id: [1 + (i % 3)]
  });
}

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
    const countryNames = conflict.countries_id.map(id => countryMap[id]).join(', ');
    const row = `
        <tr>
          <td>${conflict.name}</td>
          <td>${conflict.start_date}</td>
          <td>${conflict.end_date}</td>
          <td>${countryNames}</td>
        </tr>
      `;
    tableBody.innerHTML += row;
  });

  renderPagination();
}

function renderPagination() {
  const paginationDiv = document.getElementById('pagination');
  paginationDiv.innerHTML = '';

  const totalPages = Math.ceil(filteredConflicts.length / conflictsPerPage);

  if (totalPages <= 1) return;

  for (let i = 1; i <= totalPages; i++) {
    const btn = document.createElement('button');
    btn.textContent = i;
    if (i === currentPage) btn.classList.add('active');
    btn.onclick = () => {
      currentPage = i;
      renderConflictsPage(currentPage);
      window.scrollTo(0,0); // przewiń do góry po zmianie strony
    };
    paginationDiv.appendChild(btn);
  }
}

function filterConflicts() {
  const searchInput = document.getElementById('searchInput').value.toLowerCase();
  const countryFilter = document.getElementById('countryFilter').value;
  const startDateFilter = document.getElementById('startDateFilter').value;
  const endDateFilter = document.getElementById('endDateFilter').value;

  filteredConflicts = conflicts.filter(conflict => {
    if (!conflict.name.toLowerCase().includes(searchInput)) return false;
    if (countryFilter && !conflict.countries_id.includes(Number(countryFilter))) return false;
    if (startDateFilter && conflict.start_date < startDateFilter) return false;
    if (endDateFilter) {
      if (conflict.end_date === 'trwa') {

      } else if (conflict.end_date > endDateFilter) {
        return false;
      }
    }
    return true;
  });

  currentPage = 1;
  renderConflictsPage(currentPage);
}


filterConflicts();
