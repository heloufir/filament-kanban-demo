<?php

namespace App\Core;

use App\Enums\EnumStatuses;

class KanbanService
{

    public static function getStatuses(): array
    {
        return [
            ['id' => 1, 'name' => 'Draft', 'color' => 'green', 'draggable' => true],
            ['id' => 2, 'name' => 'Submitted', 'color' => 'blue', 'draggable' => false],
            ['id' => 3, 'name' => 'Changes requested', 'color' => 'orangered', 'draggable' => true],
            ['id' => 4, 'name' => 'Published', 'color' => 'green', 'draggable' => true],
        ];
    }

    public static function getStatusesFromEnums(): array
    {
        $statuses = [];
        foreach (EnumStatuses::cases() as $enumCase) {
            $statuses[] = [
                'id' => $enumCase->name,
                'name' => $enumCase->value,
                'draggable' => true
            ];
        }
        return $statuses;
    }

    public static function getStatusesWithIcons(): array
    {
        return [
            ['id' => 1, 'name' => 'Draft', 'color' => 'green', 'icon' => 'heroicon-o-pencil-square', 'draggable' => true],
            ['id' => 2, 'name' => 'Submitted', 'color' => 'blue', 'icon' => 'heroicon-o-check-circle', 'draggable' => false],
            ['id' => 3, 'name' => 'Changes requested', 'color' => 'orangered', 'icon' => 'heroicon-o-shield-check', 'draggable' => true],
            ['id' => 4, 'name' => 'Published', 'color' => 'green', 'icon' => 'heroicon-o-clipboard-document-check', 'draggable' => true],
        ];
    }

    public static function getStatusesWithUuid(): array
    {
        return [
            ['id' => "6491f95e-4e10-45b0-aad3-24edca3549e1", 'name' => 'Draft', 'color' => 'gray', 'draggable' => true],
            ['id' => "6491f95e-4e10-45b0-aad3-24edca3549e2", 'name' => 'Submitted', 'color' => 'blue', 'draggable' => false],
            ['id' => "6491f95e-4e10-45b0-aad3-24edca3549e3", 'name' => 'Changes requested', 'color' => 'orangered', 'draggable' => true],
            ['id' => "6491f95e-4e10-45b0-aad3-24edca3549e4", 'name' => 'Published', 'color' => 'green', 'draggable' => true],
        ];
    }

    public static function getResources(): array
    {
        return [
            ['id' => 1, 'name' => 'Alex Roe'],
            ['id' => 2, 'name' => 'Taylor Nox', 'avatar' => 'https://robohash.org/4551ed2a34c28d96abdba7cbe1a97141?set=set4&bgset=bg2&size=200x200'],
            ['id' => 3, 'name' => 'Morgan Blake'],
            ['id' => 4, 'name' => 'Jordan Frost', 'avatar' => 'https://ui-avatars.com/api/?background=f97316&color=fff7ed&size=200&name=Jordan Frost'],
            ['id' => 5, 'name' => 'Casey Quinn'],
        ];
    }

    public static function getResourcesWithUuid(): array
    {
        return [
            ['id' => "6491f95e-4e10-45b0-aad3-24edca3549d1", 'name' => 'Alex Roe'],
            ['id' => "6491f95e-4e10-45b0-aad3-24edca3549d2", 'name' => 'Taylor Nox', 'avatar' => 'https://robohash.org/4551ed2a34c28d96abdba7cbe1a97141?set=set4&bgset=bg2&size=200x200'],
            ['id' => "6491f95e-4e10-45b0-aad3-24edca3549d3", 'name' => 'Morgan Blake'],
            ['id' => "6491f95e-4e10-45b0-aad3-24edca3549d4", 'name' => 'Jordan Frost', 'avatar' => 'https://ui-avatars.com/api/?background=f97316&color=fff7ed&size=200&name=Jordan Frost'],
            ['id' => "6491f95e-4e10-45b0-aad3-24edca3549d5", 'name' => 'Casey Quinn'],
        ];
    }

