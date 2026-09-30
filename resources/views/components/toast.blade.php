@props(['duration' => 4000])

@php
    $initial = collect(['success', 'error', 'warning', 'info'])
        ->filter(fn ($type) => session()->has($type))
        ->map(fn ($type) => ['type' => $type, 'message' => session($type)])
        ->values();

    if ($errors->any()) {
        $initial->push(['type' => 'error', 'message' => 'Periksa kembali isian Anda.']);
    }
@endphp

<div
    x-data="{
        toasts: @js($initial).map((t, i) => ({ ...t, id: i })),
        next: 100,
        styles: {
            success: 'bg-green-600',
            error: 'bg-red-600',
            warning: 'bg-yellow-500',
            info: 'bg-blue-600',
        },
        add(t) {
            const id = this.next++;
            this.toasts.push({ type: 'info', ...t, id });
            setTimeout(() => this.remove(id), {{ $duration }});
        },
        remove(id) {
            this.toasts = this.toasts.filter(t => t.id !== id);
        },
    }"
    x-init="toasts.forEach(t => setTimeout(() => remove(t.id), {{ $duration }}))"
    @toast.window="add($event.detail)"
    class="pointer-events-none fixed right-4 top-4 z-50 w-80 space-y-2"
    aria-live="polite"
>
    <template x-for="t in toasts" :key="t.id">
        <div
            class="pointer-events-auto flex items-start gap-3 rounded-lg px-4 py-3 text-sm text-white shadow-lg"
            :class="styles[t.type] ?? styles.info"
            role="status"
        >
            <span class="flex-1" x-text="t.message"></span>
            <button type="button" @click="remove(t.id)" aria-label="Tutup" class="leading-none">&times;</button>
        </div>
    </template>
</div>