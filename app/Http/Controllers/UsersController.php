<?php

namespace App\Http\Controllers;

use App\Client;
use App\Country;
use App\Http\Requests\StorePasswordRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Mail\UserCreated;
use App\User;
use Illuminate\Support\Facades\Mail;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('users.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
       if($request->role != 'admin'){
           $password_token = str_random(64);
           $client = Client::create($request->except('name', 'password', 'role', '_token') + ['name' => $request->get('client_name')]);
           $client->user()->create($request->only('name', 'role','price_coefficient', 'country_id') +
               ['password' => '', 'password_token' => $password_token]);

           Mail::to($request->only('email'))->send(new UserCreated($password_token));

       } else {
           User::create($request->only('name', 'role') + ['password' => bcrypt($request->password)]);
       }

        return redirect()->back();
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        $client = $user->client;
        $countries = Country::all();
        return view('users.edit', compact('user','client', 'countries'));
    }


    /**
     * @param UpdateUserRequest $request
     * @param $id
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $client = $user->client;

        if($request->role != 'admin') {
            $user->update($request->only('name', 'price_coefficient', 'role', 'country_id', 'disabled'));
            $client->update($request->except('name', 'password', 'role', '_token'));
        } else {
            $user->update($request->only('name', 'price_coefficient', 'role'));
        }
        return redirect()->route('users.index', $id);
    }


    public function destroy($id)
    {
        //
    }

    public function getToken($token)
    {
      return view ('users.passwordCreate');
    }

    public function storePassword(StorePasswordRequest $request)
    {
        $token = basename(url()->previous());
        $user = User::where('password_token', $token)->first();
        $user->update(['password' => bcrypt($request->get('password')), 'password_token' => null]);
        return redirect()->route('home');

    }
}
