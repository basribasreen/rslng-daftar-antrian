<div class="overflow-hidden w-full overflow-x-auto rounded-radius border border-outline dark:border-outline-dark bg-white p-4 shadow">
    <table class="w-full text-left text-sm text-on-surface dark:text-on-surface-dark">
        <thead class="border-b border-outline bg-surface-alt text-sm text-on-surface-strong dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark-strong">
            <tr>
                <th scope="col" class="p-4">Kode</th>
                <th scope="col" class="p-4">Nomor Antrian</th>
                <th scope="col" class="p-4">Pasien</th>
                <th scope="col" class="p-4">Poli</th>
                <th scope="col" class="p-4">Dokter</th>
                <th scope="col" class="p-4">Jenis</th>
                <th scope="col" class="p-4">Tanggal</th>
                <th scope="col" class="p-4">Status</th>
                <th scope="col" class="p-4">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-outline dark:divide-outline-dark">
            @forelse ($data as $item)
                <tr>
                    <td class="p-4">{{$item->kode}}</td>
                    <td class="p-4">{{$item->nomor_antrian}}</td>
                    <td class="p-4">
                        <div class="flex w-max items-center gap-2">
                            <span class="flex size-14 items-center justify-center overflow-hidden rounded-full border border-outline bg-surface-alt text-on-surface/50 dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark/50">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" fill="currentColor"  class="w-full h-full mt-3">
                                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd"/>
                                </svg>
                            </span>
                            <div class="flex flex-col">
                                <span class="text-neutral-900 dark:text-white">{{$item->pasien->nama}}</span>
                                <span class="text-sm text-neutral-600 opacity-85 dark:text-neutral-300">{{$item->pasien->kode}}</span>
                            </div>
                        </div>
                    </td>
                    <td class="p-4">{{$item->poli->nama}}</td>
                    <td class="p-4">{{$item->dokter->nama}}</td>
                    <td class="p-4">{{$item->jenisPembayaran->nama}}</td>
                    <td class="p-4">{{$item->tanggal->format('d-m-Y')}}</td>
                    <td class="p-4">
                        <span class="w-fit inline-flex overflow-hidden rounded-lg border border-blue-700 bg-white text-xs font-medium text-blue-700 dark:border-blue-600 dark:bg-slate-900 dark:text-blue-600">
                            <span class="flex items-center gap-1 bg-blue-700/10 px-2 py-1 dark:bg-blue-600/10">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" fill="currentColor"  class="size-3">
                                    <path fill-rule="evenodd" d="M11.097 1.515a.75.75 0 01.589.882L10.666 7.5h4.47l1.079-5.397a.75.75 0 111.47.294L16.665 7.5h3.585a.75.75 0 010 1.5h-3.885l-1.2 6h3.585a.75.75 0 010 1.5h-3.885l-1.08 5.397a.75.75 0 11-1.47-.294l1.02-5.103h-4.47l-1.08 5.397a.75.75 0 01-1.47-.294l1.02-5.103H3.75a.75.75 0 110-1.5h3.885l1.2-6H5.25a.75.75 0 010-1.5h3.885l1.08-5.397a.75.75 0 01.882-.588zM10.365 9l-1.2 6h4.47l1.2-6h-4.47z" clip-rule="evenodd"/>
                                </svg>
                                {{$item->status}}
                            </span>
                        </span>
                    </td>
                    <td class="p-4">
                        <div class="flex gap-2 text-sm">
                            <a href="{{ route('pendaftarans.edit', $item) }}" class="text-blue-600">Edit</a>
                            <form action="{{ route('pendaftarans.destroy', $item) }}" method="POST"
                                onsubmit="return confirm('Hapus Data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="p-4"><p class="text-gray-500">Belum ada Data Pendaftaran.</p></td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
