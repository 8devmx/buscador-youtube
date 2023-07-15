const selectedAll = document.querySelector("#selectedAll")

selectedAll.addEventListener("change", (event) => {
  const itemSelected = document.querySelectorAll(".itemSelected")
  itemSelected.forEach((item) => {
    item.checked = false
  })
  if (event.target.checked) {
    itemSelected.forEach((item) => {
      item.checked = true
    })
  }
  showDeleteIcon()
})
function isSelected (item) {
  return item.checked
}

deleteItem.addEventListener("click", (e) => {
  e.preventDefault()

  const confirmDelete = confirm("Deseas eliminar los registros seleccionados")
  if (confirmDelete) {

    const itemSelectedArray = arrayItems()
    const itemsChecked = itemSelectedArray
      .filter(item => item.checked)
      .map(item => item.value)


    if (itemsChecked.length > 0) {
      const formData = new FormData();
      formData.append('function', 'deleteItem');
      formData.append('itemsChecked', itemsChecked);
      fetch("functions.php", {
        method: "POST",
        body: formData
      }).then(response => response.json())
        .then(json => {
          alert(json.text)
          if (json.status === "success") {
            get_data()
          }
        })
    }
  }
})

const get_data = (search = "", page = 1) => {
  const form = new FormData();
  form.append('function', 'data')
  form.append('search', search)
  form.append('page', page)
  fetch("functions.php", {
    method: "POST",
    body: form
  })
    .then(response => response.json())
    .then(json => {
      let template = ``
      json.data.forEach(item => {
        template += `
        <div class='item'>
          <input type='checkbox' value= '${item.id}' class='itemSelected' />
          <h2>${item.nombre}</h2>
          <h3>${item.correo}</h3>
          <p>${item.telefono}</p>
          <a href="#" class="btnEdit">Editar</a>
        </div>
        `
      })
      results.innerHTML = template
      pagination(json.attributes)
    })
}

const pagination = attributes => {
  let template = ''
  for (let index = 1; index <= attributes.pages; index++) {
    template += `
    <li>
      <a href="#" class="pages" data-page="${index}">${index}</a>
    </li>
    `
  }
  paginationWrapper.innerHTML = template
}

paginationWrapper.addEventListener("click", event => {
  event.preventDefault()
  if (event.target.classList.contains('pages')) {
    get_data(fieldSearch.value, event.target.getAttribute("data-page"))
  }
})
btnSearch.addEventListener('click', event => {
  event.preventDefault()
  if (fieldSearch.value.length < 2) {
    alert("Debes de escribir al menos 3 dígitos")
    return false
  }
  const search = fieldSearch.value
  get_data(search)
})

results.addEventListener('click', event => {
  if (event.target.classList.contains('itemSelected')) {
    showDeleteIcon()
  }
  if (event.target.classList.contains('btnEdit')) {
    console.log('Quieres editar este elemento')
  }
})

const arrayItems = () => {
  const itemSelected = document.querySelectorAll(".itemSelected")
  return Array.from(itemSelected)
}
const showDeleteIcon = () => {
  const itemSelectedArray = arrayItems()
  const someSelected = itemSelectedArray.some(isSelected)
  deleteItem.style.display = "none"
  if (someSelected) {
    deleteItem.style.display = "inline-block"
  }
}
get_data()