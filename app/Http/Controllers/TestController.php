<?php

namespace App\Http\Controllers;

use App\TestAnswer;
use App\TestQuestion;
use App\Tests;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\CheckAdminOrCompanyMiddleware;
use Illuminate\Support\Facades\Gate;

class TestController extends Controller
{
    /**
     * Construct
     * 
     * @return void
    */
	public function __construct()
    {
        $this->middleware(CheckAdminOrCompanyMiddleware::class, ['except' => ['show']]);
    }

     /**
     * Test home page
     *
     * @param Request $request
	 * @return view
    */
	public function index(Request $request)
    {
        return view('admin.tests.index');
    }

     /**
     * Get test data based on id
     *
     * @param integer $id
	 * @return view
    */
	public function show($id)
    {
        if (!Gate::allows('check-route', \Route::current()->getName())) {
            return back()->with('authMessage', "You are unauthorized to perform this operation");
        }
        
        $test = Tests::where('id', $id)->first();
        return view('admin.tests.view', compact('test'));
    }

    
     /**
     * Edit page
     *
     * @param integer $id
	 * @return view
    */
	public function edit($id)
    {
        $companies =null;
        if (isAdmin()) {
            $companies = Company::select('id', 'company_name')->get();
        }
        
        $test = Tests::where('id', $id)->first();
        return view('admin.tests.edit', compact('test', 'companies'));
    }
    
	 /**
     * Save data in edit page
     *
     * @param Request $Request
     * @param integer $id
	 * @return view
    */
	public function update(Request $request, $Request)
    {
        $test = new Tests();
        $data = $this->validate($request, [
            'test_name'     => 'required|max:50',
            'description'   => 'max:500',
            'questions.*'=>'required|distinct|min:1|max:10',
        ]);
        $data = $request->all();
        $data['id'] = $id;
        $test=Tests::find($id);
        $test->test_name=$data['test_name'];
        $test->description=$data['description'];
        $test->status=$data['status'];
        if (isAdmin()) {
            $test->type=$data['company_id']==0?'Predefined':'Test';
            $test->company_id=$data['company_id'];
        }
       
        $test->save();
        
        foreach ($data['questions'] as $key => $value) {
            $testQues=TestQuestion::where('id', $data['questions'][$key]['id'])->where('tests_id', $test->id)->first();
            if ($testQues==null) {
                $testQues=new TestQuestion;
                $testQues->added_by=Auth::user()->id;
                $testQues->status=true;
            }
            $testQues->tests_id=$test->id;
            $testQues->question=$data['questions'][$key]['question'];
            $testQues->type=$data['questions'][$key]['type'];
            $testQues->show_graph=isset($data['questions'][$key]['show_graph']);
            $testQues->status=true;
            $testQues->save();
        }

        return redirect()->route('admin.tests.index')->with('message', 'Test updated successfully');
    }

     /**
     * Save data in edit page
     *
     * @param Request $Request
     * @param integer $id
	 * @return view
    */
	public function get()
    {
        $data = [];
        if (Auth::user()->role=='admin') {
            $tests = Tests::where('status', '1')->get();
        } else {
            $tests = Tests::where('status', '1')->where('company_id', Auth::user()->parent_id)->get();
        }
        foreach ($tests as $test) {
            $data[] =['id'=> $test->id,'name'=> $test->test_name,'type'=> $test->type,'description'=> $test->description,'totalQuestions'=> $test->questions->count(),'company'=>isset($test->company)?$test->company->company_name:'','created_at'=> $test->created_at,'action'=>'
            <a href="' . route("admin.tests.edit", $test->id) . '"><button class="btn btn-primary btn-xs edit-button" data-id="' . $test->id . '" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></button></a>
            <button class="btn btn-danger btn-xs delete-button" onclick = "remove(' . $test->id . ');" data-id="' . $test->id . '"data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash"></i></button>'];
            // <a href="' . route("admin.tests.show", $test->id) . '"><button class="btn btn-info btn-xs view-button" data-id="' . $test->id . '" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye"></i></button></a>
        }
        return Response::json(['data' => $data]);
    }

    /**
     * Destroy
     *
     * @param integer $id
	 * @return view
    */
	public function destroy($id)
    {
        $test = Tests::where('id', $id)->first();
        $test->status=false;
        $test->save();
        return redirect()->back()->with('message', 'Test removed successfully.');
    }

     /**
     * Save data for new tests
     *
     * @param Request $Request
	 * @redirect
    */
	public function store(Request $request)
    {
        $data = $this->validate($request, [
                'test_name'     => 'required|max:50',
                'description'   => 'max:500',
                'questions.*'=>'required|distinct|min:1|max:10',
            ]);

        $data = $request->all();
        $test=new Tests;
        $test->test_name=$data['test_name'];
        $test->description=$data['description'];
        $test->status=true;
        $test->added_by=Auth::user()->id;
        if (isAdmin()) {
            $test->type=$data['company_id']==0?'Predefined':'Test';
            $test->company_id=$data['company_id'];
        } else {
            $test->type='Test';
            $test->company_id=Auth::user()->parent_id;
        }
        $test->save();
        
        foreach ($data['questions'] as $key => $value) {
            $testQues=new TestQuestion;
            $testQues->added_by=Auth::user()->id;
            $testQues->tests_id=$test->id;
            $testQues->question=$data['questions'][$key]['question'];
            $testQues->type=$data['questions'][$key]['type'];
            $testQues->show_graph=isset($data['questions'][$key]['show_graph']);
            $testQues->status=true;
            $testQues->save();
        }
        return redirect()->route('admin.tests.index')->with('message', 'Test added successfully');
    }
    public function new()
    {
        $companies =null;
        if (isAdmin()) {
            $companies = Company::select('id', 'company_name')->get();
        }
        return view('admin.tests.add', compact('companies'));
    }

    public function bulkDestroy($ids)
    {
        $deleteTest =  Tests::whereIn('id', $ids)
            ->get();
        foreach ($deleteTest as $test) {
            $test->status=false;
            $test->save();
        }
        if ($deleteTest) {
            $result = ['affected_row'=>$deleteTest,'status'=>'success'];
        } else {
            $result = ['affected_row'=>$deleteTest,'status'=>'failed'];
        }
        return $result;
    }

    public function bulkDestroyRequest(Request $request)
    {
        $ids = json_decode($request->get('ids'), true);
        $delete = $this->bulkDestroy($ids);
        if ($delete) {
            return redirect()->back()->with('message', 'Test removed successfully.');
        }
        return redirect()->back()->with('exception', 'Test not found !');
    }

    public function storeAnswer(Request $request, $id)
    {
        $data = $request->all();
        foreach ($data['answer'] as $key => $value) {
            $test=new TestAnswer;
            $test->tests_id=$id;
            $test->question_id=$key;
            if (TestQuestion::where('id', $key)->first()->type=='date') {
                $test->answer=date('Y-m-d', strtotime($value));
            } elseif (TestQuestion::where('id', $key)->first()->type=='text') {
                $test->answer=$value;
            } else {
                 $value->store('uploads/'.$data['id'].'/'.$id);
                $test->answer=$value->getClientOriginalName();
            }
            $test->added_by=$data['id'];
            $test->save();
        }
        return redirect()->back()->with('message', 'Test added successfully');
    }
}