    public static function getRecords(): array
    {
        return [
            ['id' => 1, 'status' => 2, 'title' => 'Record 1 Col 2', 'subtitle' => 'filament-kanban #12', 'sort' => 0, 'draggable' => true, 'click' => true, 'delete' => false, 'progress' => 20, 'owner' => 1, 'assignees' => [2, 3, 4, 5], 'tags' => ['filament', 'kanban']],
            ['id' => 2, 'status' => 3, 'title' => 'Record 1 Col 3', 'subtitle' => 'filament-kanban #13', 'sort' => 0, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 30, 'owner' => 2, 'assignees' => [2], 'deadline' => '2023-12-07', 'tags' => ['laravel', 'filament', 'kanban']],
            ['id' => 3, 'status' => 3, 'title' => 'Record 2 Col 3', 'subtitle' => 'filament-kanban #23', 'sort' => 1, 'draggable' => false, 'click' => true, 'delete' => true, 'owner' => 3, 'assignees' => [3]],
            ['id' => 4, 'status' => 3, 'title' => 'Record 3 Col 3', 'subtitle' => 'filament-kanban #33', 'sort' => 2, 'draggable' => true, 'click' => false, 'delete' => true, 'owner' => 4, 'assignees' => [3, 4], 'deadline' => '2024-02-02', 'tags' => ['web', 'laravel', 'filament']],
            ['id' => 5, 'status' => 3, 'title' => 'Record 4 Col 3', 'subtitle' => 'filament-kanban #43', 'sort' => 3, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 35, 'owner' => 5, 'assignees' => [5], 'tags' => ['web', 'laravel']],
            ['id' => 6, 'status' => 4, 'title' => 'Record 1 Col 4', 'subtitle' => 'filament-kanban #14', 'sort' => 0, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 40, 'owner' => 1, 'assignees' => [4], 'tags' => ['web', 'laravel', 'kanban']],
            ['id' => 7, 'status' => 4, 'title' => 'Record 2 Col 4', 'subtitle' => 'filament-kanban #24', 'sort' => 1, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 50, 'owner' => 2, 'assignees' => [3, 5], 'deadline' => '2023-12-29', 'tags' => ['web']],
            ['id' => 8, 'status' => 4, 'title' => 'Record 3 Col 4', 'subtitle' => 'filament-kanban #34', 'sort' => 2, 'draggable' => true, 'click' => true, 'delete' => true, 'owner' => 3, 'assignees' => [2, 4], 'tags' => []],
            ['id' => 9, 'status' => 4, 'title' => 'Record 4 Col 4', 'subtitle' => 'filament-kanban #44', 'sort' => 3, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 100, 'owner' => 4, 'deadline' => '2023-11-15', 'tags' => []],
            ['id' => 10, 'status' => 4, 'title' => 'Record 5 Col 4', 'subtitle' => 'filament-kanban #54', 'sort' => 4, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 80, 'owner' => 5, 'tags' => ['kanban']],
            ['id' => 11, 'status' => 4, 'title' => 'Record 6 Col 4', 'subtitle' => 'filament-kanban #64', 'sort' => 5, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 75, 'owner' => 1, 'assignees' => [2], 'tags' => ['laravel']],
            ['id' => 12, 'status' => 4, 'title' => 'Record 7 Col 4', 'subtitle' => 'filament-kanban #74', 'sort' => 6, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 90, 'owner' => 3, 'assignees' => [2], 'deadline' => '2023-11-02', 'tags' => ['kanban']],
            ['id' => 13, 'status' => 4, 'title' => 'Record 8 Col 4', 'subtitle' => 'filament-kanban #84', 'sort' => 7, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 85, 'owner' => 4, 'assignees' => [3], 'deadline' => '2023-10-27', 'tags' => ['web', 'laravel', 'filament', 'kanban']],
            ['id' => 14, 'status' => 4, 'title' => 'Record 9 Col 4', 'subtitle' => 'filament-kanban #94', 'sort' => 8, 'draggable' => true, 'click' => true, 'delete' => true, 'owner' => 4, 'assignees' => [1], 'tags' => ['web']],
            ['id' => 15, 'status' => 4, 'title' => 'Record 10 Col 4', 'subtitle' => 'filament-kanban #104', 'sort' => 9, 'draggable' => true, 'click' => true, 'delete' => true, 'owner' => 5, 'assignees' => [1, 2], 'tags' => ['web', 'laravel', 'filament', 'kanban']],
            ['id' => 16, 'status' => 1, 'title' => 'Record 1 Col 1', 'subtitle' => 'filament-kanban #11', 'sort' => 0, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 0, 'owner' => 1, 'assignees' => [3, 4, 5], 'deadline' => '2023-12-02', 'tags' => []],
            ['id' => 17, 'status' => 1, 'title' => 'Record 2 Col 1', 'subtitle' => 'filament-kanban #21', 'sort' => 1, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 10, 'owner' => 2, 'assignees' => [6], 'deadline' => '2023-12-05', 'tags' => ['web']],
        ];
    }

