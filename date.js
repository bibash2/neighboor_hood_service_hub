const current_date = new Date();
const random_date=new Date("2024-03-30");
const differerence_in_days = Math.floor((random_date-current_date)/(1000*24*60*60));

console.log(Math.floor(differerence_in_days))

if(differerence_in_days ===0){
    console.log("recently");
}
else{
    console.log(`${differerence_in_days} days left`)
}