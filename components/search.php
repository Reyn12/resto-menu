<div class="flex items-center">
    <div class="relative flex-1">
        <input type="text" 
               id="searchInput"
               placeholder="Search something sweet on your mind..." 
               class="w-full px-4 py-3 rounded-xl bg-white border-none focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm"
               onkeyup="searchMenu(this.value)"
        >
        <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
    </div>
</div>

<script>
function searchMenu(query) {
    fetch(`search_menu.php?q=${encodeURIComponent(query)}`)
        .then(response => response.text())
        .then(html => {
            document.querySelector('.grid').innerHTML = html;
        })
        .catch(error => console.error('Error:', error));
}
</script>