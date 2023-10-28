<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function show()
    {
        return view('index');
    }
    public function confirm(ContactRequest $request)
    {
        $form = $request->only([
            'last-name',
            'first-name',
            'gender',
            'email',
            'postcode',
            'address',
            'building_name',
            'opinion'
        ]);
        return view('confirm', ['form' => $form]);
    }
    public function send(Request $request)
    {
        if ($request->get('action') === 'back') {
            return redirect()->route('form.show')->withInput();
        }
        $form = $request->only([
            'fullname',
            'gender',
            'email',
            'postcode',
            'address',
            'building_name',
            'opinion'
        ]);
        Contact::create($form);
        return view('thanks');
    }
    public function manage()
    {
        $result = Contact::paginate(10);
        return view('management', ['forms' => $result]);
    }

    public function search(Request $request)
    {
        $request->only([
            'fullname',
            'gender',
            'email',
            'postcode',
            'address',
            'building_name',
            'opinion'
        ]);
        if ($request->gender == '0') {
            if ($request->created_from == null && $request->created_to !== null) {
                $result = Contact::where('fullname', 'LIKE', "%{$request->fullname}%")
                ->whereDate('created_at', '<=', "{$request->created_to}")
                ->where('email', 'LIKE', "%{$request->email}%")
                ->paginate(10);
                return view('management', ['forms' => $result]);
            } elseif ($request->created_from !== null && $request->created_to == null) {
                $result = Contact::where('fullname', 'LIKE', "%{$request->fullname}%")
                ->whereDate('created_at', '>=', "{$request->created_from}")
                ->where('email', 'LIKE', "%{$request->email}%")
                ->paginate(10);
                return view('management', ['forms' => $result]);
            } elseif ($request->created_from == null && $request->created_to == null) {
                $result = Contact::where('fullname', 'LIKE', "%{$request->fullname}%")
                ->where('email', 'LIKE', "%{$request->email}%")
                ->paginate(10);
                return view('management', ['forms' => $result]);
            } else {
                $result = Contact::where('fullname', 'LIKE', "%{$request->fullname}%")
                ->whereDate('created_at', '<=', "{$request->created_to}")
                ->whereDate('created_at', '>=', "{$request->created_from}")
                ->where('email', 'LIKE', "%{$request->email}%")
                ->paginate(10);
                return view('management', ['forms' => $result]);
            }
        }
        if ($request->created_from == null && $request->created_to !== null) {
            $result = Contact::where('fullname', 'LIKE', "%{$request->fullname}%")
            ->where('gender', $request->gender)
            ->whereDate('created_at', '<=', "{$request->created_to}")
            ->where('email', 'LIKE', "%{$request->email}%")
            ->paginate(10);
            return view('management', ['forms' => $result]);
        } elseif ($request->created_from !== null && $request->created_to == null) {
            $result = Contact::where('fullname', 'LIKE', "%{$request->fullname}%")
            ->where('gender', $request->gender)
            ->whereDate('created_at', '>=', "{$request->created_from}")
            ->where('email', 'LIKE', "%{$request->email}%")
            ->paginate(10);
            return view('management', ['forms' => $result]);
        } elseif ($request->created_from == null && $request->created_to == null) {
            $result = Contact::where('fullname', 'LIKE', "%{$request->fullname}%")
            ->where('gender', $request->gender)
            ->where('email', 'LIKE', "%{$request->email}%")
            ->paginate(10);
            return view('management', ['forms' => $result]);
        } else {
            $result = Contact::where('fullname', 'LIKE', "%{$request->fullname}%")
            ->where('gender', $request->gender)
            ->whereDate('created_at', '<=', "{$request->created_to}")
            ->whereDate('created_at', '>=', "{$request->created_from}")
            ->where('email', 'LIKE', "%{$request->email}%")
            ->paginate(10);
            return view('management', ['forms' => $result]);
        }
    }

    public function delete(Request $request)
    {
        Contact::find($request->id)->delete();
        if ($request->currentPage == 1) {
            return redirect($request->firstPage);
        } else {
            return back();
        }
    }
}
