<table>
    <thead>
    <tr>
        <th>Tanggal</th>
        <th>Nama</th>
        @foreach($questions as $question)
            <th>{{ $question->name }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($respondents as $respondent)
        @php
            $carbonDate = \Carbon\Carbon::parse($respondent->created_at);
            $formattedDate = $carbonDate->format('d-m-Y H:i:s');
        @endphp
        <tr>
            <td>{{ $formattedDate }}</td>
            <td>{{ $respondent->name }}</td>
            @foreach($respondent->answers as $answer)
                <td>{{ $answer->answer->answer_value }}</td>
            @endforeach
        </tr>
    @endforeach
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr>
        <td colspan="2">Total Nilai Per unsur</td>
        @foreach($attributes as $attribute)
            <td>{{ $attribute['total_weight'] }}</td>
        @endforeach
    </tr>
    <tr>
        <td colspan="2">IKM Per unsur</td>
        @foreach($calculatedAttributes as $calculatedAttribute)
            <td>{{ $calculatedAttribute }}</td>
        @endforeach
    </tr>
    <tr>
        <td colspan="2">NRR Tertimbang</td>
        <td colspan="9"  style="text-align: center">{{ $weightedAttribute }}</td>
    </tr>
    <tr>
        <td colspan="2">IKM Unit Layanan</td>
        <td colspan="9"  style="text-align: center">{{ $serviceUnitIndex }}</td>
    </tr>
    </tbody>
</table>