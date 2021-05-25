// Collapsable boxes
document.querySelectorAll('.case .box').forEach(box => {
    box.addEventListener('click', event => {
        const parent = event.target.parentElement;
        parent.classList.toggle('collapsed');
    });
});