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
use Heloufir\FilamentKanban\enums\KanbanView;
use Heloufir\FilamentKanban\Filament\KanbanBoard;
use Heloufir\FilamentKanban\ValueObjects\KanbanStatuses;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;

class KanbanV2 extends KanbanBoard
{
    protected static ?string $navigationIcon = 'heroicon-o-view-columns';

    protected static ?string $slug = 'v2/board';

    protected static ?string $navigationGroup = 'Version 2';

    protected static ?string $title = 'Kanban Board';

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
            Action::make('source')
                ->color('gray')
                ->icon('heroicon-m-code-bracket')
                ->label('View on Github')
                ->url('https://github.com/heloufir/filament-kanban-demo/blob/main/KanbanV2.php'),
            Action::make('docs')
                ->label('Documentation')
                ->color('gray')
                ->outlined()
                ->icon('heroicon-o-document')
                ->url('https://filament-kanban-docs-v2.heloufir.dev/', true),
            $this->addAction()
        ];
    }
}
