<div>
    <button>category_name</button>
    <button><a href="../php_login/logout.php">Logout</a></button>
    <button class="service_provider">Delete Service_provider Account</button>
</div>

<script>
    const serviceProviderDeleteButton = document.querySelector("service_provider");
    serviceProviderDeleteButton.addEventListener("click", () => {
        const confirmtion = confirm("This action  will permanently delete your service provider account");
        if (confirmtion) {
            const response = fetch(`http://localhost/neighboor_hood_service_hub/models/all_service_provider.php?service_provider_id=${service_provider_id}`, {
                method: "DELETE"
            });
        } else {
            return;
        }
    });
</script>