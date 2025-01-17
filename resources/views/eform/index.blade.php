<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Form Pemohon') }}
        </h2>
    </x-slot>

    <x-card>
        <a href="{{ route('eform.create') }}" class="bg-sky-500 dark:bg-sky-700 hover:bg-sky-700 dark:hover:bg-sky-500 text-white font-bold py-2 px-4 rounded">TAMBAH
            DATA</a>
        <a href="{{ route('pemohons.export.excel') }}" class="bg-green-500 dark:bg-green-700 hover:bg-green-700 dark:hover:bg-green-500 text-white font-bold py-2 px-4 rounded">EXPORT EXCEL</a>
        <a href="{{ route('pemohons.export.pdf') }}" class="bg-red-500 dark:bg-red-700 hover:bg-red-700 dark:hover:bg-red-500 text-white font-bold py-2 px-4 rounded">EXPORT PDF</a>
        <div class="overflow-x-auto my-5">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">No. </th>
                        <th scope="col" class="px-6 py-3">Nama</th>
                        <th scope="col" class="px-6 py-3">Divisi</th>
                        <th scope="col" class="px-6 py-3">Grup</th>
                        <th scope="col" class="px-6 py-3">Waktu mulai</th>
                        <th scope="col" class="px-6 py-3">Waktu selesai</th>
                        <th scope="col" class="px-6 py-3" style="width: 20%">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pemohons as $p)
                    <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700">
                        <td class="px-6 py-4">{{ $loop->index + 1 }}</td>
                        <!-- mencetak nomor urut -->
                        <td class="px-6 py-4">{{ $p->nama }}</td>
                        <td class="px-6 py-4">{{ $p->divisi }}</td>
                        <td class="px-6 py-4">{{ $p->grup }}</td>
                        <td class="px-6 py-4">{{ $p->mulai }}</td>
                        <td class="px-6 py-4">{{ $p->sampai }}</td>
                        <td class="px-6 py-4 text-center">
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('eform.destroy', $p->id) }}" method="POST">
                                <a href="{{ route('eform.show', $p->id) }}" class="m-2 inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">SHOW</a>
                                @csrf
                                @method('DELETE')
                                <x-danger-button>
                                    HAPUS
                                </x-danger-button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <div class="mb-5 text-red-600 dark:text-red-100 bg-red-100 dark:bg-red-800 border border-red-300 rounded py-2 px-4">
                        Data pemohon belum Tersedia.
                    </div>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $pemohons->links() }}
    </x-card>
</x-app-layout>