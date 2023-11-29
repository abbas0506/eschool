<aside aria-label="Sidebar" id='sidebar'>
    <div class="mt-8 font-bold text-center text-orange-300 uppercase tracking-wider">GHSS</div>
    <div class="text-xs text-center">Chak Bedi, Pakpattan</div>
    <div class="mt-12">
        <ul class="space-y-2">
            <li>
                <a href="{{url('library/assistant')}}" class="flex items-center p-2">
                    <i class="bi-house"></i>
                    <span class="ml-3">Home</span>
                </a>
            </li>
            <li>
                <a href="{{route('library.assistant.book-issuance.scan')}}" class="flex items-center p-2">
                    <i class="bi-journal-arrow-up"></i>
                    <span class="ml-3">Issue Book</span>
                </a>
            </li>
            <li>
                <a href="{{route('library.assistant.book-return.scan')}}" class="flex items-center p-2">
                    <i class="bi bi-hdd-rack"></i>
                    <span class="ml-3">Return Book</span>
                </a>
            </li>
            <li>
                <a href="{{route('library.assistant.books.create')}}" class="flex items-center p-2">
                    <i class="bi bi-book"></i>
                    <span class="ml-3">Add Book</span>
                </a>
            </li>
            <li>
                <a href="{{route('library.assistant.qrcodes.index')}}" class="flex items-center p-2">
                    <i class="bi bi-qr-code"></i>
                    <span class="ml-3">Print QRCodes</span>
                </a>
            </li>
            <li class="md:hidden">
                <hr>
            </li>
            <li class="md:hidden">
                <a href="#" class="flex items-center p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                    </svg>
                    <span class="ml-3">My Profile</span>
                </a>
            </li>
            <li class="md:hidden">
                <a href="{{route('signout')}}" class="flex items-center p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1012.728 0M12 3v9" />
                    </svg>
                    <span class="ml-3">Logout</span>
                </a>
            </li>

        </ul>
    </div>
</aside>