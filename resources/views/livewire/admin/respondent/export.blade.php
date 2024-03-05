<table>
    <thead>
    <tr>
        <th>Tanggal</th>
        <th>Nama</th>
        <th>Jenis Layanan</th>
        <th>Nama Poli</th>
        <th>Nama Ruangan</th>
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
            <td>{{ Str::title($respondent->name) }}</td>
            <td>{{ Str::title($respondent->serviceType->name) }}</td>
            <td>{{ Str::title($respondent->polyclinic->poly_name ?? "") }}</td>
            <td>{{ Str::title($respondent->patientRoom->room_name ?? "") }}</td>
            @foreach($respondent->answers as $answer)
                @if($loop->last)
                    <td>{{ $answer->custom_answer }}</td>
                @else
                    <td>{{  $answer->answer->answer_value  }}</td>
                @endif
            @endforeach
        </tr>
    @endforeach
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr>
        <td colspan="5">Total Nilai Per unsur</td>
        @foreach($attributes as $attribute)
            <td>{{ $attribute['total_weight'] }}</td>
        @endforeach
    </tr>
    <tr>
        <td colspan="5">IKM Per unsur</td>
        @foreach($attributes as $attribute)
            <td>{{ $attribute['average_weight'] }}</td>
        @endforeach
    </tr>
    <tr>
        <td colspan="5">Nilai rata" per unsur</td>
        @foreach($averageAttributes as $averageAttribute)
            <td>{{ $averageAttribute }}</td>
        @endforeach
    </tr>
    <tr>
        <td colspan="5" >IKM Unit Layanan</td>
        @foreach($calculatedAverageAttributes as $calculatedAverageAttribute)
            <td>{{ $calculatedAverageAttribute }}</td>
        @endforeach
    </tr>
    <tr>
        <td colspan="5" >Total IKM</td>
        <td colspan="9" style="text-align: center">{{ $totalCalculatedAverageAttributes }}</td>
    </tr>
    <tr>
        <td colspan="5">Jumlah Total</td>
        <td colspan="9" style="text-align: center">{{ $serviceUnitIndex }}</td>
    </tr>
    </tbody>
</table>