<tr>
    <td style="width: 40px;">
        <a href="{{ route('file_application.show', $file_application->id) }}">
            {!! $file_application->ref_num !!}
        </a>
    </td>
    <td style="width: 40px;">
        {!! $file_application->file_num !!}
    </td>
    <td class="align-middle">
        {!! $file_application->file_type ? $file_types[$file_application->file_type] : '' !!}
        @if ($file_application->jofa_type)
            &nbsp;({!! $jofa_types[$file_application->jofa_type] !!})
        @endif
    </td>
    <td class="align-middle">{{ $file_application->created_at->format(config('app.date_format')) }}</td>
    <td class="align-middle">
        {{ $file_application->received_at ? $file_application->received_at->format(config('app.date_time_format')) : null }}
    </td>
    <td class="align-middle">
        <span class="badge badge-lg badge-{{ $color_statuses[$file_application->status] }}">
            {!! $statuses[$file_application->status] !!}
        </span>
    </td>
    <td class="text-center align-middle">
        <a href="{{ route('file_application.show', $file_application->id) }}" style="padding: 2px;" class="text-dark"
            title="@lang('app.view_application')" data-toggle="tooltip" data-placement="top">
            <i class="fas fa-eye"></i>
        </a>

        @if ($file_application->status == 2)
            @permission('file_application.approve')
                <a href="{{ route('file_application.approve', $file_application->id) }}" style="padding: 2px;" class="text-dark"
                    title="@lang('app.update_application')" data-toggle="tooltip" data-placement="top">
                    <i class="fas fa-check"></i>
                </a>
            @endpermission
        @endif



        @if ($file_application->status == 1)
            <a href="{{ route('file_application.edit', $file_application->id) }}" style="padding: 2px;"
                class="text-dark" title="@lang('app.edit_application')" data-toggle="tooltip" data-placement="top">
                <i class="fas fa-edit"></i>
            </a>

            <a href="{{ route('file_application.delete', $file_application->id) }}" style="padding: 2px;"
                class="text-dark" title="@lang('app.delete_application')" data-toggle="tooltip" data-placement="top"
                data-method="DELETE" data-confirm-title="@lang('app.please_confirm')" data-confirm-text="@lang('app.are_you_sure_delete_user')"
                data-confirm-delete="@lang('app.yes_delete_him')">
                <i class="fas fa-trash"></i>
            </a>
        @endif
    </td>
</tr>
