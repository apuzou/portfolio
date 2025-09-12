<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Contact;
use App\SecurityLogger;
use Illuminate\Http\Request;

class ContactService
{
  public function createContact(array $data, Request $request): Contact
  {
    $contact = Contact::create([
      'name' => $data['name'],
      'email' => $data['email'],
      'subject' => $data['subject'],
      'message' => $data['message'],
      'ip_address' => $request->ip(),
      'user_agent' => $request->userAgent(),
    ]);

    // セキュリティログに記録
    SecurityLogger::logContactSubmission(
      $data['email'],
      $request->ip(),
      $request->userAgent()
    );

    return $contact;
  }

  public function updateContactStatus(Contact $contact, string $status): Contact
  {
    $contact->update(['status' => $status]);
    return $contact;
  }

  public function deleteContact(Contact $contact): bool
  {
    return $contact->delete();
  }

  public function getContactsPaginated(int $perPage = 20)
  {
    return Contact::with('replies.user')
      ->orderBy('created_at', 'desc')
      ->paginate($perPage);
  }

  public function getContactWithReplies(Contact $contact): Contact
  {
    return $contact->load('replies.user');
  }
}
