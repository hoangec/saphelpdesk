@extends($master)

@section('page')
    {{ trans('ticketit::admin.index-title') }}
@stop

@section('content')
    @include('ticketit::shared.header')
    @if($reportStatus)
        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header with-border">
                      <h3 class="box-title">Báo cáo tổng hợp</h3>
                    </div>
                    <div class="box-body">
                      <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                              <label>Công ty</label>
                              <select class="form-control" name="companies" id="company_report">
                                  @foreach ($companies as $company)
                                      <option value="{{ $company->id }}">{{ $company->name }}</option>
                                  @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                              <label>Ngày báo cáo</label>
                             <!-- <div class="input-group date">
                               <div class="input-group-addon">
                                 <i class="fa fa-calendar"></i>
                               </div>
                               <input type="text" class="form-control pull-right" id="date_report">
                             </div> -->
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="date_report">
                              </div>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                          <div class="col-lg-3 col-md-4 col-lg-offset-1">
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <div class="row">
                                          <div class="col-xs-3" style="font-size: 5em;">
                                              <i class="glyphicon glyphicon-th"></i>
                                          </div>
                                          <div class="col-xs-9 text-right">
                                              <h1 id = "ticket_total">{{ $tickets_count }}</h1>
                                              <div>{{ trans('ticketit::admin.index-total-tickets') }}</div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-3 col-md-4">
                              <div class="panel panel-danger">
                                  <div class="panel-heading">
                                      <div class="row">
                                          <div class="col-xs-3" style="font-size: 5em;">
                                              <i class="glyphicon glyphicon-wrench"></i>
                                          </div>
                                          <div class="col-xs-9 text-right">
                                              <h1 id="ticket_open">{{ $open_tickets_count }}</h1>
                                              <div>{{ trans('ticketit::admin.index-open-tickets') }}</div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-3 col-md-4">
                              <div class="panel panel-success">
                                  <div class="panel-heading">
                                      <div class="row">
                                          <div class="col-xs-3" style="font-size: 5em;">
                                              <i class="glyphicon glyphicon-thumbs-up"></i>
                                          </div>
                                          <div class="col-xs-9 text-right">
                                              <h1 id="ticket_closed">{{ $closed_tickets_count }}</h1>
                                              <span>{{ trans('ticketit::admin.index-closed-tickets') }}</span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                            <div id="curve_chart" style="width: 100%; height: 350px"></div>
                        </div>
                      </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    @else
        <div class="well text-center">
            {{ trans('ticketit::admin.index-empty-records') }}
        </div>
    @endif
@stop
@section('footer')
    @if($reportStatus)
    {{--@include('ticketit::shared.footer')--}}
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
    </script>
    <script type="text/javascript">
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          company_id =$("#company_report").val();
          date = $("#date_report").data('daterangepicker');
          let startDate = date.startDate.format("YYYY-MM-DD");
          let endDate = date.endDate.format("YYYY-MM-DD");
          var options = {
            chart: {
              title: 'Báo cáo theo loại yêu cầu',
              subtitle: '',
              series: { 0: {color: 'lightgray'} }
            }
          };
          $.ajax({
              // Tạo đường dãn tuyệt đối để truyền
              "url":"{{ action('DashboardCusController@getGeneralReportByCategories') }}",
              "type":"get",
              // Dữ liệu truyền đi
              "data":{id:company_id, startDate:startDate, endDate: endDate} ,
              "async":true,
              // Xử lý nếu thành công
              "success":function(result){
                    var data = google.visualization.arrayToDataTable(result);
                    var chart = new google.charts.Bar(document.getElementById('curve_chart'));
                    chart.draw(data, google.charts.Bar.convertOptions(options));
              }
          })
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            moment.locale('vi');
            $('#date_report').daterangepicker(
              {
                locale: { cancelLabel: 'Đóng', applyLabel: 'Chọn' }
              }
            );
            //$('#date_report').daterangepicker("setDate", new Date());
            $('#date_report').on('apply.daterangepicker', function(ev, picker) {
                date = $(this).val();
                sDate = picker.startDate.format('YYYY-MM-DD');
                eDate = picker.endDate.format('YYYY-MM-DD');
                company_id = $("#company_report").val();
                getReportByCompanyAndDate(company_id, sDate, eDate);
                drawChart();
            });
            // Bắt sự kiện click

            $("#company_report").on('change',function(){
                company_id =$(this).val();
                date = $("#date_report").data('daterangepicker');
                let startDate = date.startDate.format("YYYY-MM-DD");
                let endDate = date.endDate.format("YYYY-MM-DD");
                getReportByCompanyAndDate(company_id, startDate, endDate);
                drawChart();

            })

            function getReportByCompanyAndDate(companyId, sDate, eDate) {
                $.ajax({
                    // Tạo đường dãn tuyệt đối để truyền
                    "url":"{{ action('DashboardCusController@getGeneralReportByCompanyAndDate') }}",
                    "type":"get",
                    // Dữ liệu truyền đi
                    "data":{id:companyId, startDate:sDate, endDate: eDate} ,
                    "async":true,
                    // Xử lý nếu thành công
                    "success":function(result){
                        $("#ticket_total").text(result.total);
                        $("#ticket_open").text(result.open);
                        $("#ticket_closed").text(result.closed);
                    }
                })
            }
        })
    </script>
    @endif
@append
