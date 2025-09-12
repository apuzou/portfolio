<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct(
        private ContactService $contactService
    ) {}

    public function index()
    {
        $contacts = $this->contactService->getContactsPaginated();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        $contact = $this->contactService->getContactWithReplies($contact);
        return view('admin.contacts.show', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'status' => 'required|in:unread,read,replied,archived',
        ]);

        $this->contactService->updateContactStatus($contact, $request->status);

        return redirect()->route('admin.contacts.show', $contact)
            ->with('success', 'お問い合わせのステータスが更新されました。');
    }

    public function destroy(Contact $contact)
    {
        $this->contactService->deleteContact($contact);

        return redirect()->route('admin.contacts.index')
            ->with('success', 'お問い合わせを削除しました。');
    }
}
