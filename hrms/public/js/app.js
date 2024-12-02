// Document Ready Function
document.addEventListener('DOMContentLoaded', function () {
    console.log("Custom JS Loaded!");

    // Example: Smooth scrolling for anchor links
    const links = document.querySelectorAll('a[href^="#"]');
    links.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Example: Confirm before deleting
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            const confirmed = confirm("Are you sure you want to delete this item?");
            if (!confirmed) {
                e.preventDefault();
            }
        });
    });
});

// Example: Dynamic Modal Content
function showModal(modalId, title, content) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.querySelector('.modal-title').textContent = title;
        modal.querySelector('.modal-body').innerHTML = content;
        new bootstrap.Modal(modal).show();
    }
}

// Example: AJAX Request for Live Data
function fetchLiveData(url, updateElementId) {
    fetch(url)
        .then(response => response.json())
        .then(data => {
            document.getElementById(updateElementId).textContent = data.value;
        })
        .catch(error => console.error("Error fetching live data:", error));
}
