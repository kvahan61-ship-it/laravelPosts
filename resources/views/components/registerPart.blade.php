<div class="authBlock">
    @auth
        <h3>{{ auth()->user()->name }}</h3>

        <form action="{{ route('logout') }}" method="POST" style="display: inline; margin-left: 10px;">
            @csrf
            <button type="submit">Выйти</button>
        </form>
    @endauth
    @guest
        <a href="{{ route('register') }}" class="buttReg">Registration</a> /
        <a href="{{ route('login') }}" class="buttReg">Login</a>
    @endguest
</div>