    public static function getRecordsBasedOnEnumStatuses(): array
    {
        return [
            ['id' => 1, 'status' => EnumStatuses::PUBLISHED->name, 'title' => 'Record 1 Col 2', 'subtitle' => 'filament-kanban #12', 'sort' => 0, 'draggable' => true, 'click' => true, 'delete' => false, 'progress' => 20, 'owner' => 1, 'assignees' => [2, 3, 4, 5], 'tags' => ['filament', 'kanban']],
            ['id' => 2, 'status' => EnumStatuses::CHANGES_REQUESTED->name, 'title' => 'Record 1 Col 3', 'subtitle' => 'filament-kanban #13', 'sort' => 0, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 30, 'owner' => 2, 'assignees' => [2], 'deadline' => '2023-12-07', 'tags' => ['laravel', 'filament', 'kanban']],
            ['id' => 3, 'status' => EnumStatuses::CHANGES_REQUESTED->name, 'title' => 'Record 2 Col 3', 'subtitle' => 'filament-kanban #23', 'sort' => 1, 'draggable' => false, 'click' => true, 'delete' => true, 'owner' => 3, 'assignees' => [3]],
            ['id' => 4, 'status' => EnumStatuses::CHANGES_REQUESTED->name, 'title' => 'Record 3 Col 3', 'subtitle' => 'filament-kanban #33', 'sort' => 2, 'draggable' => true, 'click' => false, 'delete' => true, 'owner' => 4, 'assignees' => [3, 4], 'deadline' => '2024-02-02', 'tags' => ['web', 'laravel', 'filament']],
            ['id' => 5, 'status' => EnumStatuses::CHANGES_REQUESTED->name, 'title' => 'Record 4 Col 3', 'subtitle' => 'filament-kanban #43', 'sort' => 3, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 35, 'owner' => 5, 'assignees' => [5], 'tags' => ['web', 'laravel']],
            ['id' => 6, 'status' => EnumStatuses::SUBMITTED->name, 'title' => 'Record 1 Col 4', 'subtitle' => 'filament-kanban #14', 'sort' => 0, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 40, 'owner' => 1, 'assignees' => [4], 'tags' => ['web', 'laravel', 'kanban']],
            ['id' => 7, 'status' => EnumStatuses::SUBMITTED->name, 'title' => 'Record 2 Col 4', 'subtitle' => 'filament-kanban #24', 'sort' => 1, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 50, 'owner' => 2, 'assignees' => [3, 5], 'deadline' => '2023-12-29', 'tags' => ['web']],
            ['id' => 8, 'status' => EnumStatuses::SUBMITTED->name, 'title' => 'Record 3 Col 4', 'subtitle' => 'filament-kanban #34', 'sort' => 2, 'draggable' => true, 'click' => true, 'delete' => true, 'owner' => 3, 'assignees' => [2, 4], 'tags' => []],
            ['id' => 9, 'status' => EnumStatuses::SUBMITTED->name, 'title' => 'Record 4 Col 4', 'subtitle' => 'filament-kanban #44', 'sort' => 3, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 100, 'owner' => 4, 'deadline' => '2023-11-15', 'tags' => []],
            ['id' => 10, 'status' => EnumStatuses::SUBMITTED->name, 'title' => 'Record 5 Col 4', 'subtitle' => 'filament-kanban #54', 'sort' => 4, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 80, 'owner' => 5, 'tags' => ['kanban']],
            ['id' => 11, 'status' => EnumStatuses::SUBMITTED->name, 'title' => 'Record 6 Col 4', 'subtitle' => 'filament-kanban #64', 'sort' => 5, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 75, 'owner' => 1, 'assignees' => [2], 'tags' => ['laravel']],
            ['id' => 12, 'status' => EnumStatuses::SUBMITTED->name, 'title' => 'Record 7 Col 4', 'subtitle' => 'filament-kanban #74', 'sort' => 6, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 90, 'owner' => 3, 'assignees' => [2], 'deadline' => '2023-11-02', 'tags' => ['kanban']],
            ['id' => 13, 'status' => EnumStatuses::ARCHIVED->name, 'title' => 'Record 8 Col 4', 'subtitle' => 'filament-kanban #84', 'sort' => 7, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 85, 'owner' => 4, 'assignees' => [3], 'deadline' => '2023-10-27', 'tags' => ['web', 'laravel', 'filament', 'kanban']],
            ['id' => 14, 'status' => EnumStatuses::ARCHIVED->name, 'title' => 'Record 9 Col 4', 'subtitle' => 'filament-kanban #94', 'sort' => 8, 'draggable' => true, 'click' => true, 'delete' => true, 'owner' => 4, 'assignees' => [1], 'tags' => ['web']],
            ['id' => 15, 'status' => EnumStatuses::ARCHIVED->name, 'title' => 'Record 10 Col 4', 'subtitle' => 'filament-kanban #104', 'sort' => 9, 'draggable' => true, 'click' => true, 'delete' => true, 'owner' => 5, 'assignees' => [1, 2], 'tags' => ['web', 'laravel', 'filament', 'kanban']],
            ['id' => 16, 'status' => EnumStatuses::DRAFT->name, 'title' => 'Record 1 Col 1', 'subtitle' => 'filament-kanban #11', 'sort' => 0, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 0, 'owner' => 1, 'assignees' => [3, 4, 5], 'deadline' => '2023-12-02', 'tags' => []],
            ['id' => 17, 'status' => EnumStatuses::DRAFT->name, 'title' => 'Record 2 Col 1', 'subtitle' => 'filament-kanban #21', 'sort' => 1, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 10, 'owner' => 2, 'assignees' => [6], 'deadline' => '2023-12-05', 'tags' => ['web']],
        ];
    }

