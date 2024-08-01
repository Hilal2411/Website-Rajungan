
// untuk navigasi hamburger
const menuIcon = document.getElementById('menu-icon');
const navbar = document.getElementById('navbar');

// Toggle the navigation menu when the menu icon is clicked
menuIcon.addEventListener('click', (event) => {
  navbar.classList.toggle('show');
  event.stopPropagation(); // Prevents the event from bubbling up to the document
});

// Close the navigation menu when clicking outside of it
document.addEventListener('click', (event) => {
  if (!navbar.contains(event.target) && !menuIcon.contains(event.target)) {
    navbar.classList.remove('show');
  }
});

// ketika user klik btn_user
const btnUser = document.querySelector('#btn_user');
const userMenu = document.querySelector('#user_menu');

// Toggle the user menu when the user icon is clicked
btnUser.onclick = (e) => {
    userMenu.classList.toggle('active');
    e.preventDefault();
    e.stopPropagation(); // Prevents the click from closing the menu immediately
};

// Close the user menu when clicking outside of it
document.addEventListener('click', (e) => {
    if (!userMenu.contains(e.target) && !btnUser.contains(e.target)) {
        userMenu.classList.remove('active');
    }
});

document.addEventListener('DOMContentLoaded', () => {

    console.log("Testing");
    const addToCartButtons = document.querySelectorAll('.add-to-cart');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', addToCart);
    });

    

    function addToCart(event) {
        const productElement = event.target.closest('.pro');
        const name = productElement.dataset.name;
        const price = parseInt(productElement.dataset.price);
        const image = productElement.dataset.image;
        const quantity = 1; // Default quantity

        let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

        // Check if item is already in the cart
        const existingItem = cartItems.find(item => item.name === name);
        if (existingItem) {
            // If item already exists, increase the quantity
            existingItem.quantity += 1;
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.onmouseenter = Swal.stopTimer;
                  toast.onmouseleave = Swal.resumeTimer;
                }
              });
              Toast.fire({
                icon: "success",
                title: `${name} telah ditambahkan menjadi ${existingItem.quantity} dikeranjang`
              });
           
        } else {
            // Add item to cart

            cartItems.push({ name, price, quantity, image });
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.onmouseenter = Swal.stopTimer;
                  toast.onmouseleave = Swal.resumeTimer;
                }
              });
              Toast.fire({
                icon: "success",
                title: `${name} telah ditambahkan ke keranjang.`
              });
        }

        localStorage.setItem('cartItems', JSON.stringify(cartItems));


    }
});