const content = document.querySelector(".content");
const form = document.querySelector("form");

form.addEventListener("submit", function(e) {
    e.preventDefault();
    create({name: this.name.value, address: this.address.value, city: this.city.value});
    form.reset();
})

function displayAll() {
    fetch("http://localhost/phpExam2/?type=restaurant&action=index")
        .then((res) => res.json())
        .then((restaurants) => {
            content.innerHTML = "";
            restaurants.forEach((restaurant) => {
                console.log(restaurant);
                content.innerHTML += templateRestaurant(restaurant);
                content.querySelector(".delBtn").addEventListener("click", function() {
                    suppr({id: this.id})
                });
            });
        })
}

function displayPlats(array) {
    let plats = "";
    array.forEach((plat)=>{
        let template = `<div class="card p-2 m-2  ">
    <strong>${plat.description}</strong>
    <p>${plat.price}€</p>
    </div>`;
        plats += template;
    });
    return plats;
}


const create = (body) => {
    fetch("http://localhost/phpExam2/?type=restaurant&action=new", {
        method:"POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(body)})
        .then((res)=>res.json()).then(data=>{
        console.log(data);
        displayAll();
    });
};


const suppr = (id) => {
    fetch("http://localhost/phpExam2/?type=restaurant&action=del", {
        method: "DELETE",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(id),
    })
        .then((res)=>res.json())
        .then((data)=> {
            console.log(data)
            displayAll();
        })
}

const templateRestaurant = (restaurant) => {
    template = `<div class="mt-5 me-5 p-2 card">
  <div>
    <button id="${restaurant.id}" class="btn btn-danger delBtn">X</button>
  </div>
    <h3>${restaurant.name}</h3>
    <p>${restaurant.address}, ${restaurant.city}</p> 
    <p>${displayPlats(restaurant.plat)}</p>
    </div>`;
    return template;
};

displayAll();