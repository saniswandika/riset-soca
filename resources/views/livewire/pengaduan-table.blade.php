<div class="container">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ Request::is('pengaduans/draft') ? 'active' : '' }}" href="{{ url('pengaduans/draft') }}">Draft</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('pengaduans/diproses') ? 'active' : '' }}"
                href="{{ url('pengaduans/diproses') }}">Diproses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('pengaduans/dikembalikan') ? 'active' : '' }}"
                href="{{ url('pengaduans/dikembalikan') }}">Dikembalikan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('pengaduans/selesai') ? 'active' : '' }}"
                href="{{ url('pengaduans/selesai') }}">Selesai</a>
        </li>
    </ul>

    <form action="{{ url('data/search') }}" method="get" class="form-inline mt-3">
        <div class="input-group">
            <input type="text" class="form-control" name="query" placeholder="Search...">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengaduans as $d)
                <tr>
                    <td>{{ $d->id }}</td>
                    <td>{{ $d->name }}</td>
                    <td>{{ $d->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $pengaduans->links() }}
</div>

<script>
    // Activate Bootstrap tab on load based on URL hash
    $(document).ready(function() {
        $('a[href="' + window.location.hash + '"]').tab('show');
    });

    // Update URL hash on tab change
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        if (history.pushState) {
            history.pushState(null, null, e.target.hash);
        } else {
            window.location.hash = e.target.hash;
        }
    });
</script>
