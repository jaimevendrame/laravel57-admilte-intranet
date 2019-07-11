<!doctype html>
<html>
<head>
    <title>Relatório de Controle de Súmulas</title>
</head>
<body>

<h1 style="text-align: center;"><img alt="" src="https://campomourao.pr.leg.br/logo.png" style="width: 180px; height: 180px;" /></h1>
<h1 style="text-align: center;"><span style="font-family:tahoma,geneva,sans-serif;"><strong>C&Acirc;MARA MUNICIPAL DE CAMPO MOUR&Atilde;O - PR</strong></span></h1>
<hr>

<h2 style="text-align: center;"><span style="font-family:tahoma,geneva,sans-serif;">Relat&oacute;rio de Controle de S&uacute;mulas</span></h2>

@foreach( $dados as $d)


    <div style="border: 2px solid black; width: 95%; padding: 5px;">
        <p><h3>
            <strong>
                @php
                    if (($d->date_start != "")) {

                            $data_end = date('Y-m-d', strtotime('+90 days', strtotime($d->date_start)));

                            $data1 = new DateTime( $d->date_start );
                            $data2 = new DateTime( $data_end );
                            $data_atual = new DateTime( \Carbon\Carbon::now()->format('Y-m-d') );

                            $prazo = $data2->diff( $data_atual )->format("%a");



                            if ($data2 < $data_atual)
                            {


                             echo "PRAZO EXPIRADO";


                            } else {

                             echo "Esta SúmUla expira em " .$prazo." dias";
                            }


                        } else { echo "---"; }


                @endphp
            </strong>
        </h3>
        </p>
        <p>Nº do Procolo: <strong>{{ $d->nr_protocolo }}</strong></p>
        <p>Nome do Parlamentar: <strong>{{ $d->name." ".$d->last_name }}</strong></p>
        <p>Data do Procotolo: <strong>{{ \Carbon\Carbon::parse($d->date_protocolo)->format('d/m/Y') }}</strong></p>
        <p>Horário do Protocolo: <strong>{{ \Carbon\Carbon::parse($d->hour_protocolo)->format('H:i')  }}</strong></p>
        <p>Data Início: <strong>{{ \Carbon\Carbon::parse($d->date_start)->format('d/m/Y') }}</strong></p>
        <p>Data Fim:
            <strong>
                @php
                    if (($d->date_start != "")) {
                    $data_end = date('Y-m-d', strtotime('+90 days', strtotime($d->date_start)));

                    echo \Carbon\Carbon::parse($data_end)->format('d/m/Y'); }
                @endphp
            </strong>
        </p>

        <p>Súmula: {{ $d->description }}</p>    </div>
    <br/>
@endforeach
<p><strong>Relatório Gerado em: {{\Carbon\Carbon::now()->format('d/m/Y'). " " .\Carbon\Carbon::now()->format('H:i:s')." "}}por CotecSGL</strong></p>
</body>
</html>
