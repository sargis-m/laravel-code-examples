<div>
    <button type="button" onClick="datalayerPush()">Send to GA4</button>
</div>

<script>
    // datalayer
    function datalayerPush() {
        let items = [];

        @foreach($datalayerData['params']['items'] as $item)
            items.push({
                item_name: "{{$item['item_name']}}",
                price: {{$item['price']}},
                quantity: {{$item['quantity']}},
            });
        @endforeach

        dataLayer.push({ecommerce: null});  // Clear the previous ecommerce object.
        dataLayer.push({
            event: 'purchase',
            ecommerce: {
                currency: "EUR",
                value: {{ round($datalayerData['params']['value'], 2) }},
                transaction_id: "{{ $datalayerData['params']['transaction_id'] }}",
                items: items
            }
        });
    }
</script>
