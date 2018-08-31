<?php 

namespace App\Http\Controllers;

use App\CategoryAdv;
use App\TicketAdv;
use Backpack\PermissionManager\app\Models\Role;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Kordy\Ticketit\Controllers\TicketsController;
use Kordy\Ticketit\Helpers\LaravelVersion;
use Kordy\Ticketit\Models\Agent;
use Kordy\Ticketit\Models\Category;
use Kordy\Ticketit\Models\Priority;
use Kordy\Ticketit\Models\Setting;
use Kordy\Ticketit\Models\Status;
use Kordy\Ticketit\Models\Ticket;

class SomeController extends TicketsController {
	
	public function data($complete = 1)
	{
	    if (LaravelVersion::min('5.4')) {
	        $datatables = app(\Yajra\DataTables\DataTables::class);
	    } else {
	        $datatables = app(\Yajra\Datatables\Datatables::class);
	    }

	    $user = $this->agent->find(auth()->user()->id);

	    if ($user->isAdmin()) {
	        if ($complete == 1) {
	        	$collection = TicketAdv::active();
	        } elseif($complete ==2) {
	              $collection = TicketAdv::complete();
	        } elseif($complete == 3) {
	        	$collection = TicketAdv::error();
	        }
	    } elseif ($user->isAgent()) {
	        if ($complete == 2) {
	            $collection = TicketAdv::complete()->agentUserTickets($user->id);
	        } else {
	            $collection = TicketAdv::active()->agentUserTickets($user->id);
	        }
	    } else {
	        if ($complete == 2) {
	            $collection = TicketAdv::userTickets($user->id)->complete();
	        } else {
	            $collection = TicketAdv::userTickets($user->id)->active();
	        }
	    }

	    $collection
	        ->join('users', 'users.id', '=', 'ticketit.user_id')	        
	        ->join('ticketit_statuses', 'ticketit_statuses.id', '=', 'ticketit.status_id')
	        ->join('companies', 'companies.id', '=', 'ticketit.company_id')
	        ->join('ticketit_priorities', 'ticketit_priorities.id', '=', 'ticketit.priority_id')
	        ->join('ticketit_categories', 'ticketit_categories.id', '=', 'ticketit.category_id')
	        ->select([
	            'ticketit.id',
	            'ticketit.date_request as date_request',
	            'ticketit.code as code',
	            'companies.name as company',
	            'ticketit.subject AS subject',
	            'ticketit_statuses.name AS status',
	            'ticketit_statuses.color AS color_status',
	            'ticketit_priorities.color AS color_priority',
	            'ticketit_categories.color AS color_category',
	            'ticketit.id AS agent',
	            'ticketit.updated_at AS updated_at',
	            'ticketit_priorities.name AS priority',
	            'users.name AS owner',
	            'ticketit.agent_id',
	            'ticketit_categories.name AS category',
	        ]);

	    $collection = $datatables->of($collection);

	    $this->renderTicketTable($collection);

	    $collection->editColumn('updated_at', '{!! \Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $updated_at)->diffForHumans() !!}');
	    $collection->editColumn('date_request', '{!! date("d-m-Y, H:i:s",strtotime($date_request))!!}');
	    // method rawColumns was introduced in laravel-datatables 7, which is only compatible with >L5.4
	    // in previous laravel-datatables versions escaping columns wasn't defaut
	    if (LaravelVersion::min('5.4')) {
	        $collection->rawColumns(['code','subject', 'status', 'priority', 'category', 'agent']);
	    }	    
	    return $collection->make(true);
	}
	public function renderTicketTable($collection)
	{
		$collection->editColumn('code', function ($ticket) {
	        return (string) link_to_route(
	            Setting::grab('main_route').'.show',
	            $ticket->code,
	            $ticket->id
	        );
	    });

	/*    $collection->editColumn('subject', function ($ticket) {
	        return (string) link_to_route(
	            Setting::grab('main_route').'.show',
	            $ticket->subject,
	            $ticket->id
	        );
	    });*/

	    $collection->editColumn('status', function ($ticket) {
	        $color = $ticket->color_status;
	        $status = e($ticket->status);

	        return "<div style='color: $color'>$status</div>";
	    });

	    $collection->editColumn('priority', function ($ticket) {
	        $color = $ticket->color_priority;
	        $priority = e($ticket->priority);

	        return "<div style='color: $color'>$priority</div>";
	    });

	    $collection->editColumn('category', function ($ticket) {
	        $color = $ticket->color_category;
	        $category = e($ticket->category);

	        return "<div style='color: $color'>$category</div>";
	    });

	    $collection->editColumn('agent', function ($ticket) {
	        $ticket = $this->tickets->find($ticket->id);

	        return e($ticket->agent->name);
	    });

	    return $collection;
	}
	public function store(Request $request)
	{	
		$messages = [
			'content.required' => 'Vui lòng đính kèm hình ảnh cho yêu cầu'
		];
	    $this->validate($request, [
	        /*'subject'     => 'required|min:3',*/
	        'content'     => 'required|min:6',
	        'priority_id' => 'required|exists:ticketit_priorities,id',
	        'category_id' => 'required|exists:ticketit_categories,id',
	        'companies'  => 'required|exists:companies,id',
	        'date_request' => 'required',
	    ],$messages);

	    $ticket = new TicketAdv();
	    $ticket->subject = isset($request->subject) ? $request->subject : '' ;
	    $ticket->date_request = Carbon::createFromFormat('d/m/Y',$request->date_request);
	    $ticket->setPurifiedContent($request->get('content'));

	    $ticket->priority_id = $request->priority_id;
	    $ticket->category_id = $request->category_id;
	    $ticket->company_id = $request->companies;
	    $ticket->status_id = Setting::grab('default_status_id');
	    $ticket->user_id = auth()->user()->id;
	    $ticket->autoSelectAgent();
	    $ticket->code = '';
	    $ticket->save();
	    $ticketUpdated = $this->generateTicketCode($ticket);
	    $ticket->save();
	    //$ticketUpdated->save();
	    session()->flash('status', trans('ticketit::lang.the-ticket-has-been-created'));

	    return redirect()->action('SomeController@index');
	}
	private function generateTicketCode(TicketAdv $ticket){		
		$category = CategoryAdv::findOrFail($ticket->category_id);
		$code = $category->code . $ticket->date_request->day . $ticket->date_request->month . $ticket->date_request->year . $ticket->id;
		$ticket->code = $code;
		return $ticket;		
	}
	public function createCus($type='')
	{		
		$user = backpack_auth()->user();		
		$companies = $user->companies;	
		$legend  = '';
		$category = CategoryAdv::findOrFail($type);		
	    list($priorities, $categories) = $this->PCS();	    
	    return view('ticketit::tickets.create', compact('priorities', 'categories','role','permissions','category','type','companies'));
	}
	public function index()
	{
	    $complete = 1;
	    $categories =Category::all();
	    //dd($categories);
	    return view('ticketit::index', compact('complete','categories'));
	}
	public function indexComplete()
	{
	    $complete = 2;
	    $categories =Category::all();
	    return view('ticketit::index', compact('complete','categories'));
	}
	public function indexError()
	{
	    $complete = 3;
	    $categories =Category::all();
	    return view('ticketit::index', compact('complete','categories'));
	}
	public function show($id)
	{
	    $ticket = $this->tickets->findOrFail($id);

	    list($priority_lists, $category_lists, $status_lists) = $this->PCS();

	    $close_perm = $this->permToClose($id);
	    $reopen_perm = $this->permToReopen($id);

	    $cat_agents = CategoryAdv::find($ticket->category_id)->agents()->agentsLists();
	    if (is_array($cat_agents)) {
	        $agent_lists = ['auto' => 'Auto Select'] + $cat_agents;
	    } else {
	        $agent_lists = ['auto' => 'Auto Select'];
	    }

	    $comments = $ticket->comments()->paginate(Setting::grab('paginate_items'));

	    return view('ticketit::tickets.show',
	        compact('ticket', 'status_lists', 'priority_lists', 'category_lists', 'agent_lists', 'comments',
	            'close_perm', 'reopen_perm'));
	}
	public function complete($id)
	{
	    if ($this->permToClose($id) == 'yes') {
	        $ticket = $this->tickets->findOrFail($id);
	        $ticket->completed_at = Carbon::now();

	        if (Setting::grab('default_close_status_id')) {
	            $ticket->status_id = Setting::grab('default_close_status_id');
	        }
	        $code = $ticket->code;
	        $ticket->save();

	        session()->flash('status', trans('ticketit::lang.the-ticket-has-been-completed', ['name' => $code]));

	        return redirect()->route(Setting::grab('main_route').'.index');
	    }

	    return redirect()->route(Setting::grab('main_route').'.index')
	        ->with('warning', trans('ticketit::lang.you-are-not-permitted-to-do-this'));
	}
	public function makeError($id) {
		$errorId = Setting::grab('default_error_status_id');
		$status = Status::find($errorId);
		if(empty($status)) {
			session()->flash('warning', 'Không thay đổi được yêu cầu, Kiêm tra lại cấu hình ứng dụng dạnh mục các trạng thái');
			return redirect()->route(Setting::grab('main_route').'.show', $id);
		}

		$ticket = $this->tickets->findOrFail($id);
		$ticket->status_id = $errorId;
		$ticket->completed_at = Carbon::now();
		$ticket->save();
		session()->flash('status', 'Đánh dấu yêu cầu trạng thái lỗi thành công');
	    return redirect()->route(Setting::grab('main_route').'.show', $id);

	}
	public function update(Request $request, $id)
	{
	    $this->validate($request, [
	        //'subject'     => 'required|min:3',
	        //'content'     => 'required|min:6',
	        //'priority_id' => 'required|exists:ticketit_priorities,id',
	        //'category_id' => 'required|exists:ticketit_categories,id',
	        'status_id'   => 'required|exists:ticketit_statuses,id',
	        'agent_id'    => 'required',
	    ]);
	    $ticket = $this->tickets->findOrFail($id);

	    //$ticket->subject = $request->subject;

	    //$ticket->setPurifiedContent($request->get('content'));

	    $ticket->status_id = $request->status_id;
	    //$ticket->category_id = $request->category_id;
	    //$ticket->priority_id = $request->priority_id;

	    if ($request->input('agent_id') == 'auto') {
	        $ticket->autoSelectAgent();
	    } else {
	        $ticket->agent_id = $request->input('agent_id');
	    }

	    $ticket->save();

	    session()->flash('status', trans('ticketit::lang.the-ticket-has-been-modified'));

	    return redirect()->route(Setting::grab('main_route').'.show', $id);
	}

	protected function PCS()
	{
	    $priorities = Cache::remember('ticketit::priorities', 60, function () {
	        return Priority::all();
	    });

	    $categories = Cache::remember('ticketit::categories', 60, function () {
	        return CategoryAdv::all();
	    });	    
	    $statuses = Cache::remember('ticketit::statuses', 60, function () {
	        return Status::all();
	    });

	    if (LaravelVersion::min('5.3.0')) {
	        return [$priorities->pluck('name', 'id'), $categories->pluck('name', 'id'), $statuses->pluck('name', 'id')];
	    } else {
	        return [$priorities->lists('name', 'id'), $categories->lists('name', 'id'), $statuses->lists('name', 'id')];
	    }
	}
}