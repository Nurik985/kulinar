import './bootstrap'

import.meta.glob(['../images/**'])

const delModal = document.getElementById('delMod')
const modal = new Modal(delModal)

window.onload = function () {
    const preloader = document.getElementById('preloader')
    window.setTimeout(function () {
        preloader.classList.add('hidden')
    }, 500)
}

window.addEventListener('openDelModal', function (e) {
    modal.toggle()
    document.getElementById('mTitle').innerHTML = e.detail.title
})

window.addEventListener('closeDelModal', function (e) {
    modal.toggle()
})
