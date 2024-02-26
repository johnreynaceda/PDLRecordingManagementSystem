@section('title', 'Commits')
<x-admin-layout>
    <div class="bg-white bg-opacity-50 rounded-lg relative p-2">
        <livewire:admin.commit-list />
    </div>
    <script>
        function printOut(data) {
            var mywindow = window.open('', '', 'height=1000,width=1000');
            mywindow.document.head.innerHTML =
                '<title></title><link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}" />';
            mywindow.document.body.innerHTML = '<div>' + data +
                '</div><script src="{{ Vite::asset('resources/js/app.js') }}"/>';

            mywindow.document.close();
            mywindow.focus(); // necessary for IE >= 10
            setTimeout(() => {
                mywindow.print();
                return true;
            }, 2000);
        }
    </script>
</x-admin-layout>
