@extends('layouts.layout')
@push('styles')
    @vite(['resources/css/admin.css'])
@endpush
@section('main')
    <div class="admin-wrap">
        <div class="admin-header">
            <h2>Admin Dashboard</h2>
        </div>

        <div class="admin-grid">
            <div class="simple-card">
                <h4>Ընդհանուր Oգտատերեր</h4>
                <p>{{ $activeCount  }}</p>
            </div>
            <div class="simple-card">
                <h4>Արգելափակված Oգտատերեր</h4>
                <p>{{ $blockedCount }}</p>
            </div>
        </div>

        <div class="table-container">
            <h3> Oգտատերեր </h3>
            <table class="simple-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Անուն,Ազգանուն</th>
                    <th>Էլ. փոստ</th>
                    <th>Գործողություն</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $users as $user )
                    <tr>
                        <td>{{ $user -> id }}</td>
                        <td>{{ $user -> name }} </td>
                        <td>{{ $user -> email }}</td>
                        <td >
                            <div class="block">
                            <form action="{{ route('admin.user.toggle', $user->id) }}" method="POST">
                                @csrf
                                @if($user->is_blocked)
                                    <button type="submit" class="btn-view">Ապաարգելափակել</button>
                                @else
                                    <button type="submit" class="btn-del">Արգելափակել</button>
                                @endif

                            </form>
                            @if(auth()->user()->role === 'superadmin')
                                @if($user->role === 'user')
                                    {{-- Եթե user է, ցույց տալ ադմին սարքելու կոճակը --}}
                                    <form action="{{ route('admin.users.makeAdmin', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-make-admin">Դարձնել Ադմին</button>
                                    </form>
                                @elseif($user->role === 'admin')
                                    {{-- Եթե ադմին է, ցույց տալ user սարքելու կոճակը --}}
                                    <form action="{{ route('admin.users.makeUser', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-make-user">Սարքել Օգտատեր</button>
                                    </form>
                                @endif
                            @endif
                            <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Վստա՞հ եք, որ ուզում եք ջնջել այս օգտատիրոջը։ Այս գործողությունը անդառնալի է։');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-del" style="background-color: #450a0a;">Ջնջել Հաշիվը</button>
                            </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

