getMonth = {
  '202104': ['令和三年四月'],
  '202105': ['令和三年五月'],
  '202106': ['令和三年六月'],
  '202107': ['令和三年七月'],
  '202108': ['令和三年八月'],
  '202109': ['令和三年九月'],
  '202110': ['令和三年十月'],
  '202111': ['令和三年十一月'],
  '202112': ['令和三年十二月'],
  '202201': ['令和四年一月'],
  '202202': ['令和四年二月'],
  '202203': ['令和四年三月'],
  '202204': ['令和四年四月'],
  '202205': ['令和四年五月'],
  '202206': ['令和四年六月'],
}

const monthAll = Object.entries(getMonth)
monthAll.forEach((month) => {
  const optionMonth = document.createElement('option')
  optionMonth.setAttribute("value", month[0])
  optionMonth.innerText = Object.values(month[1])[0]
  document.querySelector('#month').appendChild(optionMonth)
});
