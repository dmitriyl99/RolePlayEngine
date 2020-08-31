<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();
        $incomingMessages = $user->incomingMessages()->orderByDesc('created_at')->get();
        $outgoingMessages = $user->outgoingMessages()->orderByDesc('created_at')->get();
        $users = User::query()->select('nickname')->where('id', '!=', $user->id)->get();
        return view('users.messages.index', compact('incomingMessages', 'outgoingMessages', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MessageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MessageRequest $request)
    {
        $fromUser = auth()->user();
        $toUser = User::query()->where('nickname', $request->input('nickname'))->firstOrFail();
        $data = array_merge($request->validated(), [
            'from_user_id' => $fromUser->id,
            'to_user_id' => $toUser->id
        ]);
        Message::query()->create($data);
        return redirect()->route('messages.index')->with('success', 'Письмо отправлено пользователю '.$toUser->nickname);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        /** @var Message $message */
        $message = Message::query()->findOrFail($id);
        $user = auth()->id();
        if ($message->to_user_id == $user)
            $message->read();
        return view('users.messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
}
