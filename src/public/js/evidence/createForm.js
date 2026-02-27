const modal = document.getElementById('createEvidenceModal')
const openBtn = document.getElementById('openEvidenceModal')
const closeBtn = document.getElementById('closeEvidenceModal')
const cancelBtn = document.getElementById('cancelEvidenceModal')
const overlay = modal.querySelector('.modal-overlay')

function openModal() {
    modal.classList.add('active')
}

function closeModal() {
    modal.classList.remove('active')
}

openBtn.addEventListener('click', openModal)
closeBtn.addEventListener('click', closeModal)
cancelBtn.addEventListener('click', closeModal)
overlay.addEventListener('click', closeModal)