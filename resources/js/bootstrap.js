window.Echo.channel('orders')
    .listen('.OrderShipped', (e) => {
        console.log('Order shipped:', e.order);
    });
