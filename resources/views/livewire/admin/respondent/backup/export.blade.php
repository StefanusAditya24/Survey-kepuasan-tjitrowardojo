<table>
    <thead>
    <tr>
        <th>Tanggal</th>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>Usia</th>
        <th>Nomor Telfon</th>
        <th>Pendidikan</th>
        <th>Pekerjaan</th>
        <th>Jenis Pelayanan</th>
        <th>Ruangan Pasien</th>
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
            <td>{{ $respondent->gender }}</td>
            <td>{{ $respondent->age->name }}</td>
            <td>{{ $respondent->phone_number }}</td>
            <td>{{ $respondent->education->name }}</td>
            <td>{{ $respondent->job }}</td>
            <td>{{ $respondent->serviceType->name }}</td>
            <td>{{ $respondent->patientRoom->room_name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>