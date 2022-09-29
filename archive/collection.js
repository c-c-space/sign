let now = new Date();
let date = now.getDay();

const collection = document.getElementById('date');
const select = document.createDocumentFragment();

for (let start = 0; start < 31 - date; start++) {
    const option = document.createElement('option');

    select.appendChild(collection);
    option.appendChild(select);
}