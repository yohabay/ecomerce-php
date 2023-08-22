const stripe = stripe(
  'sk_test_51NbIemCiAMLU2fTKefttogWxZo5TJTOs7m9JwmMUjBhwG0hT29UAXaQWv4dDKmScfKXMBokWjOxvFHTOEv2AlXYr00xLLKDavu'
);
const btn = document.querySelector('#btn');
btn.addEventListener('click', () => {
  fetch('/cart.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({}),
  })
    .then((res) => res.json())
    .then((payload) => {
      stripe.redirectToCheckout({ sessionId: payload.id });
    });
});
