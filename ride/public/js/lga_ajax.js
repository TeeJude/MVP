function getLgas() {
    let stateObject = document.querySelector("#state_id");
    stateObject.addEventListener("change", function () {
        const stateId = stateObject.value

        fetch(`/get/lgas/${stateId}`, {
            method: 'get',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        }).then((response) => {
            return response.json()
        }).then((res) => {
            appendChildEl(res.data)
        }).catch((error) => {
            console.log(error)
        })

    })
}

function appendChildEl(lga) {
    const lgaObject = document.querySelector("#lga_id")
    lgaObject.innerHTML = '<option value="">select lga</option>'
    lga.map(data => {
        const option = document.createElement('option')
        option.value = data.id
        option.innerHTML = data.name
        lgaObject.appendChild(option)
    })
}


function getElementSelected() {
    const el = document.querySelectorAll('.select-item');
    el.forEach(e => {
        e.addEventListener('click', function () {

            let firstChild = e.firstElementChild
            let firstChildOfirstChild = firstChild.firstElementChild
            const dataId = e.getAttribute("data-id");
            if (firstChild.classList.contains('grayed')) {
                firstChildOfirstChild.value = '';
                firstChild.classList.remove('grayed')
            } else if (!firstChild.classList.contains('grayed')) {
                firstChildOfirstChild.value = dataId;
                firstChild.classList.add("grayed")
            } else {

                firstChildOfirstChild.value = '';
            }
            console.log(firstChildOfirstChild)
        })
    })
}

getElementSelected()
getLgas()