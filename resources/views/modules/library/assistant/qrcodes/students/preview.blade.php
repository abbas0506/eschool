<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Codes</title>
    <link href="{{public_path('css/pdf_tw.css')}}" rel="stylesheet">
    <style>
        @page {
            margin: 50px 80px 50px 50px;
        }

        .footer {
            position: fixed;
            bottom: 50px;
            left: 30px;
            right: 50px;
            background-color: white;
            height: 50px;
        }

        .page-break {
            page-break-after: always;
        }

        .data tr th,
        .data tr td {
            font-size: 12px;
            text-align: center;
            /* padding-bottom: 2px; */
            border: 0.5px solid;
        }
    </style>
</head>
@php
$roman = config('global.romans');
@endphp

<body>

    <main>
        <div class="container">

            <div class="w-1/2 mx-auto">
                <div class="relative">
                    <div class="absolute"><img alt="logo" src="{{public_path('/images/logo/school_logo.png')}}" class="w-16"></div>
                </div>
                <table class="w-full">
                    <tbody>
                        <tr>
                            <td class="text-center text-xl font-bold">QR Codes - {{$clas->roman()}} </td>
                        </tr>
                        <tr>
                            <td class="text-center text-sm">Govt. Higher Secondary School Chak Bedi, Pakpattan</td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <!-- table header -->
            <div class="mt-8">
                <table class="w-full">
                    <tbody>
                        <tr class="text-xs">
                            <td class="text-left">Class: {{ $clas->roman()}} </td>
                            <td class="text-right">Printed on {{ now()->format('d-M-Y')}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @php $i=1; @endphp

            <table class="table-auto w-full mt-2">
                <thead>
                    <tr style="background-color: #bbb;" class="border text-sm">
                        <th>Sr</th>
                        <th>Student</th>
                        <th>Class</th>
                        <th>Roll #</th>
                        <th>QRCode</th>
                    </tr>
                </thead>
                <tbody>
                    @php $copy_sr=''; @endphp
                    @foreach($clas->students as $student)
                    <tr class="border text-sm">
                        <td>{{$i++}}</td>
                        <td class="text-left pl-3">
                            {{ $student->name }} s/o {{ $student->father }}
                            <br>
                            <span class="text-xs text-slate-600">{{$student->cnic}}</span>
                        </td>
                        <td>{{ $student->clas->roman() }} </td>
                        <td>{{ $student->rollno}}</td>
                        <td class="w-20 p-2">
                            {!! DNS2D::getBarcodeHTML($student->cnic, 'QRCODE',4,4) !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </main>

    <footer class="footer">
        <div class="mt-8">
            <table class="w-full">
                <tbody>
                    <tr class="text-xs">

                    </tr>
                </tbody>
            </table>
        </div>
    </footer>

    <script type="text/php">
        if (isset($pdf) ) {
            $x = 285;
            $y = 20;
            $text = "{PAGE_NUM} of {PAGE_COUNT}";
            $font = $fontMetrics->get_font("helvetica", "bold");
            $size = 6;
            $color = array(0,0,0);
            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;   //  default
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }
    </script>
</body>

</html>