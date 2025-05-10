function findIndices(baseArray, lookupArray) {
    return lookupArray.map(item => baseArray.indexOf(item));
}


var countryMap = {};

window.conflictsLocations.forEach((element, index) => {
    countryMap[index] = element;
});


var countryMapArray = Object.values(countryMap);

let conflicts = [];

window.conflicts.forEach((element, index) => {
    conflicts.push({
        id: index,
        name: 'tmp',
        start_date: element.start_date_2nd,
        end_date: element.end_date === "" ? 'trwa' : element.end_date,
        longitude: 0.0,
        latitude: 0.0,
        countries_id: findIndices(countryMapArray, element.location.split(', '))
    })
})

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
