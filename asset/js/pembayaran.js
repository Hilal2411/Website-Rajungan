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