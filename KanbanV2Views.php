<?php

namespace App\Filament\Pages;

use App\Models\Record;
use App\Models\Status;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Heloufir\FilamentKanban\enums\KanbanView;
use Heloufir\FilamentKanban\Filament\KanbanBoard;
use Heloufir\FilamentKanban\ValueObjects\KanbanStatuses;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;

class KanbanV2Views extends KanbanBoard
{
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    protected static ?string $slug = 'v2/views';

    protected static ?string $navigationGroup = 'Version 2';

    protected static ?string $title = 'Kanban Views';

    protected bool $showViewTabs = true;

    protected KanbanView $currentView = KanbanView::LIST;

    protected bool $persistCurrentTab = true;

    public static function getNavigationBadge(): ?string
    {
        return 'NEW';
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'success';
    }

    function getStatuses(): KanbanStatuses
    {
        return KanbanStatuses::make(
            Status::all()
        );
    }

    function model(): string
    {
        return Record::class;
    }

    function query(Builder $query): Builder
    {
        return $query;
    }

    function recordForm(): array
    {
        return [
            Grid::make()
                ->schema([
                    Select::make('status_id')
                        ->searchable()
                        ->preload()
                        ->relationship('status', 'title')
                        ->required(),
                ]),

            TextInput::make('title')
                ->columnSpanFull()
                ->maxLength(255)
                ->required(),

            Grid::make(3)
                ->schema([
                    Select::make('owner_id')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->relationship('owner', 'name')
                        ->default(fn() => auth()->id()),

                    Select::make('assignees')
                        ->searchable()
                        ->columnSpan(2)
                        ->preload()
                        ->relationship('assignees', 'name')
                        ->multiple(),
                ]),

            RichEditor::make('description')
                ->columnSpanFull(),

            Grid::make()
                ->schema([
                    DatePicker::make('deadline'),

                    TextInput::make('progress')
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(100),
                ]),
        ];
    }

    function recordInfolist(): array
    {
        return [
            Components\Grid::make(3)
                ->schema([
                    Components\TextEntry::make('status.title'),

                    Components\TextEntry::make('title')
                        ->columnSpan(2),
                ]),

            Components\Grid::make(3)
                ->schema([
                    Components\TextEntry::make('owner.name'),

                    Components\TextEntry::make('assignees')
                        ->columnSpan(2)
                        ->formatStateUsing(function (Record $record) {
                            $html = '<ul>';
                            foreach ($record->assignees as $assignee) {
                                $html .= '<li>' . $assignee->name . '</li>';
                            }
                            $html .= '</ul>';
                            return new HtmlString($html);
                        })
                ]),

            Components\TextEntry::make('description')
                ->columnSpanFull()
                ->html()
                ->extraAttributes(['class' => 'prose']),

            Components\Grid::make()
                ->schema([
                    Components\TextEntry::make('deadline')
                        ->date(config('filament-kanban.deadline-format')),

                    Components\TextEntry::make('progress')
                        ->formatStateUsing(fn($state) => $state . '%'),
                ]),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('docs')
                ->label('Documentation')
                ->color('gray')
                ->outlined()
                ->icon('heroicon-o-code-bracket')
                ->url('https://filament-kanban-docs-v2.heloufir.dev/', true),
            $this->addAction()
        ];
    }

    protected function tableColumns(): array
    {
        return [
            TextColumn::make('title'),
            TextColumn::make('description')
                ->html()
                ->wrap()
                ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('deadline')
                ->date(),
            TextColumn::make('owner.name'),
            TextColumn::make('status')
                ->formatStateUsing(fn(Status $state) => new HtmlString('
                    <span class="border shadow rounded-lg px-2 py-1 text-sm" style="background-color: ' . $state->color . '">
                        ' . $state->title . '
                    </span>
                ')),
            TextColumn::make('progress')
                ->formatStateUsing(fn(int $state) => new HtmlString('
                    <div class="col-span-8 grid grid-cols-12 items-center gap-2">
                        <div class="col-span-10 rounded h-2 bg-gray-100 dark:bg-gray-500/20">
                            <div class="h-2 bg-green-500 dark:bg-green-700 rounded" style="width: ' . $state . '%;"></div>
                        </div>
                        <span class="col-span-2 text-xs">' . $state . '%</span>
                    </div>
                ')),
            TextColumn::make('sort')
                ->numeric()
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }

    protected function tableActions(): array
    {
        return [
            $this->viewTableAction(),
            $this->editTableAction(),
            $this->deleteTableAction(),
        ];
    }

    protected function tableBulkActions(): array
    {
        return [
            BulkActionGroup::make([
                DeleteBulkAction::make(),
            ])
        ];
    }

    protected function filters(): array
    {
        return [
            SelectFilter::make('status_id')
                ->multiple()
                ->label('Status')
                ->relationship('status', 'title')
                ->preload()
                ->searchable(),
            Filter::make('deadline_from')
                ->label('Deadline from')
                ->form([
                    DatePicker::make('from'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['from'],
                            fn(Builder $query, $date): Builder => $query->whereDate('deadline', '>=', $date),
                        );
                }),
            Filter::make('deadline_to')
                ->label('Deadline until')
                ->form([
                    DatePicker::make('until'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['until'],
                            fn(Builder $query, $date): Builder => $query->whereDate('deadline', '<=', $date),
                        );
                }),
        ];
    }

    protected function tableFiltersLayout(): FiltersLayout
    {
        return FiltersLayout::AboveContent;
    }

    protected function tableShouldPersistFilters(): bool
    {
        return false;
    }
}
