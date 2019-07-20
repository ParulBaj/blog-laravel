<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->isPostRequest()) {
            $validator = $this->getLoginValidator();

            if ($validator->passes()) {
                $credentials = $this->getLoginCredentials();

                if (Auth::attempt($credentials)) {
                    Session::flash('message', "Welcome User!");
                    return Redirect::to("/");
                }

                return Redirect::back()->withErrors([
                    "invalid_credential" => ["Credentials invalid."]
                ]);
            } else {
                return Redirect::back()
                    ->withInput()
                    ->withErrors($validator);
            }
        }

        return View::make("admin.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //Check user’s post request
    protected function isPostRequest()
    {
        return Input::server("REQUEST_METHOD") == "POST";
    }

    //Validate
    protected function getLoginValidator()
    {
        return Validator::make(Input::all(), [
            "email" => "required|email",
            "password" => "required"
        ]);
    }
    //Get Login Credentials
    protected function getLoginCredentials()
    {
        return [
            "email" => Input::get("email"),
            "password" => Input::get("password")
        ];
    }

    public function logout()
    {
        Auth::logout();
        Session::flash('message', "You're logged out!");
    return Redirect::to('/');
 }

}
