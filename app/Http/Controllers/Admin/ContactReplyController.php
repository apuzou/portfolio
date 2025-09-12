<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\ContactReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactReplyController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'contact_id' => 'required|exists:contacts,id',
            'message' => 'required|string',
        ]);

        ContactReply::create([
            'contact_id' => $request->contact_id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        // お問い合わせのステータスを「返信済み」に更新
        $contact = Contact::findOrFail($request->contact_id);
        $contact->update(['status' => 'replied']);

        return redirect()->route('admin.contacts.show', $request->contact_id)
            ->with('success', '返信が送信されました。');
    }
}
