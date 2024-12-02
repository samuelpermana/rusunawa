<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="btn btn-outline-dark" id="sidebarToggleBtn">
            <i class="fa fa-bars"></i>
        </button>
        <!-- <a class="navbar-brand" href="#">Dashboard</a> -->
        <div class="d-flex">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-outline-success" type="submit">Logout</button>
            </form>
        </div>
    </div>
</nav>
