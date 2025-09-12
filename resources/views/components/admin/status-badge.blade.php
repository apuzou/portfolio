@props(['status'])

@php
    $colors = [
        'unread' => 'bg-yellow-100 text-yellow-800',
        'read' => 'bg-blue-100 text-blue-800',
        'replied' => 'bg-green-100 text-green-800',
        'archived' => 'bg-gray-100 text-gray-800',
    ];

    $labels = [
        'unread' => '未読',
        'read' => '既読',
        'replied' => '返信済み',
        'archived' => 'アーカイブ',
    ];

    $colorClass = $colors[$status] ?? 'bg-gray-100 text-gray-800';
    $label = $labels[$status] ?? '不明';
@endphp

<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $colorClass }}">
    {{ $label }}
</span>
