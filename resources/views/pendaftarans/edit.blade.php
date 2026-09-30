<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold">Edit Pendaftaran</h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-3">
                <form action="{{ route('pendaftarans.update', $pendaftaran) }}" method="POST" class="rounded bg-white p-6 shadow">
                    @csrf
                    @method('PUT')
                    @include('pendaftarans._form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>