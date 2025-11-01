<div class="bg-white p-4 mt-4 rounded shadow-sm footer-custom" id="footer">
    <div class="d-flex justify-content-between">
        <span>All reserved Copyright &copy; <b class="text-success">Saini Refrigeration</b></span>
        <span>Design by <i class="bi bi-palette"></i> <a href="www.web4businesssolutions.com"
                class="text-primary fw-bold">web4businesssolutions</a></span>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Close sidebar on mobile when X icon is clicked
    const closeSidebarBtn = document.getElementById("closeSidebarBtn");
    if (closeSidebarBtn) {
        closeSidebarBtn.addEventListener('click', function() {
            if (window.innerWidth < 768) {
                sidebar.classList.add("collapsed");
                content.classList.remove("blurred");
                topbar.classList.remove("blurred");
            }
        });
    }

    // Toggle sidebar
    const toggleBtn = document.getElementById("toggleBtn");
    const sidebar = document.getElementById("sidebar");
    const content = document.getElementById("content");
    const topbar = document.getElementById("topbar");
    const footer = document.getElementById("footer");
    const mobileSearchBtn = document.getElementById("mobileSearchBtn");
    const mobileSearchModal = new bootstrap.Modal(document.getElementById('mobileSearchModal'));

    toggleBtn.addEventListener("click", () => {
        sidebar.classList.toggle("collapsed");
        content.classList.toggle("full");
        topbar.classList.toggle("full");
        footer.classList.toggle("full");
        // Blur content and topbar on mobile when sidebar is open
        if (window.innerWidth < 768 && !sidebar.classList.contains("collapsed")) {
            content.classList.add("blurred");
            topbar.classList.add("blurred");
        } else {
            content.classList.remove("blurred");
            topbar.classList.remove("blurred");
        }
    });

    // Remove blur if window resized to desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            content.classList.remove("blurred");
            topbar.classList.remove("blurred");
        }
    });

    // Mobile search icon click
    if (mobileSearchBtn) {
        mobileSearchBtn.addEventListener('click', function() {
            mobileSearchModal.show();
        });
    }
</script>
</body>

</html>