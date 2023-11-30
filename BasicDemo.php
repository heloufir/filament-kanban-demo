<?php

namespace App\Filament\Pages;

use App\Core\KanbanService;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Heloufir\FilamentKanban\Livewire\Kanban;

class BasicDemo extends Kanban
{
    protected static ?string $navigationIcon = 'heroicon-o-rocket-launch';

    protected static bool $handleRecordClickWithModal = true;

    protected static bool $enableCreateAction = true;

    protected static ?string $slug = 'basic-demo';

    protected static ?string $title = 'Basic Demo';

    protected $listeners = [
        'filament-kanban.record-sorted' => 'recordSorted',
        'filament-kanban.record-dragged' => 'recordDragged',
    ];

    public function mount(): void
    {
        $this->setStatuses(KanbanService::getStatuses());
        $this->setRecords(KanbanService::getRecords());
        $this->setResources(KanbanService::getResources());
    }

    protected function getActions(): array
    {
        return array_merge([
            Action::make('source')
                ->color('gray')
                ->icon('heroicon-m-code-bracket')
                ->label('View on Github')
                ->url('https://github.com/heloufir/filament-kanban-demo/blob/main/BasicDemo.php')
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
        if (isset($this->record['tags'])) {
            $this->record['tags'] = explode(',', $this->record['tags']);
        }
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
}
