@if($type === 'edit')
    {{-- Ganti amber-600 jadi indigo-600 atau blue-600 sesuai selera --}}
    <a href="{{ $url }}" class="p-1.5 rounded-md text-indigo-600 hover:text-indigo-900 hover:bg-indigo-50 dark:text-indigo-400 dark:hover:bg-indigo-900/30 transition" title="Edit">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.172-2.828L12 11.172l4.828-4.828a2 2 0 012.828 0l2 2a2 2 0 010 2.828l-7.586 7.586a2 2 0 01-1.414.586H9v-2.828a2 2 0 01.586-1.414l7.586-7.586z" />
        </svg>
    </a>
@elseif($type === 'delete')
    {{-- Tombol Delete tetap merah biar kontras --}}
    <form action="{{ $url }}" method="POST" onsubmit="return confirm('Yakin mau hapus?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="p-1.5 rounded-md text-red-600 hover:text-red-900 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/30 transition" title="Delete">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </button>
    </form>
@endif