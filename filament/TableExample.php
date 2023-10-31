<?php

use AmsterdamGold\Product\Models\Category;
use App\Domain\Product\Actions\CreateCategoryFromFormInputAction;
use Illuminate\Support\Str;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Filters\Filter;
use Filament\Forms;
use Filament\Tables\Actions\Action;

class TableExample extends Component implements HasTable
{
    use InteractsWithTable;

    public bool $addEditAction = false;
    public string $name = '';
    public string $slug = '';
    public ?int $categoryId = null;
    public bool $isMetal = true;

    public function render()
    {
        return view('table-example');
    }

    public function editCategoryAction(Category $category)
    {
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->categoryId = $category->id;
        $this->isMetal = $category->is_metal;
        $this->addEditAction = true;
    }

    public function deleteCategoryAction(Category $category)
    {
        $product = $category->products()->first();
        if (!$product) {
            $category->forceDelete();
            return;
        }
        session()->flash('error', __('The category is associated with products.'));
    }

    public function updatingName()
    {
        $this->slug = Str::of($this->name)->slug();
    }

    public function handleClickedAddCategory()
    {
        $this->name = '';
        $this->categoryId = null;
        $this->isMetal = true;
        $this->addEditAction = true;
    }

    public function save()
    {
        $category = app(CreateCategoryFromFormInputAction::class)
            ->execute(['name' => $this->name, 'isMetal' => $this->isMetal], $this->categoryId ?? null);
        if ($category) {
            session()->flash('success', __('Saved'));
            $this->addEditAction = false;
        } else {
            session()->flash('error', __('Duplicated category slug'));
        }
    }

    public function cancel()
    {
        $this->addEditAction = false;
    }

    protected function getTableQuery(): Builder
    {
        return Category::query()->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->label(__('Name')),
            Tables\Columns\TextColumn::make('slug')
                ->label(__('Type')),
            Tables\Columns\IconColumn::make('is_metal')
                ->boolean()
                ->label(__('Is Metal?'))
                ->default(true),
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            Filter::make('name')
                ->label(__('Name'))
                ->form([
                    Forms\Components\TextInput::make('name'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['name'],
                            fn (Builder $query, $name): Builder => $query->where('name', 'like', "%$name%")
                        );
                }),
            Filter::make('is_metal')
                ->label(__('Is metal?'))
                ->query(fn (Builder $query): Builder => $query->where('is_metal', true)),
            Filter::make('is_non_metal')
                ->label(__('Is non metal?'))
                ->query(fn (Builder $query): Builder => $query->where('is_metal', false))
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('edit')
                ->label(__('Edit'))
                ->action(fn (Category $record) => $this->editCategoryAction($record)),
            Action::make('delete')
                ->label(__('Delete'))
                ->action(fn (Category $record) => $this->deleteCategoryAction($record))
                ->requiresConfirmation()
                ->color('danger')
        ];
    }
}
