<!DOCTYPE html>
<html>
<head>
    <style>
        @page { margin: 10px; }

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 0;
            padding: 0;
        }

        .pagina {
            page-break-after: always;
            padding: 5px;
        }

        .header {
            width: 100%;
            display: flex;
            justify-content: space-between;
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* ------ GRID DE 4 COLUNAS ------ */
   

       
        /* ------ BOX DO BILHETE ------ */
        .bilhete-box {
            border: 2px solid #000;
            padding: 4px;
            font-size: 10px;
            font-weight: bold;
            box-sizing: border-box;
        }

        .titulo-bilhete {
            text-align: center;
            font-size: 11px;
            margin-bottom: 3px;
        }

        /* ------ TABELA DE JOGOS ------ */
        table.jogos {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        table.jogos td, table.jogos th {
            border: 1px solid #000;
            padding: 1px 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* ------ COLUNAS DOS PONTOS ------- */
        /* EXTREMAMENTE ESTREITAS PARA DAR LUGAR AOS TIMES */
        .col-ponto {
            width: 20% !important;
            max-width: 20% !important;
            min-width: 20% !important;
            text-align: center;
        }

        .ponto {
            font-size: 15px;
            display: block;
            width: 100%;
        }

        /* ------ NOME DOS TIMES ------ */
        .time {
             width: 100%;
            font-size: 9px;
      
        }

        .rodape {
            text-align: center;
            font-size: 11px;
            margin-top: 3px;
            font-weight: bold;
        }
    </style>
</head>
<body>

@foreach($paginas as $pagina)

<div class="pagina">

    <div class="header">
        <div>{{ strtoupper($rodada->nome) }}</div>
        <div>Nº <u>{{ $rodada->id }}</u></div>
    </div>

    <table class="grid" style=" width: 100%;">

        @foreach($pagina->chunk(4) as $linha)
        <tr>

            @foreach($linha as $bilhete)
            <td>
                <div class="bilhete-box">

                    <div class="titulo-bilhete">PARCEIROS</div>

                    <table class="jogos">

                        @foreach($rodada->jogos as $i => $jogo)
                        @php $p = strtolower($bilhete->palpites[$i] ?? '-'); @endphp
<tr>
    <!-- MANDANTE PONTO -->
    <td class="col-ponto">
        <span class="ponto">{{ $p === '1' ? '•' : '' }}</span>
    </td>

    <!-- TIME MANDANTE -->
    <td class="time">{{ $jogo->time_casa_nome }}</td>

    <!-- EMPATE PONTO -->
    <td class="col-ponto">
        <span class="ponto">{{ $p === 'x' ? '•' : '' }}</span>
    </td>

    <!-- TIME VISITANTE -->
    <td class="time">{{ $jogo->time_fora_nome }}</td>

    <!-- VISITANTE PONTO -->
    <td class="col-ponto">
        <span class="ponto">{{ $p === '2' ? '•' : '' }}</span>
    </td>
</tr>

                        @endforeach

                    </table>

                    <div class="rodape">
                        {{ $bilhete->id }} - REI DO PI1 &nbsp;&nbsp;&nbsp; {{ $bilhete->codigo_bilhete }}
                    </div>

                </div>
            </td>
            @endforeach

            @for($n = count($linha); $n < 4; $n++)
                <td></td>
            @endfor

        </tr>
        @endforeach

    </table>

</div>

@endforeach

</body>
</html>
