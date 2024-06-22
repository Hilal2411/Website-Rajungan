document.addEventListener('DOMContentLoaded', () => {
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
            // Optionally, you could show a message that the item is already in the cart
            return;
        } else {
            // Add item to cart
            cartItems.push({ name, price, quantity, image });
            localStorage.setItem('cartItems', JSON.stringify(cartItems));
        }

        // Redirect to cart page
        window.location.href = 'keranjang.html';
    }
});
