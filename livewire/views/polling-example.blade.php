<div wire:poll>
    {{-- will refresh the component every 2s --}}
    Current time: {{ now() }}
</div>

<div wire:poll.750ms>
    {{-- we can customize the frequency by passing a directive modifier like 750ms --}}
    Current time: {{ now() }}
</div>

<div wire:poll="foo">
    {{-- we can also specify a specific action to fire on the polling interval by passing a value to wire:poll --}}
    {{-- the foo method on the component will be called every 2 seconds --}}
    Current time: {{ now() }}
</div>

<div wire:poll.keep-alive>
    {{-- to keep polling at the normal rate even while the tab is in the background, we can use the keep-alive modifier --}}
    Current time: {{ now() }}
</div>

<div wire:poll.visible>
    {{-- if our component isn't always visible in the browser's viewport (further down the page for example) --}}
    {{-- we can opt to only poll the server when an element is visible by adding the .visible modifier to wire:poll --}}
</div>
