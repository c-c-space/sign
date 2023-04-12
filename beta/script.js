getMonth = {
  'index.php': ['令和三年三月'],
  '202104.php': ['令和三年四月'],
  '202105.php': ['令和三年五月'],
  '202106.php': ['令和三年六月'],
  '202107.php': ['令和三年七月'],
  '202108.php': ['令和三年八月'],
}

const selectModal = document.querySelector('#log select');
const monthAll = Object.entries(getMonth)
monthAll.forEach((month) => {
  const optionMonth = document.createElement('option')
  optionMonth.setAttribute("value", month[0])
  optionMonth.innerText = Object.values(month[1])[0]
  selectModal.appendChild(optionMonth)
});

selectModal.addEventListener('change', function() {
  const optionModal = document.querySelectorAll("#log select option");
  const index =  this.selectedIndex;
  window.location.assign(optionModal[index].value);
});


function allView() {
  let all = document.querySelector('#all');
  let flash = document.querySelector('#flash');
  if (all.style.opacity == 1) {
    all.style.opacity = 0;
    flash.style.opacity = 0;
    selectModal.style.opacity = 1;
    all.style.zIndex = 0;
    flash.style.zIndex = 0;
    selectModal.style.zIndex = 1;
  } else {
    all.style.opacity = 1;
    flash.style.opacity = 0;
    selectModal.style.opacity = 0;
    all.style.zIndex = 1;
    flash.style.zIndex = 0;
    selectModal.style.zIndex = 0;
  }
}

function flashView() {
  let flash = document.querySelector('#flash');
  let all = document.querySelector('#all');
  if (flash.style.opacity == 1) {
    flash.style.opacity = 0;
    all.style.opacity = 0;
    selectModal.style.opacity = 1;
    flash.style.zIndex = 0;
    all.style.zIndex = 0;
    selectModal.style.zIndex = 1;
  } else {
    flash.style.opacity = 1;
    all.style.opacity = 0;
    selectModal.style.opacity = 0;
    flash.style.zIndex = 1;
    all.style.zIndex = 0;
    selectModal.style.zIndex = 0;
  }
}
