<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat</title>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>

<body>
    <form action="{{route('update', $reportId)}}" method="POST" style="width: 500px; margin: 50px auto; display: block;">
        @csrf
        @method('PATCH')
        <div class="input-card">
            <label for="">Keadaan :</label>

            @if ($report)
            <select name="keadaan" id="keadaan">
                <option value="ditolak" {{ $report['keadaan'] == 'ditolak' ? 'selected' : ''}}>Ditolak</option>
                <option value="diterima" {{ $report['keadaan'] == 'diterima' ? 'selected' : ''}}>Diterima</option>
                <option value="berproses" {{ $report['keadaan'] == 'berproses' ? 'selected' : ''}}>Berproses</option>
            </select>
            @else
                <select name="keadaan">
                <option selected hidden disabled>Pilih Keadaan</option>
                <option value="ditolak">Ditolak</option>
                <option value="diterima">Diterima</option>
                <option value="berproses">Berproses</option>
            </select>
            @endif
            
        </div>

        <div class="input-card">
            <label for="pesan">Pesan :</label>
            <textarea name="pesan" id="pesan" rows="4">{{ $report ? $report['pesan'] : '' }}</textarea>
        </div>

        <button type="submit">Kirim Response</button>
    </form>
</body>

{{-- kl eror di rows brrt bermasalah d models/migration --}}