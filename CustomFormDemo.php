<?php

namespace App\Filament\Pages;

use App\Core\KanbanService;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Heloufir\FilamentKanban\Livewire\Kanban;

class CustomFormDemo extends Kanban
{
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static bool $handleRecordClickWithModal = true;

    protected static bool $enableCreateAction = true;

    public bool $showFilters = true;

    protected static ?string $slug = 'custom-form-demo';

    protected static ?string $title = 'Custom Form Demo';

    protected $listeners = [
        'filament-kanban.record-sorted' => 'recordSorted',
        'filament-kanban.record-dragged' => 'recordDragged',
        'filament-kanban.filter' => 'filter',
        'filament-kanban.reset-filter' => 'resetFilter',
        'filament-kanban.record-deleted' => 'recordDeleted',
    ];

    public function mount(): void
    {
        $this->setStatuses(KanbanService::getStatuses());
        $this->setRecords(KanbanService::getRecordsWithExtra());
        $this->setResources(KanbanService::getResources());
    }

    protected function getActions(): array
    {
        return array_merge([
            Action::make('source')
                ->color('gray')
                ->icon('heroicon-m-code-bracket')
                ->label('View on Github')
                ->url('https://github.com/heloufir/filament-kanban-demo/blob/main/CustomFormDemo.php')
        ], Parent::getActions());
    }

    protected function showProgress(): bool|array
    {
        return true;
    }

    public function submitRecord(): void
    {
        // Get record id
        $id = $this->record['id'] ?? null;

        // Formatting record fields
        $this->record['status'] = intval($this->record['status']);

        // Update record or add it to the records array
        if ($id && $index = $this->recordIndexById($id)) {
            $this->records[$index] = $this->record;
        } else {
            // Add an id
            $this->record['id'] = sizeof($this->records) + 1;

            // Add default sort
            $this->record['sort'] = sizeof($this->recordsByStatus($this->record['status']));

            // Push the record to the records array
            $this->records[] = $this->record;
        }

        // Show a notification
        Notification::make(($id ? 'updated' : 'created'))
            ->success()
            ->title('Saved')
            ->body('Record ' . ($id ? 'updated' : 'created') . ' successfully!')
            ->send();

        // Close the modal
        $this->dispatch('close-modal', id: 'filament-kanban.record-modal');
    }

    public function recordSorted(array $event): void
    {
        // Show a notification
        Notification::make('sorted')
            ->success()
            ->title('Sorted')
            ->body('Record sorted successfully!')
            ->send();
    }

    public function recordDragged(array $event): void
    {
        // Show a notification
        Notification::make('dragged')
            ->success()
            ->title('Dragged')
            ->body('Record dragged successfully!')
            ->send();
    }

    public function filter(array $data): void
    {
        $records = collect(KanbanService::getRecords());
        $this->records = $records->filter(function ($item) use ($data) {
            // Deadline
            $filterDeadline = !isset($data['deadline']);
            if (($data['deadline'] ?? null) && ($item['deadline'] ?? null)) {
                $itemDate = $this->deadlineDate($item['deadline']);
                $date = $this->deadlineDate($data['deadline']);
                $filterDeadline = $itemDate->gte($date);
            }
            if (!$filterDeadline) return false;

            // Title
            $filterTitle = !isset($data['title']);
            if (($data['title'] ?? null)) {
                $filterTitle = stripos(strtolower($item['title']), strtolower($data['title'])) !== false;
            }
            if (!$filterTitle) return false;

            // Subtitle
            $filterSubtitle = !isset($data['subtitle']);
            if (($data['subtitle'] ?? null)) {
                $filterSubtitle = stripos(strtolower($item['subtitle']), strtolower($data['subtitle'])) !== false;
            }
            if (!$filterSubtitle) return false;

            // Owner
            $filterOwner = !isset($data['owner']);
            if (($data['owner'] ?? null) && ($item['owner'] ?? null)) {
                $filterOwner = $item['owner'] == $data['owner'];
            }
            if (!$filterOwner) return false;

            // Assignees
            $filterAssignees = !isset($data['assignees']);
            if (($data['assignees'] ?? null) && ($item['assignees'] ?? null)) {
                $filterAssignees = in_array($data['assignees'], $item['assignees']);
            }
            if (!$filterAssignees) return false;

            // Tags
            $filterTags = !isset($data['tags']);
            if (($data['tags'] ?? null) && ($item['tags'] ?? null)) {
                $tags = explode(',', strtolower($data['tags']));
                $itemTags = array_map('strtolower', $item['tags']);
                $filterTags = sizeof(array_intersect($tags, $itemTags)) > 0;
            }
            if (!$filterTags) return false;

            return true;
        })->toArray();
    }

    public function resetFilter(): void
    {
        $this->records = collect(KanbanService::getRecords())->toArray();
    }

    public function recordDeleted(array $record): void
    {
        if (isset($record['id']) && $index = $this->recordIndexById($record['id'])) {
            unset($this->records[$index]);
        }
    }

    public function form(Form $form): Form
    {
        // IMPORTANT!! Make sure to add the 'record.' prefix to your custom fields
        return $form->schema([
            TextInput::make('record.title')
                ->label(__('filament-kanban::filament-kanban.modal.form.title'))
                ->required(),

            TextInput::make('record.subtitle')
                ->label(__('filament-kanban::filament-kanban.modal.form.subtitle'))
                ->required(),

            TextInput::make('record.extra_1')
                ->label('Extra input 1'),

            TextInput::make('record.extra_2')
                ->label('Extra input 2')
                ->helperText('An extra input added by overriding the "form" method'),
        ]);
    }
}
