<table>
    <thead>
        <tr>
            <th>User Name</th>
            <th>Email</th>
            <th>Role(s)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->roles && $user->roles->count())
                        {{ $user->roles->pluck('name')->join(', ') }}
                    @else
                        -
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
