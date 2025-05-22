function findIndices(baseArray, lookupArray) {
    return lookupArray.map(item => baseArray.indexOf(item));
}

var countryMap = {};

window.conflictsLocations.forEach((element, index) => {
    countryMap[index] = element;
});

var tmp = window.conflicts;

console.log(window.conflictsLocations);

console.log({tmp});

var countryMapArray = Object.values(countryMap);

let conflicts = [];

window.conflicts.forEach((element, index) => {
    conflicts.push({
        id: element.id,
        name: element.name,
        link: element.link,
        start_date: element.start_date.substring(0, 4),
        end_date: element.end_date.substring(0, 4),
                countries_id: element.countries.map(c => c.id),
        countries: element.countries,
        casualties: element.casualties,
        longitude: 0.0,
        latitude: 0.0,
    })
})

const conflictsPerPage = 35;
let currentPage = 1;
let filteredConflicts = conflicts;

function updateYearRange() {
    const minSlider = document.getElementById('yearRangeMin');
    const maxSlider = document.getElementById('yearRangeMax');

    let minYear = parseInt(minSlider.value);
    let maxYear = parseInt(maxSlider.value);


    if (minYear > maxYear) {
        [minYear, maxYear] = [maxYear, minYear];
        minSlider.value = minYear;
        maxSlider.value = maxYear;
    }

    document.getElementById('yearRangeValue').textContent = `${minYear} - ${maxYear}`;

    filterConflicts();
}


function renderConflictsPage(page) {
    const tableBody = document.getElementById('conflictsTableBody');
    tableBody.innerHTML = '';

    const start = (page - 1) * conflictsPerPage;
    const end = start + conflictsPerPage;
    const pageConflicts = filteredConflicts.slice(start, end);

    if (pageConflicts.length === 0) {
        const row = `
            <tr>
                <td colspan="5" style="text-align: center; padding: 20px;">Brak danych do wyświetlenia</td>
            </tr>
        `;
        tableBody.innerHTML = row;
    } else {
        pageConflicts.forEach(conflict => {
            const countryNames = conflict.countries.map((element, index) => {
                return index !== 0 ? ' ' + element.name : element.name;
            });

            const row = `
                <tr>
                    <td><a href='${conflict.link}' target="_blank" rel="noopener noreferrer">${conflict.name}</a></td>
                    <td>${conflict.start_date}</td>
                    <td>${conflict.end_date}</td>
                    <td>${conflict.casualties}</td>
                    <td>${countryNames}</td>
                </tr>
            `;
            tableBody.innerHTML += row;
        });
    }

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
    const minYear = parseInt(document.getElementById('yearRangeMin').value);
    const maxYear = parseInt(document.getElementById('yearRangeMax').value);

    filteredConflicts = conflicts.filter(conflict => {
        const conflictStart = parseInt(conflict.start_date);
        const conflictEnd = conflict.end_date === 'trwa' ? new Date().getFullYear() : parseInt(conflict.end_date);

        if (!conflict.name.toLowerCase().includes(searchInput)) return false;


        if (countryFilter && !conflict.countries_id.includes(Number(countryFilter))) return false;

        if (conflictStart < minYear) return false;

        if (conflictEnd > maxYear) return false;

        return true;
    });

    currentPage = 1;
    renderConflictsPage(currentPage);
}


// Initialize the slider values and filter
document.addEventListener('DOMContentLoaded', function() {
    // Find min and max years from the data
    let minYear = 9999, maxYear = 0;
    conflicts.forEach(conflict => {
        const startYear = parseInt(conflict.start_date);
        const endYear = conflict.end_date === 'trwa' ? new Date().getFullYear() : parseInt(conflict.end_date);
        
        if (startYear < minYear) minYear = startYear;
        if (endYear > maxYear) maxYear = endYear;
    });
    
    // Set slider min/max values
    document.getElementById('yearRangeMin').min = minYear;
    document.getElementById('yearRangeMin').max = maxYear;
    document.getElementById('yearRangeMin').value = minYear;
    
    document.getElementById('yearRangeMax').min = minYear;
    document.getElementById('yearRangeMax').max = maxYear;
    document.getElementById('yearRangeMax').value = maxYear;
    
    document.getElementById('yearRangeValue').textContent = `${minYear} - ${maxYear}`;
    
    filterConflicts();
});
const tbody = document.querySelector('table tbody');
const table = document.querySelector('table');
if (tbody.children.length === 0) {
    table.classList.add('empty');
} else {
    table.classList.remove('empty');
}