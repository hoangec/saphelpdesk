<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use Kordy\Ticketit\Controllers\DashboardController;
use Kordy\Ticketit\Controllers\TicketsController;
use Kordy\Ticketit\Models\Agent;
use Kordy\Ticketit\Models\Category;
use Kordy\Ticketit\Models\Setting;
use Kordy\Ticketit\Models\Ticket;

class DashboardCusController extends DashboardController
{
    //
    public function getGeneralReportByCompanyAndDate(Request $request) {
        $company_id = $request->input('id');
        // check date;
        $startDate = New Carbon($request->input('startDate'));
        $endDate = New Carbon($request->input('endDate'));
        $tickets_count = 0;
        $open_tickets_count = 0;
        $closed_tickets_count = 0;
        $errorId = Setting::grab('default_error_status_id');
        $date = $startDate->toDateString();
        if($startDate->eq($endDate)) {
            $tickets_count = Ticket::where('company_id',$company_id)
                                ->whereDate('date_request',$startDate)
                                ->where('status_id','<>',$errorId)
                                ->count();
            $open_tickets_count = Ticket::where('company_id',$company_id)
                                ->whereDate('date_request',$startDate)
                                ->where('status_id','<>',$errorId)
                                ->whereNull('completed_at')
                                ->count();
            $closed_tickets_count = $tickets_count - $open_tickets_count;
        } else {
            $tickets_count = Ticket::where('company_id',$company_id)
                                ->whereBetween('date_request',[$startDate, $endDate])
                                ->where('status_id','<>',$errorId)
                                ->count();
            $open_tickets_count = Ticket::where('company_id',$company_id)
                                ->whereBetween('date_request',[$startDate, $endDate])
                                ->where('status_id','<>',$errorId)
                                ->whereNull('completed_at')
                                ->count();
            $closed_tickets_count = $tickets_count - $open_tickets_count;
        }
        return response()->json(['total' => $tickets_count , 'open' =>$open_tickets_count, 'closed' => $closed_tickets_count], 200);

    }
    public function getGeneralReportByCategories(Request $request) {
        //Bao cao theo danh muc

        $company_id = $request->input('id');
        $startDate = New Carbon($request->input('startDate'));
        $endDate = New Carbon($request->input('endDate'));
        $errorId = Setting::grab('default_error_status_id');
        //
        $categories_all = Category::all();
        $categories_share = [];
        $data = array(
            array('Danh mục','Tổng số','Chưa xử lý','Hoàn thành',),
        );
        foreach ($categories_all as $cat) {
            if($startDate->eq($endDate)) {
              $total =  $cat->tickets()->where('company_id',$company_id)
                                     ->whereDate('date_request',$startDate)
                                     ->where('status_id','<>',$errorId)
                                     ->count();
              $open = $cat->tickets()->where('company_id',$company_id)
                                  ->whereDate('date_request',$startDate)
                                  ->where('status_id','<>',$errorId)
                                  ->whereNull('completed_at')
                                  ->count();
            } else {
              $total =  $cat->tickets()->where('company_id',$company_id)
                                     ->whereBetween('date_request',[$startDate, $endDate])
                                     ->where('status_id','<>',$errorId)
                                     ->count();
              $open = $cat->tickets()->where('company_id',$company_id)
                                  ->whereBetween('date_request',[$startDate, $endDate])
                                  ->where('status_id','<>',$errorId)
                                  ->whereNull('completed_at')
                                  ->count();
            }
            $data[] = [
                $cat->name,
                $total,
                $open,
                ($total - $open)
            ];
        }
        return response()->json($data, 200);
    }
    public function indexNew($indicator_period = 2)
    {
        //cus
        $user = $user = Auth::user();
        $companies = $user->companies;
        $reportStatus = true;
        $errorId = Setting::grab('default_error_status_id');
        if($companies->isEmpty()) {
            $reportStatus = false;
            return view('ticketit::admin.index',compact('reportStatus'));
        } else {
            $now = date('Y-m-d');
            $tickets_count = Ticket::where('company_id',$companies->first()->id)
                                      ->whereDate('date_request',$now)
                                      ->where('status_id','<>',$errorId)
                                      ->count();
            $open_tickets_count = Ticket::where('company_id',$companies->first()->id)
                                      ->whereDate('date_request',$now)
                                      ->whereNull('completed_at')
                                      ->count();
            $closed_tickets_count = $tickets_count - $open_tickets_count;
        }
        return view(
            'ticketit::admin.index',
            compact(
                'open_tickets_count',
                'closed_tickets_count',
                'tickets_count',
                'companies',
                'reportStatus'
            ));
    }
}
