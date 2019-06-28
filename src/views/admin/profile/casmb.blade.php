<div class="">
    <h4 class="card-title">Hoverable Table</h4>
    <p class="card-description"> Add class <code>.table-hover</code> </p>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Raportare</th>
            <th>Pacienti</th>
            <th>Puncte</th>
            <th>Lei</th>
            <th> </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>CLIN_26376557_20181215_0321</td>

            <td  >{{ $casmb->count('serviceValue') }}

            </td>
            <td>{{ $casmb->sum('serviceValue') }}</td>
            <td>{{ $casmb->sum('serviceValue') * 2.8 * 1.2 }}</td>
            <td>
                <label class="badge badge-danger">Pending</label>
            </td>
        </tr>

        </tbody>
    </table>
</div>