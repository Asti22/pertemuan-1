<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Halaman About') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6 border-b pb-2">Biodata Diri</h3>
                    <table class="table-auto w-full text-lg">
                        <tr class="h-10">
                            <td class="font-medium w-40">Nama</td>
                            <td>: {{ $nama }}</td>
                        </tr>
                        <tr class="h-10">
                            <td class="font-medium">NIM</td>
                            <td>: {{ $nim }}</td>
                        </tr>
                        <tr class="h-10">
                            <td class="font-medium">Program Studi</td>
                            <td>: {{ $prodi }}</td>
                        </tr>
                        <tr class="h-10">
                            <td class="font-medium">Hobi</td>
                            <td>: {{ $hobi }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>