    public static function getRecordsWithExtra(): array
    {
        return [
            ['id' => 1, 'status' => 2, 'title' => 'Record 1 Col 2', 'subtitle' => 'filament-kanban #12', 'sort' => 0, 'draggable' => true, 'click' => true, 'delete' => false, 'progress' => 20, 'owner' => 1, 'assignees' => [2, 3, 4, 5], 'tags' => ['filament', 'kanban'], 'extra_1' => 'Extra value 1', 'extra_2' => 'Extra value 2', 'extra_3' => true],
            ['id' => 2, 'status' => 3, 'title' => 'Record 1 Col 3', 'subtitle' => 'filament-kanban #13', 'sort' => 0, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 30, 'owner' => 2, 'assignees' => [2], 'deadline' => '2023-12-07', 'tags' => ['laravel', 'filament', 'kanban'], 'extra_1' => 'Extra value 1', 'extra_2' => 'Extra value 2', 'extra_3' => true],
            ['id' => 3, 'status' => 3, 'title' => 'Record 2 Col 3', 'subtitle' => 'filament-kanban #23', 'sort' => 1, 'draggable' => false, 'click' => true, 'delete' => true, 'owner' => 3, 'assignees' => [3], 'tags' => [], 'extra_1' => 'Extra value 1', 'extra_2' => 'Extra value 2', 'extra_3' => true],
            ['id' => 4, 'status' => 3, 'title' => 'Record 3 Col 3', 'subtitle' => 'filament-kanban #33', 'sort' => 2, 'draggable' => true, 'click' => false, 'delete' => true, 'owner' => 4, 'assignees' => [3, 4], 'deadline' => '2024-02-02', 'tags' => ['web', 'laravel', 'filament'], 'extra_1' => 'Extra value 1', 'extra_2' => 'Extra value 2', 'extra_3' => true],
            ['id' => 5, 'status' => 3, 'title' => 'Record 4 Col 3', 'subtitle' => 'filament-kanban #43', 'sort' => 3, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 35, 'owner' => 5, 'assignees' => [5], 'tags' => ['web', 'laravel'], 'extra_1' => 'Extra value 1', 'extra_2' => 'Extra value 2', 'extra_3' => true],
            ['id' => 6, 'status' => 4, 'title' => 'Record 1 Col 4', 'subtitle' => 'filament-kanban #14', 'sort' => 0, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 40, 'owner' => 1, 'assignees' => [4], 'tags' => ['web', 'laravel', 'kanban'], 'extra_1' => 'Extra value 1', 'extra_2' => 'Extra value 2', 'extra_3' => true],
            ['id' => 7, 'status' => 4, 'title' => 'Record 2 Col 4', 'subtitle' => 'filament-kanban #24', 'sort' => 1, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 50, 'owner' => 2, 'assignees' => [3, 5], 'deadline' => '2023-12-29', 'tags' => ['web'], 'extra_1' => 'Extra value 1', 'extra_2' => 'Extra value 2', 'extra_3' => true],
            ['id' => 8, 'status' => 4, 'title' => 'Record 3 Col 4', 'subtitle' => 'filament-kanban #34', 'sort' => 2, 'draggable' => true, 'click' => true, 'delete' => true, 'owner' => 3, 'assignees' => [2, 4], 'tags' => [], 'extra_1' => 'Extra value 1', 'extra_2' => 'Extra value 2', 'extra_3' => true],
            ['id' => 9, 'status' => 4, 'title' => 'Record 4 Col 4', 'subtitle' => 'filament-kanban #44', 'sort' => 3, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 100, 'owner' => 4, 'deadline' => '2023-11-15', 'extra_1' => 'Extra value 1', 'extra_2' => 'Extra value 2', 'extra_3' => true],
            ['id' => 10, 'status' => 4, 'title' => 'Record 5 Col 4', 'subtitle' => 'filament-kanban #54', 'sort' => 4, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 80, 'owner' => 5, 'tags' => ['kanban'], 'extra_1' => 'Extra value 1', 'extra_2' => 'Extra value 2', 'extra_3' => true],
            ['id' => 11, 'status' => 4, 'title' => 'Record 6 Col 4', 'subtitle' => 'filament-kanban #64', 'sort' => 5, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 75, 'owner' => 1, 'assignees' => [2], 'tags' => ['laravel'], 'extra_1' => 'Extra value 1', 'extra_2' => 'Extra value 2', 'extra_3' => true],
            ['id' => 12, 'status' => 4, 'title' => 'Record 7 Col 4', 'subtitle' => 'filament-kanban #74', 'sort' => 6, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 90, 'owner' => 3, 'assignees' => [2], 'deadline' => '2023-11-02', 'tags' => ['kanban'], 'extra_1' => 'Extra value 1', 'extra_2' => 'Extra value 2', 'extra_3' => true],
            ['id' => 13, 'status' => 4, 'title' => 'Record 8 Col 4', 'subtitle' => 'filament-kanban #84', 'sort' => 7, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 85, 'owner' => 4, 'assignees' => [3], 'deadline' => '2023-10-27', 'tags' => ['web', 'laravel', 'filament', 'kanban'], 'extra_1' => 'Extra value 1', 'extra_2' => 'Extra value 2', 'extra_3' => true],
            ['id' => 14, 'status' => 4, 'title' => 'Record 9 Col 4', 'subtitle' => 'filament-kanban #94', 'sort' => 8, 'draggable' => true, 'click' => true, 'delete' => true, 'owner' => 4, 'assignees' => [1], 'tags' => ['web'], 'extra_1' => 'Extra value 1', 'extra_2' => 'Extra value 2', 'extra_3' => true],
            ['id' => 15, 'status' => 4, 'title' => 'Record 10 Col 4', 'subtitle' => 'filament-kanban #104', 'sort' => 9, 'draggable' => true, 'click' => true, 'delete' => true, 'owner' => 5, 'assignees' => [1, 2], 'tags' => ['web', 'laravel', 'filament', 'kanban'], 'extra_1' => 'Extra value 1', 'extra_2' => 'Extra value 2', 'extra_3' => true],
            ['id' => 16, 'status' => 1, 'title' => 'Record 1 Col 1', 'subtitle' => 'filament-kanban #11', 'sort' => 0, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 0, 'owner' => 1, 'assignees' => [3, 4, 5], 'deadline' => '2023-12-02', 'tags' => [], 'extra_1' => 'Extra value 1', 'extra_2' => 'Extra value 2', 'extra_3' => false],
            ['id' => 17, 'status' => 1, 'title' => 'Record 2 Col 1', 'subtitle' => 'filament-kanban #21', 'sort' => 1, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 10, 'owner' => 2, 'assignees' => [6], 'deadline' => '2023-12-05', 'tags' => ['web'], 'extra_1' => 'Extra value 1', 'extra_2' => 'Extra value 2', 'extra_3' => true],
        ];
    }

