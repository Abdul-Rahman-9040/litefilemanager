document.addEventListener("DOMContentLoaded", function() {
    const searchButton = document.getElementById("searchButton");
    const searchInput = document.getElementById("search");
    const tableBody = document.querySelector("table tbody");

    searchButton.addEventListener("click", function() {
        const searchTerm = searchInput.value;
        fetch(`search_admin.php?search=${searchTerm}`)
            .then(response => response.text())
            .then(data => {
                tableBody.innerHTML = data;
            })
            .catch(error => {
                console.error("Error:", error);
            });
    });
});
