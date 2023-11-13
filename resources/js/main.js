import './bootstrap'
import '@nextapps-be/livewire-sortablejs';
import './ckeditor/ru';

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
})

window.addEventListener('closeDelModal', function (e) {
    modal.toggle()
})

window.csrf = document.querySelector('meta[name="csrf-token"]').content;

window.addEventListener('hideAlert', (e) => {
    const hideAlert = document.getElementById("hideAlert");
    setInterval(() => hideAlert.style.opacity = '0', 3000)
});
