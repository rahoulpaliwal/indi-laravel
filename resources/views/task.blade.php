<x-guest-layout>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- <form method="POST" action="{{ route('login') }}"> -->
    <a class="ms-3" href="/clear-session">Clear Session</a>
        <div>
            <x-input-label for="capturedInput" :value="__('Text')" />
            <x-text-input id="capturedInput" class="block mt-1 w-full" type="text" name="text" :value="old('text')" required autofocus autocomplete="text" />
            <x-input-error :messages="$errors->get('text')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3" onclick="capture()">
                {{'Capture'}}
            </x-primary-button>
            <x-secondary-button class="ms-3" onclick="submit()">
                {{'Submit'}}
            </x-secondary-button>
        </div>
        <div id="displayAll"></div>
        <div id="displaySorted"></div>
    <!-- </form> -->
    <script>
    var capturedStrings = [];

    function capture() {
        var capturedString = document.getElementById('capturedInput').value;
        capturedStrings.push(capturedString);

        // Make an AJAX request to update the server
        // Use Laravel's csrf_token() to secure your AJAX request
        $.post('/task/capture', { capturedString: capturedString, _token: '{{ csrf_token() }}' }, function(data) {
            console.log('Captured successfully');
        });
        // Display all captured strings
        document.getElementById('displayAll').innerHTML = 'All Captured Strings: ' + capturedStrings.join(', ');
        clearInput();
    }

    function submit() {
        // Make an AJAX request to retrieve sorted strings from the server
        $.get('/task/submit', function(data) {
            // Display sorted strings from the server
            document.getElementById('displaySorted').innerHTML = 'Sorted Strings: ' + data.sortedStrings;
        });
        clearInput();
    }
    function clearInput() {
        // Clear the input box
        document.getElementById('capturedInput').value = '';
    }
</script>
</x-guest-layout>
