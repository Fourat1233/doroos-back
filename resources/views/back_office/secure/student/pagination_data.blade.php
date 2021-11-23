@foreach($students as $student)
    <tr>
        <td>{{ $student->id }}</td>
        <td>
            <div class="avatar avatar-sm mr-3">
                <img src="https://themekita.com/demo-atlantis-lite-bootstrap/livepreview/examples/assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
            </div>
            <b>{{ $student->full_name }}</b>
        </td>
        <td>{{ $student->contact_point }}</td>
        <td>{{ $student->phone_cell }}</td>
        <td>{{ $student->created_at }}</td>
    </tr>
@endforeach
<tr>
    <td colspan="4" align="center">
        <div style="margin-top: 20px; margin-bottom: 20px">
            {!! $students->links() !!}
        </div>
    </td>
</tr>
