const selectedAll = document.querySelector("#selectedAll")
const itemSelected = document.querySelectorAll(".itemSelected")
const itemSelectedArray = Array.from(itemSelected)

selectedAll.addEventListener("change", (event) => {
  itemSelected.forEach((item) => {
    item.checked = false
  })
  if (event.target.checked) {
    itemSelected.forEach((item) => {
      item.checked = true
    })
  }
})
function isSelected (item) {
  return item.checked
}
itemSelected.forEach((item) => {
  item.addEventListener("change", (event) => {
    const someSelected = itemSelectedArray.some(isSelected)
    deleteItem.style.display = "none"
    if (someSelected) {
      deleteItem.style.display = "inline-block"
    }
  })
})

deleteItem.addEventListener("click", (e) => {
  e.preventDefault()

  const confirmDelete = confirm("Deseas eliminar los registros seleccionados")
  if (confirmDelete) {

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
            window.location.reload(true)
          }
        })
    }
  }
})