<select name="category" id="category">
<option value="0">All</option>
</select>

<script>
    const all_category = document.querySelector("#category");
    async function get_category() {
        const response = await fetch(`http://localhost/neighboor_hood_service_hub/models/category.php`, {
            method: "GET"
        })
        const categories = await response.json();
        categories.forEach(category => {

            all_category.innerHTML +=
                `
                <option value="${category.category_id}">${category.category_name}</option>`;
        })
        
    }
    get_category();
</script>