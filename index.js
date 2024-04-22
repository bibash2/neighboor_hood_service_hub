const cu = new Date();
const ran = new Date('2024-04-2');
const diffre = cu-ran;

const daysAgo = Math.floor(diffre/(1000*60*60*24));


console.log(daysAgo)