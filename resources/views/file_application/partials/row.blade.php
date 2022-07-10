<tr>
    <td style="width: 40px;">
        <a href="{{ route('file_application.edit', $file_application->id) }}">
            {!! $file_application->ref_num !!}
        </a>
    </td>
    <td class="align-middle">
        {!! $file_types[$file_application->file_type] !!}
        @if ($file_application->jofa_type)
            &nbsp;({!! $jofa_types[$file_application->jofa_type] !!})
        @endif
    </td>
    <td class="align-middle">{{ $file_application->created_at->format(config('app.date_format')) }}</td>
    <td class="align-middle">
        <span class="badge badge-lg badge-{{ $color_statuses[$file_application->status] }}">
            {!! $statuses[$file_application->status] !!}
        </span>
    </td>
    <td class="text-center align-middle">
        <div class="dropdown show d-inline-block">
            <a style="padding: 2px;" class="text-dark" href="#" role="button" id="dropdownMenuLink"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">

                <a href="{{ route('user.show', $file_application->id) }}" class="dropdown-item text-gray-500">
                    <i class="fas fa-eye mr-2"></i>
                    @lang('app.view_user')
                </a>

            </div>
        </div>

        <a href="{{ route('user.edit', $file_application->id) }}" style="padding: 2px;" class="text-dark"
            title="@lang('app.edit_user')" data-toggle="tooltip" data-placement="top">
            <i class="fas fa-edit"></i>
        </a>

        <a href="{{ route('user.delete', $file_application->id) }}" style="padding: 2px;" class="text-dark"
            title="@lang('app.delete_user')" data-toggle="tooltip" data-placement="top" data-method="DELETE"
            data-confirm-title="@lang('app.please_confirm')" data-confirm-text="@lang('app.are_you_sure_delete_user')"
            data-confirm-delete="@lang('app.yes_delete_him')">
            <i class="fas fa-trash"></i>
        </a>
    </td>
</tr>
