@foreach ($agents as $agent)
    <div>
        <p>{{ $agent->name }}</p>
        <p>{{ $agent->address }}</p>
        <p>{{ $agent->email }}</p>
        <p>{{ $agent->phone }}</p>
    </div>
@endforeach