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
        if($startDate->eq($endDate)) {
            $date = $startDate->toDateString();
            //$date = Carbon::createFromFormat('d/m/Y',$request->input('date'))->toDateString();
            $tickets_count = Ticket::where('company_id',$company_id)
                                ->whereDate('date_request',$date)
                                ->where('status_id','<>',$errorId)
                                ->count();            
            $open_tickets_count = Ticket::where('company_id',$company_id)
                                ->whereDate('date_request',$date)
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
                                ->whereNull('completed_at')
                                ->count();
            $closed_tickets_count = $tickets_count - $open_tickets_count;   
        }
        
       
        //
        return response()->json(['total' => $tickets_count , 'open' =>$open_tickets_count, 'closed' => $closed_tickets_count], 200);

    }
    public function getGeneralReportByCategories(Request $request) {
        //Bao cao theo danh muc

        $company_id = $request->input('id');

        $date = Carbon::createFromFormat('d/m/Y',$request->input('date'))->toDateString();        
        //
        $categories_all = Category::all();        
        $categories_share = [];
        $data = array(
            array('Danh mục','Tổng số','Chưa xử lý','Hoàn thành',),        
        );
        foreach ($categories_all as $cat) {
            $total =  $cat->tickets()->where('company_id',$company_id)
                               ->whereDate('date_request',$date)->count();
            $open = $cat->tickets()->where('company_id',$company_id)
                                ->whereDate('date_request',$date)
                                ->whereNull('completed_at')
                                ->count();
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
        if($companies->isEmpty()) {
            $reportStatus = false;
            return view('ticketit::admin.index',compact('reportStatus'));
        } else {
            $now = date('Y-m-d');            
            //$tickets_count = Ticket::where('company_id',$companies->first()->id)->count();
            $tickets_count = Ticket::where('company_id',$companies->first()->id)
                                    ->whereDate('date_request',$now)->count();            
            $open_tickets_count = Ticket::where('company_id',$companies->first()->id)
                                    ->whereDate('date_request',$now)
                                    ->whereNull('completed_at')
                                    ->count();
            $closed_tickets_count = $tickets_count - $open_tickets_count;
        }

      /*  $tickets_count = Ticket::count();        

        $open_tickets_count = Ticket::whereNull('completed_at')->count();
        $closed_tickets_count = $tickets_count - $open_tickets_count;*/

        // Per Category pagination
        $categories = Category::paginate(10, ['*'], 'cat_page');        
        // Total tickets counter per category for google pie chart
        $categories_all = Category::all();
        $categories_share = [];
        foreach ($categories_all as $cat) {
            $categories_share[$cat->name] = $cat->tickets()->count();
        }        
        // Total tickets counter per agent for google pie chart
        $agents_share_obj = Agent::agents()->with(['agentTotalTickets' => function ($query) {
            $query->addSelect(['id', 'agent_id']);
        }])->get();

        $agents_share = [];
        foreach ($agents_share_obj as $agent_share) {
            $agents_share[$agent_share->name] = $agent_share->agentTotalTickets->count();
        }

        // Per Agent
        $agents = Agent::agents(10);

        // Per User
        $users = Agent::users(10);

        // Per Category performance data
        $ticketController = new TicketsController(new Ticket(), new Agent());
        $monthly_performance = $ticketController->monthlyPerfomance($indicator_period);

        if (request()->has('cat_page')) {
            $active_tab = 'cat';
        } elseif (request()->has('agents_page')) {
            $active_tab = 'agents';
        } elseif (request()->has('users_page')) {
            $active_tab = 'users';
        } else {
            $active_tab = 'cat';
        }
        
        return view(
            'ticketit::admin.index',
            compact(
                'open_tickets_count',
                'closed_tickets_count',
                'tickets_count',
                'categories',
                'agents',
                'users',
                'monthly_performance',
                'categories_share',
                'agents_share',
                'active_tab',
                'companies',
                'reportStatus'
            ));
    }
}
