document.addEventListener("DOMContentLoaded", function (event) {
    const sidebarToggle = document.body.querySelector("#sidebarToggle");
    const sidebarBackdrop = document.body.querySelector("#sidebarBackdrop");
    const sidebarWrapper = document.body.querySelector("#sidebar-wrapper");

    // Restore sidebar state from localStorage on desktop
    if (window.innerWidth >= 768) {
        if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
            document.body.classList.add("sb-sidenav-toggled");
        }
    } else {
        document.body.classList.remove("sb-sidenav-toggled");
    }

    if (sidebarToggle) {
        sidebarToggle.addEventListener("click", (event) => {
            event.preventDefault();

            if (window.innerWidth >= 768) {
                document.body.classList.toggle("sb-sidenav-toggled");
                localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains("sb-sidenav-toggled"));
            } else {
                document.body.classList.toggle("sb-sidenav-toggled");
                if (sidebarBackdrop) {
                    sidebarBackdrop.classList.toggle("active");
                }
            }
        });
    }

    if (sidebarBackdrop) {
        sidebarBackdrop.addEventListener("click", () => {
            document.body.classList.remove("sb-sidenav-toggled");
            sidebarBackdrop.classList.remove("active");
        });
    }

    window.addEventListener("resize", () => {
        if (window.innerWidth >= 768) {
            sidebarBackdrop?.classList.remove("active");
        } else {
            if (document.body.classList.contains("sb-sidenav-toggled")) {
                sidebarBackdrop?.classList.add("active");
            }
        }
    });
});

document.addEventListener("click", function (e) {
    if (e.target.classList.contains("copy-btn")) {
        const text = e.target.dataset.copy;

        navigator.clipboard.writeText(text).then(() => {
            Swal.fire({
                toast: true,
                position: "top-end",
                icon: "success",
                title: "Nomor berhasil disalin",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
            });
        });
    }
});
