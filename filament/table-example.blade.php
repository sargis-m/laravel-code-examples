<div>
    <x-app-ui::card>
        <x-slot name="header">
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-2">@lang('Categories')</div>
                    <x-app-ui::button type="button" wire:click="handleClickedAddCategory">
                        @lang('Add Category')
                    </x-app-ui::button>
            </div>
        </x-slot>

        <div class="space-y-4">
            {{ $this->table }}
            <x-alert variant="full" />
        </div>

        @if($addEditAction)
            <x-slot name="footer">
                <x-app-ui::card>
                    <x-slot name="header">
                        <x-app-ui::card.heading>
                            @if($slug)
                                @lang('Category Slug'): {{$slug}}
                            @endif
                        </x-app-ui::card.heading>
                    </x-slot>
                    <x-app-ui::prose>
                        <x-app-ui::input-group>
                            <x-app-ui::input
                                wire:model="name"
                                name="name"
                                :label="__('Name')"
                            />
                        </x-app-ui::input-group>
                        <x-app-ui::checkbox-group class="mt-6">
                            <x-app-ui::checkbox
                                :label="__('Is Metal?')"
                                wire:model="isMetal"
                            />
                        </x-app-ui::checkbox-group>
                    </x-app-ui::prose>
                    <x-slot name="footer">
                        <x-app-ui::card.actions>
                            <x-app-ui::button wire:click.prevent="cancel">
                                @lang('Cancel')
                            </x-app-ui::button>
                            <x-app-ui::button wire:click.prevent="save">
                                @lang('Save')
                            </x-app-ui::button>
                        </x-app-ui::card.actions>
                    </x-slot>
                </x-app-ui::card>
            </x-slot>
        @endif
    </x-app-ui::card>
</div>
