document.addEventListener('DOMContentLoaded', () => {
    const cartBody = document.getElementById('cart-body');
    const cartTotal = document.getElementById('cart-total');
    const checkoutButton = document.getElementById('openModalBtn');
    const modal = document.getElementById('checkoutModal');
    const span = document.getElementsByClassName('close')[0];

    let cart = [];

    // Load items from localStorage on page load
    const storedCartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    cart = [...storedCartItems]; // Copy items from localStorage to cart array

    // Update the cart display
    updateCart();

    function updateCart() {
        cartBody.innerHTML = '';
        let total = 0;

        cart.forEach((item, index) => {
            const itemTotal = item.price * item.quantity;
            total += itemTotal;

            const row = document.createElement('tr');
            row.innerHTML = `
                <td><img src="${item.image}" alt="${item.name}" style="max-width: 50px;"></td>
                <td>${item.name}</td>
                <td>Rp${item.price.toLocaleString()}</td>
                <td>
                    <div class="quantity-controls">
                        <button class="decrease-quantity" data-index="${index}">-</button>
                        <input type="text" value="${item.quantity}" readonly>
                        <button class="increase-quantity" data-index="${index}">+</button>
                    </div>
                </td>
                <td>Rp${itemTotal.toLocaleString()}</td>
                <td><button class="delete-button" data-index="${index}">Hapus</button></td>
            `;
            cartBody.appendChild(row);
        });

        cartTotal.textContent = `Total: Rp${total.toLocaleString()}`;
        document.getElementById('cart-total-modal').textContent = `Total: Rp${total.toLocaleString()}`;
        localStorage.setItem('totalPrice', total); // Store total price in localStorage
        addEventListeners();
    }

    function addEventListeners() {
        document.querySelectorAll('.increase-quantity').forEach(button => {
            button.addEventListener('click', (event) => {
                const index = parseInt(event.target.dataset.index);
                cart[index].quantity++;
                saveCartToLocalStorage();
                updateCart();
            });
        });

        document.querySelectorAll('.decrease-quantity').forEach(button => {
            button.addEventListener('click', (event) => {
                const index = parseInt(event.target.dataset.index);
                if (cart[index].quantity > 1) {
                    cart[index].quantity--;
                    saveCartToLocalStorage();
                    updateCart();
                }
            });
        });

        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', (event) => {
                const index = parseInt(event.target.dataset.index);
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cart.splice(index, 1);
                        saveCartToLocalStorage();
                        updateCart();
                        Swal.fire('Deleted!', 'Your item has been deleted.', 'success');
                    }
                });
            });
        });

        checkoutButton.addEventListener('click', () => {
            modal.style.display = "block";
        });

        span.addEventListener('click', () => {
            modal.style.display = "none";
        });

        window.addEventListener('click', (event) => {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });
    }

    // Save cart to localStorage whenever it changes
    function saveCartToLocalStorage() {
        localStorage.setItem('cartItems', JSON.stringify(cart));
    }
});
