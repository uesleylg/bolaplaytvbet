@extends('Layout/Admin/AppAdmin')


@section('title', 'BolaPlay Bet')

@section('content')

<div class="container-fluid">
          <div class="row g-3">

            <!-- Top summary cards -->
            <div class="col-12 col-sm-6 col-md-4 col-xl-3">
              <div class="card stat-card p-3">
                <div class="d-flex align-items-center">
                  <div class="me-3">
                    <div class="bg-light rounded-3 p-2">
                      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 12h18" stroke="#0d6efd" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M3 7h12" stroke="#0d6efd" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M3 17h6" stroke="#0d6efd" stroke-width="1.5" stroke-linecap="round" />
                      </svg>
                    </div>
                  </div>
                  <div>
                    <div class="small text-muted">Total de Bilhetes</div>
                    <div class="h5 mb-0">13.793</div>
                  </div>
                </div>
                <div class="mt-2 small text-muted">Última atualização: 31/10/2025</div>
              </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 col-xl-3">
              <div class="card stat-card p-3">
                <div class="d-flex align-items-center">
                  <div class="me-3">
                    <div class="bg-light rounded-3 p-2">
                      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2v20" stroke="#0d6efd" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M5 12h14" stroke="#0d6efd" stroke-width="1.5" stroke-linecap="round" />
                      </svg>
                    </div>
                  </div>
                  <div>
                    <div class="small text-muted">Bilhetes Externos</div>
                    <div class="h5 mb-0">5</div>
                  </div>
                </div>
                <div class="mt-2 small text-muted">Conferidos</div>
              </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 col-xl-3">
              <div class="card stat-card p-3">
                <div class="d-flex align-items-center">
                  <div class="me-3">
                    <div class="bg-light rounded-3 p-2">
                      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="8" r="3" stroke="#0d6efd" stroke-width="1.5" />
                        <path d="M5 20c1-4 6-6 7-6s6 2 7 6" stroke="#0d6efd" stroke-width="1.5" stroke-linecap="round" />
                      </svg>
                    </div>
                  </div>
                  <div>
                    <div class="small text-muted">Usuários</div>
                    <div class="h5 mb-0">2.410</div>
                  </div>
                </div>
                <div class="mt-2 small text-muted">Ativos nos últimos 30 dias</div>
              </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 col-xl-3">
              <div class="card stat-card p-3">
                <div class="d-flex align-items-center">
                  <div class="me-3">
                    <div class="bg-light rounded-3 p-2">
                      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 12h18" stroke="#0d6efd" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M6 6h12v12H6z" stroke="#0d6efd" stroke-width="1.5" />
                      </svg>
                    </div>
                  </div>
                  <div>
                    <div class="small text-muted">Prêmio (estimado)</div>
                    <div class="h5 mb-0">R$ 96.550,00</div>
                  </div>
                </div>
                <div class="mt-2 small text-muted">Valor bruto</div>
              </div>
            </div>

            <!-- Larger content cards (full width on small screens) -->
            <div class="col-12 col-lg-8">
              <div class="card p-3 stat-card">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <h6 class="mb-0">Últimos bilhetes</h6>
                  <small class="text-muted">Mostrando 10</small>
                </div>
                <div class="table-responsive" style="border-radius: 10px;">
                  <table style="color:white;" class="table table-borderless align-middle mb-0">
                    <thead>
                      <tr class="small text-muted">
                        <th>#</th>
                        <th>Usuário</th>
                        <th>Valor</th>
                        <th>Data</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>13783</td>
                        <td>joao.s</td>
                        <td>R$ 10,00</td>
                        <td>30/10/2025</td>
                        <td><span class="badge bg-success">Pago</span></td>
                      </tr>
                      <tr>
                        <td>13784</td>
                        <td>maria.l</td>
                        <td>R$ 10,00</td>
                        <td>30/10/2025</td>
                        <td><span class="badge bg-warning text-dark">Pendente</span></td>
                      </tr>
                      <tr>
                        <td>13785</td>
                        <td>carlos.t</td>
                        <td>R$ 20,00</td>
                        <td>29/10/2025</td>
                        <td><span class="badge bg-success">Pago</span></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col-12 col-lg-4">
              <div class="card p-3 stat-card">
                <h6 class="mb-3">Resumo Rápido</h6>
                <ul class="list-unstyled small mb-0">
                  <li class="mb-2">Bilhetes do site: <strong>13.788</strong></li>
                  <li class="mb-2">Bilhetes externos: <strong>5</strong></li>
                  <li class="mb-2">Pagamentos pendentes: <strong>12</strong></li>
                  <li class="mb-2">Prêmio estimado: <strong>R$ 96.550,00</strong></li>
                </ul>
              </div>
            </div>

            <!-- Empty placeholders for additional cards -->
            <div class="col-12 col-md-6 col-lg-4">
              <div class="card p-3 stat-card h-100">
                <h6 class="mb-2">Atividade do Sistema</h6>
                <p class="small text-muted mb-0">Nenhuma alerta crítico nas últimas 24 horas.</p>
              </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
              <div class="card p-3 stat-card h-100">
                <h6 class="mb-2">Configurações Rápidas</h6>
                <p class="small text-muted mb-0">Acesse configurações para ajustar taxas e regras do bolão.</p>
              </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
              <div class="card p-3 stat-card h-100">
                <h6 class="mb-2">Suporte</h6>
                <p class="small text-muted mb-0">Enviar ticket de suporte ou verificar logs.</p>
              </div>
            </div>

          </div>
        </div>

        @endsection
