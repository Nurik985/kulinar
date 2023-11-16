import './bootstrap'
import '@nextapps-be/livewire-sortablejs';
import './ckeditor/ru';

import.meta.glob(['../images/**'])

const delModal = document.getElementById('delMod')
const modal = new Modal(delModal)

window.onload = function () {
    const preloader = document.getElementById('preloader')
    const successAlert = document.getElementById("successAlert");
    window.setTimeout(function () {
        preloader.classList.add('hidden')
    }, 500)
    if (successAlert != null) {
        window.setTimeout(function () {
            successAlert.classList.add('hidden')
        }, 2000)
    }
}

window.addEventListener('openDelModal', function (e) {
    modal.toggle()
})

window.addEventListener('closeDelModal', function (e) {
    modal.toggle()
})

window.csrf = document.querySelector('meta[name="csrf-token"]').content;

window.addEventListener('hideAlert', (e) => {
    const hideAlert = document.getElementById("hideAlert");
    setInterval(() => hideAlert.style.opacity = '0', 3000)
});
