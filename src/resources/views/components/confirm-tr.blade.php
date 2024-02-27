<tr>
    <th class="w-1/4 p-4 bg-blue-300 border-2">{{ $title }}</th>
    <td class="p-4 border-2">{{ $value }}</td>
    @if ($name)
        <input type="hidden" name="{{ $name }}" value="{{ $value }}">
    @endif
</tr>
