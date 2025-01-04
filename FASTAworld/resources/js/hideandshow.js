function hnsToggle(name, id) {
    const object = document.getElementById(`${name}-${id}`);
    const isHidden = object.classList.contains('hidden');

    if (isHidden) {
        object.classList.remove('hidden');
    } else {
        object.classList.add('hidden');
    }
}
window.hnsToggle = hnsToggle;
