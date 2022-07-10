<tr>
    <td>
        {!! $file_transaction->id !!}
    </td>
    <td style="width: 40px;">
        {!! $file_transaction->file_num !!}
    </td>
    <td class="align-middle">
        <a href="{{ route('file_application.show',$file_transaction->file_application->id ) }}">{!! $file_transaction->file_application->ref_num !!} </a></td>
    <td class="align-middle">
        @lang('app.' . $file_transaction->trx_type)
    </td>

    <td class="align-middle">{{ $file_transaction->created_at->format(config('app.date_time_format')) }}</td>

</tr>
