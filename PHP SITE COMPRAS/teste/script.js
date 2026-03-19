document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('container');
    const registerBtn = document.getElementById('register');
    const loginBtn = document.getElementById('login');

    registerBtn.addEventListener('click', () => {
        container.classList.add('active');
    });

    loginBtn.addEventListener('click', () => {
        container.classList.remove('active');
    });
});

const addToCartButton = document.getElementById('add-to-cart');

addToCartButton.addEventListener('click', () => {
  addToCartButton.addEventListener('click', () => {
    const itemId = 'ITEM_ID_HERE';
    const quantity = 1;
    Shopify.addItemToCart(itemId, quantity);
  });
});


