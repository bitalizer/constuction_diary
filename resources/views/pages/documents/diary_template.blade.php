<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Diary</title>
    <meta name="description" content="">


    <style>
        td,
        th {
            padding: 0;
        }

        table {
            width: 100%;
            margin: 0 auto;
            text-align: left;
            max-width: 100%;
            margin-bottom: 20px;

        }

        table tr {
            font-size: 14px;
            border: 1px solid #eaeaea;
        }

        table > thead > tr > th {
            vertical-align: bottom;
            border-bottom: 2px solid #ddd;
        }

        table tr td {
            padding: 4px;
            vertical-align: top;
        }

        .row {
            max-width: 100%;
            margin: 0 auto;
            clear: both;
        }

        .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
            position: relative;
            min-height: 1px;
        }

        .col-xs-6 {
            width: 50%;
            display: inline-block;
            float: left;
        }

        .col-xs-4 {
            width: 33.33333333%;
            display: inline-block;
            float: left;
        }

        .header {
            text-align: center;
            font-size: 18px;
        }
    </style>

</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <table class="table">
                <thead>
                <tr>
                    <th class="header" colspan="3" scope="col">EHITUSTÖÖDE PÄEVIK nr. {{ $diary_number }}</th>
                </tr>
                </thead>
                <tbody>
                <td>{{ $object_acronym }} {{ date('y', strtotime($diary->project->created_at)) }}</td>
                <td>Ehitusettevõtja: {{ mb_strtoupper($diary_company) }}</td>
                <td>Kuupäev: {{ date('d.m.Y', strtotime($diary->date)) }}</td>
                </tbody>
            </table>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Ehitise nimetus ja asukoht/Lepingu nr.</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $diary->project->name }}, {{ $diary->project->location }}</td>
            </tr>
            </tbody>
        </table>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Ilmastik</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr>

                <td>Kellaaeg: {{ date('H:i', strtotime($diary->weather_time)) }}</td>
                <td>Temp: {{ $diary->weather_temperature }}</td>
                <td>Tugev tuul: {{ $diary->weather_wind ? 'Jah' : 'Ei' }}</td>
                <td>Kuiv: {{ $diary->weather_dry ? 'Jah' : 'Ei' }}</td>
                <td>Vihm: {{ $diary->weather_rain ? 'Jah' : 'Ei' }}</td>
                <td>Lörts: {{ $diary->weather_sleet ? 'Jah' : 'Ei' }}</td>
                <td>Lumi: {{ $diary->weather_snow ? 'Jah' : 'Ei' }}</td>

            </tr>

            </tbody>
        </table>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Tööjõud</th>
                <th scope="col">Aeg</th>
                <th scope="col">Tunnid</th>
                <th scope="col">Märge</th>
            </tr>
            </thead>
            <tbody>
            @foreach($diary->employees as $employee)
                <tr>
                    <td>{{ sig_from_name($employee->name) }}</td>
                    <td>{{ date('H:i', strtotime($employee->pivot->start_time)) }}
                        - {{ date('H:i', strtotime($employee->pivot->end_time)) }}</td>
                    <td>{{ $employee->pivot->hours }}</td>
                    <td>{{ $employee->pivot->note }}</td>

                </tr>
            @endforeach

            </tbody>
        </table>
        <div class="row">

            <div class="col-xs-6">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">TEHTAVAD TÖÖD,OLUKORD OBJEKTIL</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $diary->work_description }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-xs-6">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Mehhanismid objektil</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $diary->mechanisms }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">TELLITUD MATERJALID, SEADMED, JOONISED</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $diary->equipment }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>


            <div class="col-xs-6">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Muud märkused ja asjaolud</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ empty($diary->comments) ? '—' : $diary->comments }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-4">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">KONTROLL AMETIISIKUD, PROJ.-RIJA,MUUD</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ empty($diary->control) ? '—' : $diary->control }}</td>
                    </tr>
                    </tbody>
                </table>

            </div>
            <div class="col-xs-4">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">AMETNIKE, TELLIJA JA JÄRELVALVE JUHISED:</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ empty($diary->instructions) ? '—' : $diary->instructions }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-xs-4">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">KOOSTATUD AKTID JA <br>DOKUMENDID:</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ empty($diary->acts_and_documents) ? '—' : $diary->acts_and_documents }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col" colspan="2">Allkirjad</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><p>ETTEVÕTTE ESINDAJA(vastutav töödejuht)</p>
                        <p><b>{{ $signature }}</b></p>
                    </td>
                    <td><p>TELLIJA ESINDAJA/JÄRELVALVE</p>
                        <p>_____________</p>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>