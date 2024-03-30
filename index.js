const able_to_bid = async (user_id, project_category_id) => {
    // first check whether the user is register as a service provider or not
    const response1 = await fetch(`http://localhost/neighboor_hood_service_hub/models/get_user.php?user_id=${user_id}`);
    const user = await response1.json();
    if (user.length == 0) {
        return false;
    }
    else if (user.category_id == project_category_id) {
        return true
    }
    return false;
}

const fun = async()=>{
    console.log( await able_to_bid(3,4))
}

fun()