    public static function getRecordsWithUuid(): array
    {
        return [
            ['id' => "6491f95e-4e10-45b0-aad3-24edca3549f1", 'status' => "6491f95e-4e10-45b0-aad3-24edca3549e2", 'title' => 'Record 1 Col 2', 'subtitle' => 'filament-kanban #12', 'sort' => 0, 'draggable' => true, 'click' => true, 'delete' => false, 'progress' => 20, 'owner' => "6491f95e-4e10-45b0-aad3-24edca3549d1", 'assignees' => ["6491f95e-4e10-45b0-aad3-24edca3549d2", "6491f95e-4e10-45b0-aad3-24edca3549d3", "6491f95e-4e10-45b0-aad3-24edca3549d4", "6491f95e-4e10-45b0-aad3-24edca3549d5"], 'tags' => ['filament', 'kanban']],
            ['id' => "6491f95e-4e10-45b0-aad3-24edca3549f2", 'status' => "6491f95e-4e10-45b0-aad3-24edca3549e3", 'title' => 'Record 1 Col 3', 'subtitle' => 'filament-kanban #13', 'sort' => 0, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 30, 'owner' => "6491f95e-4e10-45b0-aad3-24edca3549d2", 'assignees' => ["6491f95e-4e10-45b0-aad3-24edca3549d2"], 'deadline' => '2023-12-07', 'tags' => ['laravel', 'filament', 'kanban']],
            ['id' => "6491f95e-4e10-45b0-aad3-24edca3549f3", 'status' => "6491f95e-4e10-45b0-aad3-24edca3549e3", 'title' => 'Record 2 Col 3', 'subtitle' => 'filament-kanban #23', 'sort' => 1, 'draggable' => false, 'click' => true, 'delete' => true, 'owner' => "6491f95e-4e10-45b0-aad3-24edca3549d3", 'assignees' => ["6491f95e-4e10-45b0-aad3-24edca3549d3"]],
            ['id' => "6491f95e-4e10-45b0-aad3-24edca3549f4", 'status' => "6491f95e-4e10-45b0-aad3-24edca3549e3", 'title' => 'Record 3 Col 3', 'subtitle' => 'filament-kanban #33', 'sort' => 2, 'draggable' => true, 'click' => false, 'delete' => true, 'owner' => "6491f95e-4e10-45b0-aad3-24edca3549d4", 'assignees' => ["6491f95e-4e10-45b0-aad3-24edca3549d3", "6491f95e-4e10-45b0-aad3-24edca3549d4"], 'deadline' => '2024-02-02', 'tags' => ['web', 'laravel', 'filament']],
            ['id' => "6491f95e-4e10-45b0-aad3-24edca3549f5", 'status' => "6491f95e-4e10-45b0-aad3-24edca3549e3", 'title' => 'Record 4 Col 3', 'subtitle' => 'filament-kanban #43', 'sort' => 3, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 35, 'owner' => "6491f95e-4e10-45b0-aad3-24edca3549d5", 'assignees' => ["6491f95e-4e10-45b0-aad3-24edca3549d5"], 'tags' => ['web', 'laravel']],
            ['id' => "6491f95e-4e10-45b0-aad3-24edca3549f6", 'status' => "6491f95e-4e10-45b0-aad3-24edca3549e4", 'title' => 'Record 1 Col 4', 'subtitle' => 'filament-kanban #14', 'sort' => 0, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 40, 'owner' => "6491f95e-4e10-45b0-aad3-24edca3549d1", 'assignees' => ["6491f95e-4e10-45b0-aad3-24edca3549d4"], 'tags' => ['web', 'laravel', 'kanban']],
            ['id' => "6491f95e-4e10-45b0-aad3-24edca3549f7", 'status' => "6491f95e-4e10-45b0-aad3-24edca3549e4", 'title' => 'Record 2 Col 4', 'subtitle' => 'filament-kanban #24', 'sort' => 1, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 50, 'owner' => "6491f95e-4e10-45b0-aad3-24edca3549d2", 'assignees' => ["6491f95e-4e10-45b0-aad3-24edca3549d4", "6491f95e-4e10-45b0-aad3-24edca3549d5"], 'deadline' => '2023-12-29', 'tags' => ['web']],
            ['id' => "6491f95e-4e10-45b0-aad3-24edca3549f8", 'status' => "6491f95e-4e10-45b0-aad3-24edca3549e4", 'title' => 'Record 3 Col 4', 'subtitle' => 'filament-kanban #34', 'sort' => 2, 'draggable' => true, 'click' => true, 'delete' => true, 'owner' => "6491f95e-4e10-45b0-aad3-24edca3549d3", 'assignees' => ["6491f95e-4e10-45b0-aad3-24edca3549d2", "6491f95e-4e10-45b0-aad3-24edca3549d4"], 'tags' => []],
            ['id' => "6491f95e-4e10-45b0-aad3-24edca3549f9", 'status' => "6491f95e-4e10-45b0-aad3-24edca3549e4", 'title' => 'Record 4 Col 4', 'subtitle' => 'filament-kanban #44', 'sort' => 3, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 100, 'owner' => "6491f95e-4e10-45b0-aad3-24edca3549d4", 'deadline' => '2023-11-15', 'tags' => []],
            ['id' => "6491f95e-4e10-45b0-aad3-24edca3549g1", 'status' => "6491f95e-4e10-45b0-aad3-24edca3549e4", 'title' => 'Record 5 Col 4', 'subtitle' => 'filament-kanban #54', 'sort' => 4, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 80, 'owner' => "6491f95e-4e10-45b0-aad3-24edca3549d5", 'tags' => ['kanban']],
            ['id' => "6491f95e-4e10-45b0-aad3-24edca3549g2", 'status' => "6491f95e-4e10-45b0-aad3-24edca3549e4", 'title' => 'Record 6 Col 4', 'subtitle' => 'filament-kanban #64', 'sort' => 5, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 75, 'owner' => "6491f95e-4e10-45b0-aad3-24edca3549d1", 'assignees' => ["6491f95e-4e10-45b0-aad3-24edca3549d2"], 'tags' => ['laravel']],
            ['id' => "6491f95e-4e10-45b0-aad3-24edca3549g3", 'status' => "6491f95e-4e10-45b0-aad3-24edca3549e4", 'title' => 'Record 7 Col 4', 'subtitle' => 'filament-kanban #74', 'sort' => 6, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 90, 'owner' => "6491f95e-4e10-45b0-aad3-24edca3549d3", 'assignees' => ["6491f95e-4e10-45b0-aad3-24edca3549d2"], 'deadline' => '2023-11-02', 'tags' => ['kanban']],
            ['id' => "6491f95e-4e10-45b0-aad3-24edca3549g4", 'status' => "6491f95e-4e10-45b0-aad3-24edca3549e4", 'title' => 'Record 8 Col 4', 'subtitle' => 'filament-kanban #84', 'sort' => 7, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 85, 'owner' => "6491f95e-4e10-45b0-aad3-24edca3549d4", 'assignees' => ["6491f95e-4e10-45b0-aad3-24edca3549d3"], 'deadline' => '2023-10-27', 'tags' => ['web', 'laravel', 'filament', 'kanban']],
            ['id' => "6491f95e-4e10-45b0-aad3-24edca3549g5", 'status' => "6491f95e-4e10-45b0-aad3-24edca3549e4", 'title' => 'Record 9 Col 4', 'subtitle' => 'filament-kanban #94', 'sort' => 8, 'draggable' => true, 'click' => true, 'delete' => true, 'owner' => "6491f95e-4e10-45b0-aad3-24edca3549d4", 'assignees' => ["6491f95e-4e10-45b0-aad3-24edca3549d1"], 'tags' => ['web']],
            ['id' => "6491f95e-4e10-45b0-aad3-24edca3549g6", 'status' => "6491f95e-4e10-45b0-aad3-24edca3549e4", 'title' => 'Record 10 Col 4', 'subtitle' => 'filament-kanban #104', 'sort' => 9, 'draggable' => true, 'click' => true, 'delete' => true, 'owner' => "6491f95e-4e10-45b0-aad3-24edca3549d5", 'assignees' => ["6491f95e-4e10-45b0-aad3-24edca3549d1", "6491f95e-4e10-45b0-aad3-24edca3549d2"], 'tags' => ['web', 'laravel', 'filament', 'kanban']],
            ['id' => "6491f95e-4e10-45b0-aad3-24edca3549g7", 'status' => "6491f95e-4e10-45b0-aad3-24edca3549e1", 'title' => 'Record 1 Col 1', 'subtitle' => 'filament-kanban #11', 'sort' => 0, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 0, 'owner' => "6491f95e-4e10-45b0-aad3-24edca3549d1", 'assignees' => ["6491f95e-4e10-45b0-aad3-24edca3549d3", "6491f95e-4e10-45b0-aad3-24edca3549d4", "6491f95e-4e10-45b0-aad3-24edca3549d5"], 'deadline' => '2023-12-02', 'tags' => []],
            ['id' => "6491f95e-4e10-45b0-aad3-24edca3549g8", 'status' => "6491f95e-4e10-45b0-aad3-24edca3549e1", 'title' => 'Record 2 Col 1', 'subtitle' => 'filament-kanban #21', 'sort' => 1, 'draggable' => true, 'click' => true, 'delete' => true, 'progress' => 10, 'owner' => "6491f95e-4e10-45b0-aad3-24edca3549d2", 'assignees' => ["6491f95e-4e10-45b0-aad3-24edca3549d6"], 'deadline' => '2023-12-05', 'tags' => ['web']],
        ];
    }

}
