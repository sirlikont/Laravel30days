<x-layout>
    <x-slot:heading>
        Jobs listing
    </x-slot:heading>

    <ul>
        @foreach ( $jobs as $job )
            <li>
                <a href="/jobs/{{ $job['id'] }}" class="text-blue-500 hover:text-blue-700">
                    <strong>{{ $job['title'] }}</strong>
                    <strong>{{ $job['title'] }}:</strong> pays $ {{ $job['salary'] }} per year.
                </a>
            </li>
        @endforeach
    </ul>

</x-layout>
