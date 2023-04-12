getMonth = {
  '202110': ['令和三年十月'],
  '202111': ['令和三年十一月'],
  '202112': ['令和三年十二月'],
  '202201': ['令和四年一月'],
  '202202': ['令和四年二月'],
  '202203': ['令和四年三月'],
  '202204': ['令和四年四月'],
  '202205': ['令和四年五月'],
  '202206': ['令和四年六月'],
  '202207': ['令和四年七月'],
  '202208': ['令和四年八月'],
  '202209': ['令和四年九月'],
}

const monthAll = Object.entries(getMonth)
monthAll.forEach((month) => {
  const optionMonth = document.createElement('option')
  optionMonth.setAttribute("value", month[0])
  optionMonth.innerText = Object.values(month[1])[0]
  document.querySelector('#month').appendChild(optionMonth)
});
