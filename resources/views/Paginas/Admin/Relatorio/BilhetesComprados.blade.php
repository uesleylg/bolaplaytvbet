<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<style>
    @page {
    margin: 20px 20px;
}

body {
    font-family: Arial, sans-serif;
    font-size: 8px;
    margin: 0;
    padding: 0;
}

/* tabela pai 4x6 */
.parent-table {
       margin: 0;
    padding: 0;
    width: 100%;
    border-collapse: separate;
    border-spacing: 5px; /* mantém horizontal e vertical */
}

.parent-table td.td-personalizado {
    width: 25%;
    vertical-align: top;
    padding: 0;
}

/* tabela interna do bilhete */
.bilhete-table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
}

.bilhete-table td {
    border: 1px solid #000;
    height: 14px; /* menor altura vertical */
    padding-top: 0;
    padding-bottom: 0;
    vertical-align: middle;
}

/* colunas pequenas */
.col-small {
    width: 8%;
    text-align: center;
    padding-top: 0;
    padding-bottom: 0;
}

/* colunas de nome */
.col-name {
    width: 42.5%;
    padding-left: 4px;
    padding-right: 2px;
    padding-top: 0;    /* reduz espaço vertical */
    padding-bottom: 0; /* reduz espaço vertical */
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* círculos */
.circle {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    display: inline-block;
}

.circle.filled {
    border: 1px solid #000;
    background: #000;
}

/* cabeçalho da página */
.page-header {
    text-align: center;
    font-weight: bold;
    font-size: 10px;
    margin-bottom: 3px;
}

/* cabeçalho do bilhete */
.bilhete-header {
    text-align: center;
    font-weight: bold;
    font-size: 7px;
    border-top: 1px solid #000;
    border-left: 1px solid #000;
    border-right: 1px solid #000;
    padding-top: 1px;
    padding-bottom: 1px;
    margin-bottom: 0;
}

/* rodapé do bilhete */
.bilhete-footer {
    font-weight: bold;
    font-size: 7px;
    border-left: 1px solid #000;
    border-right: 1px solid #000;
    border-bottom: 1px solid #000;
    border-top: none;
padding:5px;
    line-height: 1em;
    display: flex;
    justify-content: space-between;
}
</style>
</head>
<body>

<table class="parent-table">
    <tr>
        <td style="text-align:left; font-weight:bold; font-size:20px;">
        {{ mb_strtoupper($configs['nome_site'] ?? 'Nome do Site', 'UTF-8') }}

        </td>
        <td style="text-align:right; font-weight:bold; font-size:20px;">
            Nº 078
        </td>
    </tr>
</table>


@foreach ($paginas as $pagina)
<table class="parent-table">
    @for ($row = 0; $row < 6; $row++)
        <tr>
            @for ($col = 0; $col < 4; $col++)
                @php
                    $index = ($row * 4) + $col;
                    $bilhete = $pagina[$index] ?? null;
                @endphp
                <td class="td-personalizado">
                    @if($bilhete)
                        <div class="bilhete-header">
                            RODADA DO DIA {{ strtoupper(\Carbon\Carbon::parse($rodada->data_fim)->locale('pt_BR')->translatedFormat('d \D\e F - Y')) }}
                        </div>

                        <table class="bilhete-table">
                            @foreach ($rodada->jogos as $i => $jogo)
                                @php $p = $bilhete->palpites[$i] ?? ''; @endphp
                                <tr>
                                    <td class="col-small">
                                        <span class="circle {{ $p == '1' ? 'filled' : '' }}"></span>
                                    </td>
                                    <td class="col-name">{{ $jogo->time_casa_nome }}</td>
                                    <td class="col-small">
                                        <span class="circle {{ strtoupper($p) == 'X' ? 'filled' : '' }}"></span>
                                    </td>
                                    <td class="col-name">{{ $jogo->time_fora_nome }}</td>
                                    <td class="col-small">
                                        <span class="circle {{ $p == '2' ? 'filled' : '' }}"></span>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        <div class="bilhete-footer">
                            <span>CÓDIGO: fgfgfgf</span>
                            <span>CLIENTE: teste</span>
                        </div>
                    @endif
                </td>
            @endfor
        </tr>
    @endfor
</table>

@if (!$loop->last)
<div style="page-break-after: always;"></div>
@endif

@endforeach

</body>
</html>
