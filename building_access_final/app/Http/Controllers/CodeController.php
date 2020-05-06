<?php

namespace App\Http\Controllers;

use App\Code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CodeController extends Controller
{
    /**
     * CodeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->authorizeResource(Code::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codes = Code::where('user_id',Auth::user()->id)->latest()->paginate(10);
        return view('user.viewAllCode', compact('codes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.codeCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Effettuare validazione
        $code = new Code();
        $code->name_visitor = $request->input('name');
        $code->surname_visitor = $request->input('surname');
        $code->type = $request->input('type');
        $code->expiration = $request->input('expiration') ? $request->input('expiration') : date("Y-m-d");
        $code->status = 'active';
        $code->user_id = Auth::user()->id;
        $code->access_code = rand(1000,9999);
        $res = $code->save();
        $message = $res ? 'Correctly generated code' : 'Error in code creation, try again';
        session()->flash('message', $message);
        return redirect()->route('code.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function show(Code $code)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function edit(Code $code)
    {
        return view('user.codeCreate', compact('code'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Code $code)
    {
        $code->name_visitor = $request->input('name');
        $code->surname_visitor = $request->input('surname');
        $code->type = $request->input('type');
        $code->expiration = $request->input('expiration') ? $request->input('expiration') : date("Y-m-d");
        $res = $code->save();
        $message = $res ? 'Correctly updated code' : 'Update error, try again';
        session()->flash('message', $message);
        return redirect()->route('code.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function destroy(Code $code)
    {
        // Se si vuole salvare in una tabella storico va fatto in questo punto
        $res = $code->delete();
        $message = $res ? 'Correctly deleted code' : 'Code deletion error , try again';
        session()->flash('message', $message);
        return redirect()->route('code.index');

    }
}
