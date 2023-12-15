<div>
    <x-app-ui::header>
        <x-slot name="actions">
            <x-app-ui::utility-bar.actions>
                <div wire:loading.delay.shortest wire:target="sendEmail">
                    @lang('Sending Email')...
                </div>
                <x-app-ui::button size="sm" wire:click="sendEmail" wire:loading.attr="disabled">
                    @lang('Send Email')
                </x-app-ui::button>
            </x-app-ui::utility-bar.actions>
        </x-slot>
    </x-app-ui::header>
</div>