<?php

namespace CAP\Http\Controllers\Admin;

use CAP\Forms\UserForm;
use CAP\Models\User;
use Illuminate\Http\Request;
use CAP\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\Form;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /** @var Form $form */
        $form = \FormBuilder::create(UserForm::class, [
            'url' => route('admin.users.store'),
            'method' => 'POST'
        ]);
        return view('admin.users.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(UserForm::class);
        if (!$form->isValid()) {
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }
        $data = $form->getFieldValues();
        $result = User::createFully($data);
//        $password = str_random(6);
//        $data['password'] = $password;
//        /** @var \FormBuilder $data */
//        User::create($data);
        $request->session()->flash('message', "Usuário criado com sucesso");
        $request->session()->flash('user_created',[
            'id' => $result['user']->id,
            'password' => $result['password']
        ]);

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param User|\CAP\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CAP\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $form = \FormBuilder::create(UserForm::class, [
            'url' => route('admin.users.update', ['user' => $user->id]),
            'method' => 'PUT',
            'model' => $user

        ]);
        return view('admin.users.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \CAP\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        $form = \FormBuilder::create(UserForm::class, [
            'data' => ['id' => $user->id]
        ]);

        if (!$form->isValid()) {
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }
        $data = $form->getFieldValues();
        $user->update($data);
        session()->flash('message', 'Usuário editado com Sucesso');

        return redirect()->route('admin.users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CAP\Models\User $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('message', 'Usuário excluído com Sucesso');
        return redirect()->route('admin.users.index');
    }
}
