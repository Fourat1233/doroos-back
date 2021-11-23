@if($teachers->isNotEmpty())
@foreach($teachers as $teacher)
<tr>
    <td>{{  $teacher->id }}</td>
    <td>
        <div class="avatar avatar-sm mr-3">
            <img src="https://themekita.com/demo-atlantis-lite-bootstrap/livepreview/examples/assets/img/profile.jpg"
                alt="..." class="avatar-img rounded-circle">
        </div>
        <b>{{  $teacher->full_name }}</b>
    </td>
    <td>
        @if($teacher->userable->subjects)
        @foreach($teacher->userable->subjects as $subject)
        {{ $subject->name }},
        @endforeach
        @endif
    </td>
    <td>{{ $teacher->contact_point  }}</td>
    <td>{{ $teacher->phone_cell  }}</td>
    <td>{{ $teacher->created_at }}</td>
    <td>
        @if($teacher->userable->is_trusted)
            <a href="{{ route('back.secure.teacher.details', $teacher->id )}}" type="button"
                class="btn btn-success">
                {{-- <i class="fa fa-check"></i> --}}
                Approved
            </a>
        @elseif(!$teacher->userable->is_trusted && !$teacher->userable->is_completed)
            <button type="button" class="btn btn-warning">
                {{-- <i class="fa fa-exclamation-circle"></i> --}}
            Profile not created  
            </button>
        @elseif(!$teacher->userable->is_trusted && $teacher->userable->is_completed)
            <a href="{{ route('back.secure.teacher.details', $teacher->id )}}" type="button" class="btn btn-light" style="background: #d3d4d3ec !important">
                {{-- <i class="fa fa-exclamation-circle"></i> --}}
            Waiting for approval
            </a>
        @endif
    </td>
</tr>
@endforeach
<tr>
    <td colspan="4" align="center">
        <div style="margin-top: 20px; margin-bottom: 20px">
            {!! $teachers->links() !!}
        </div>
    </td>
</tr>

@endif